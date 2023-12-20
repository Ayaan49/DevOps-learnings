## Replication Controller:

A Replication Controller is a Kubernetes resource that ensures a specified number of replicas (instances) of a pod are running at all times. It is part of the broader category of controllers in Kubernetes, designed to help maintain the desired state of the cluster.

### Features:
1. High Availability: The replication controller provides us multiple instances of a single pod in Kubernetes cluster, thus providing us high availability.

![ha](https://github.com/Ayaan49/DevOps-learnings/assets/64208057/ac3d5810-c3e8-49f2-b137-b1343140ccb7)

2. Load balancing and scaling: The replication controller helps us divide the traffic in multiple pods when traffic increases, thus helping us to scale our application as well.

![lb](https://github.com/Ayaan49/DevOps-learnings/assets/64208057/2b9c648d-ce73-4286-a318-e242be516ecf)

### Creating a Replication Controller:

- Start by creating a YAML file for your Replication Controller.
- Define metadata (name) and specifications (replicas, and pod template).
- Add the same details in template used while creating your pod.

```yaml
apiVersion: v1
kind: ReplicationController
metadata:
  name: my-replication-controller
  labels:
    app: my-app
    type: front-end
spec:
  template:

    metadata:
      name: myapp-pod
      labels:
        app: my-app
        type: front-end
    spec:
      containers:
      - name: my-container
        image: my-image:latest

replicas: 3
```
- Execute `kubectl create -f rc file.yml` to create the replication controller.
- Execute `kubectl get replicationcontroller` to check the status of your replication controller.

## ReplicaSet:

A ReplicaSet is a higher-level abstraction in Kubernetes that is designed to ensure a specified number of replicas (instances) of a pod are running at all times. It's part of the broader category of controllers, and it serves a similar purpose as the older Replication Controller but with some additional features.

![GBKF5XwbMAA3iCt](https://github.com/Ayaan49/DevOps-learnings/assets/64208057/0cd1925c-0055-448b-8704-0674822514d3)

### Features:

1. ReplicaSets use label selectors to identify the pods they manage. 
2. RepliaSets can also be used to monitor existing pods.

### Creating a ReplicaSet:

- Start by creating a YAML file for your ReplicaSet.
- Define your ReplicaSet with a declarative configuration. Specify details like the desired number of replicas, label selectors, and pod templates.

```yaml
apiVersion: apps/v1
kind: ReplicaSet
metadata:
  name: my-replicaset
  labels:
     app: my-app
     type: front-end

spec:
  template:

    metadata:
      name: myapp-pod
      labels:
        app: my-app
        type: front-end
    spec:
      containers:
      - name: my-container
        image: my-image:latest
replicas: 3
selector:
  matchLabels:
    type: front-end
```
- In the apiVersion we use `apps/v1` instead of only `v1`.
- It uses matchlabel selectors because the selector helps the replicsSet to identify what pods fall under it.
- Execute `kubectl create -f rs file.yml` to create the ReplicaSet.

### Scaling:

To scale the number of pods in replicaset we use the following command:

`kubectl scale rs --replicas=x -f file.yml`

- Here `x` is the number of pods we want to scale.



 
