## Introduction:

A pod is the smallest deployable unit in Kubernetes that represents a single instance of an application.

*So how does it differ from a container?*
A container is a single unit. However, a pod can contain more than one container. You can think of pods as a box that can hold one or more containers together.

## Pod YAML

Pod is a native Kubernetes Object and if you want to create a pod, you need to declare the pod requirements in YAML format.

- A Pod YAML file consists of three main parameters: apiVersion, metadata, kind, and spec.

Let’s take a look at the Kubernetes pod object.

