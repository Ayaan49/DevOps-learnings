# Introduction:

[Kubernetes](https://kubernetes.io/), also known as K8s, is an open-source system for automating deployment, scaling, and management of containerized applications.

## Cluster Architecture:

![k8's architecture](https://github.com/Ayaan49/DevOps-learnings/assets/64208057/1b5bbfaa-42e2-4bbc-907b-dff4c4a9138c)

K8s cluster consists of two types of nodes:

1. Master nodes / Control nodes
2. Worker nodes / Compute nodes

### Master node:

It consists of the following:

- Kube-API server
- etcd
- Scheduler
- Control Manager

### Worker node:

It consists of the following:

- Kubelet
- Kubeproxy
- CRI (Container Runtime Interface)
- CNI (Cluster Network Interface)

## Pod creation workflow:

1. API server

- Main managing component of k8s cluster.
- `kubectl` command goes into the cluster and hits the API server.
- API server then authenticates and validates it.

2. etcd

- etcd is a distributed key-value store.
- Used as a database in k8s cluster.
- Kube-API server writes that request to etcd.
- etcd will return it once it has made a successful write.

3. Kube-API server 

- Returns the request state to the user.
- At the same time the API server returns to the user that pod is created.
- Because at its core etcd has already defined the desired state of the system.
- Then all k8s component work together to make it possible.

4. Scheduler

- Looks for workloads needed to be created.
- Pings API server at regular intervals. (5s)
- Looks for available compute nodes to assign for pod creation and informs the API server.

5. Kube-API writes this information to etcd.

6. Kubelet

- Kubelet communicates with the Kube-API server.
- Registers node with the cluster.
- Periodically health checks to let API server know about the healthy nodes.
- Kube-API server instructs on which node pod should be created.

7. Kubelet gets the instruction from Kube-API server on which node it has to create the pod.

8. Kubelet works together with the Container runtime instance and makes a pod with the appropriate container running inside.

   So, now a pod has been created on a Kubernetes cluster!

9. The Kubelet informs this to the Kube-API server.

10. Kube-API server writes this to the etcd.
