use your docker hub login name instead of `cloudgenius`

### Build and push custom image

```
git clone https://github.com/beacloudgenius/customwordpress.git

cd customwordpress/custom-image

docker build -t cloudgenius/wordpress:6.4.3   .

docker login

docker push cloudgenius/wordpress:6.4.3

cd ..
```

### Apply mysql manifest

```
kubectl apply -f mysql/pvpvc.yaml
kubectl apply -f mysql/svc.yaml
kubectl apply -f mysql/deploy.yaml
```

### Edit the DNS for wordpress ingress

```
edit the file wordpress/ing.yaml

make sure to use your domain
```

### Apply wordpress manifest

```
kubectl apply -f wordpress/pvpvc.yaml
kubectl apply -f wordpress/svc.yaml
kubectl apply -f wordpress/ing.yaml
kubectl apply -f wordpress/deploy.yaml
```
