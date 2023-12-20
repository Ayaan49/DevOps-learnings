## POD:

A pod is the smallest deployable unit in Kubernetes that represents a single instance of an application.

*So how does it differ from a container?*

A container is a single unit. However, a pod can contain more than one container. You can think of pods as a box that can hold one or more containers together.

### POD YAML:

Pod is a native Kubernetes Object and if you want to create a pod, you need to declare the pod requirements in YAML format.

- A Pod YAML file consists of three main parameters: apiVersion, metadata, kind, and spec.

Let’s take a look at the Kubernetes pod object:

![pod-yml](https://github.com/Ayaan49/DevOps-learnings/assets/64208057/ac33d1b3-bee8-423d-9f96-f9f68878e55e)

### Creating a POD:

Let’s see how we can create a pod using the YAML manifest-

- Create a file named `pod.yaml` with the following contents.
```yaml
apiVersion: v1
kind: Pod
metadata:
  name: your-pod-name
  labels:
    type: frontend
spec:
  containers:
    - name: your-container-name
      image: your-container-image
```
- apiVersion is the version of Kubernetes API.
- Name contains string values and labels contain key-value pair.
- For each container, set a name and reference the container image.

Now, to deploy the manifest, you need to execute the following kubectl command with the file name. 
 `kubectl create -f pod.yaml`

### Confirm your pod creation:

- You can get the status of the deployed pod with-

  `kubectl get pods`

- Once the pod is deployed you will see the pod Running status as shown below.
  
![pod-creation](https://github.com/Ayaan49/DevOps-learnings/assets/64208057/26cd1841-289a-4fd7-8de1-31d771ce9fc6)


