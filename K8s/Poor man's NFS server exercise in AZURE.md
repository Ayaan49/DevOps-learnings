---
share_link: https://share.note.sx/oecymqhf#SEgY7th4tiH3JRGTZ0Q09fD9aYRAeM6HG2SR6pJ/Jjg
share_updated: 2024-07-02T00:58:15+05:30
---

1. Create a disk using the `az disk create` command

```
az disk create --resource-group your-RG --name name-of-disk --size-gb 20 --query id --output tsv
```

> [!NOTE]
> Use a different `resource group` than your node resource group because if we create the disk in the same `resource group` as the node `resource group`, then the disk will get deleted when we delete the node. We don't want that; we want the disk to persist.

2. The disk resource ID is displayed once the command has successfully completed, as shown in the following example output. You will use it as the **diskURI** to mount the disk in the next section

```
/subscriptions/2f587058-a729-4c92-bdf2-24b70b012952/resourceGroups/AZ-STUDENT/providers/Microsoft.Compute/disks/nfsdisk
```

3. Next, we need to know the `principalId` of the **AKS cluster** to grant **READ** access, allowing it to access the disk in the other resource group.

```
az aks show --resource-group my-new-rg --name andromeda --query "identity"
```

Grab the `principalId` from the output and save it somewhere. We will need it in the next step.

```
{
  "delegatedResources": null,
  "principalId": "c131f75b-7f9f-4cea-a009-05c6v418a05r",
  "tenantId": "e57650cc-3928-43c9-a8fc-335c41dc8390",
  "type": "SystemAssigned",
  "userAssignedIdentities": null
}

```

4. Now, we will assign the `READER` role to our `principalID`which we retrieved in the previous step:

```
az role assignment create --assignee <principalID> --role Reader --scope <diskURI>
```

This command will provide `READ` access to our cluster to read our disk in the other `resource group`. This will allow our pods to mount the disk.

5. Create a [NFS deployment](https://gist.github.com/lvnilesh/4a8baf094f003059e1750317ae2af9b4) that creates a pod running NFS server that grabs that disk:

```
apiVersion: apps/v1
kind: Deployment
metadata:
  name: nfs-server
spec:
  replicas: 1
  selector:
    matchLabels:
      role: nfs-server
  template:
    metadata:
      labels:
        role: nfs-server
    spec:
      containers:
        - name: nfs-server
          image: cloudgenius/nfs-server:8
          imagePullPolicy: Always
          ports:
            - name: nfs
              containerPort: 2049
            - name: mountd
              containerPort: 20048
            - name: rpcbind
              containerPort: 111
          securityContext:
            privileged: true
          volumeMounts:
            - mountPath: /exports
              name: mypvc
      volumes:
        - name: mypvc
          azureDisk:
            diskName: nfsdisk
            diskURI: /subscriptions/2f587058-a729-4c92-bdf2-24b70b012952/resourceGroups/AZ-STUDENT/providers/Microsoft.Compute/disks/nfsdisk
            kind: Managed
            cachingMode: None
            fsType: ext4

```

6. Next, we create [NFS-service](https://gist.github.com/lvnilesh/38032db856a98a94dc7511f38c48da8f) that exposes that NFS deployment we just created

```
apiVersion: v1
kind: Service
metadata:
  name: nfs-server
spec:
  ports:
    - name: nfs
      port: 2049
    - name: mountd
      port: 20048
    - name: rpcbind
      port: 111
  selector:
    role: nfs-server
```

7. Next, we want to test this NFS persistent storage solution.
    We need to define a custom storage class to our custom storage solution, so we create a `cg-storageclass` using this yaml snippet. Save this snippet in a text file named `sc.yaml`

```
kind: StorageClass
apiVersion: storage.k8s.io/v1
metadata:
  name: cg-storageclass
provisioner: nfs-service
reclaimPolicy: Retain
volumeBindingMode: Immediate
allowVolumeExpansion: false
parameters:
  storageaccounttype: Premium_LRS
  kind: Managed
mountOptions:
  - debug
```

8. Get the `nfs-service` **cluster IP** with this command `kubectl get service` 
And save it somewhere, we will need it in the next step

```
10.0.204.214 # Save your own IP somewhere like this
```

9. So we create a request for a 10Gi test volume from NFS and make a [test claim](https://gist.github.com/lvnilesh/e462e57bc78ec3a89f97c6752669a089) against that.

```
apiVersion: v1
kind: PersistentVolume
metadata:
  name: test
spec:
  capacity:
    storage: 20Gi
  storageClassName: cg-storageclass    
  accessModes:
    - ReadWriteMany
  nfs:
    # FIXME: use the right IP
    server: 10.0.208.110
    path: "/" 
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  name: test
spec:
  accessModes:
    - ReadWriteMany
  storageClassName: cg-storageclass
  resources:
    requests:
      storage: 20Gi
```

Add your IP in the server of nfs section and create the claim.

10. Next, we create a [test deployment](https://gist.github.com/lvnilesh/5a4404f66b7355f28193e545094ae241) that mounts the volume test claimed earlier from NFS export.

```
apiVersion: apps/v1
kind: Deployment
metadata:
  name: test
spec:
  replicas: 1
  selector:
    matchLabels:
      name: test
  template:
    metadata:
      labels:
        name: test
    spec:
      containers:
        - image: cloudgenius/toolimage:ubuntu
          command:
            - sh
            - -c
            - "while true; do date > /mnt/test.html; hostname >> /mnt/test.html; sleep 5; done"
          imagePullPolicy: Always
          name: test
          volumeMounts:
            # name must match the volume name below
            - name: my-pvc-nfs
              mountPath: "/mnt"
      volumes:
        - name: my-pvc-nfs
          persistentVolumeClaim:
            claimName: test
```


11. We have successfully completed the exercise and created a test volume, test volume claim and test volume deployment.

12. We can `exec -it` into the **test** pod and create a file in there and see the same file when we `exec -it` into the **nfs** pod in the `/exports` directory.

```
kubectl exec -it test-6cc98bd966-fpf2n -- sh
```

```
kubectl exec -it nfs-server-7f586bdb84-x97xj -- sh

cd exports 
```
