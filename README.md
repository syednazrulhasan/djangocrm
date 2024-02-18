# Deploy Django App(Dockerize) or Setup as Nginx Reverse Proxy or Ensure to run on different port ie 8005
===================================

## Intro
Learn how to containerize(dockerize) hat helps to containerize(dockerize)  Django App  or Setup as Nginx / Gunicorn Reverse Proxy  or just Deploy using code from Github on port 8000 

### Youtube Explainer Videos
I have created 4 youtube videos explining different types of Django App deployment 

**Video 1** Dockerize Django app and deploy on AWS EC2 from dockerhub.io 
https://www.youtube.com/watch?v=nbcWI6EFjUs

1- We used Ubuntu Server  and installed docker from snap
```
sudo snap install docker
```

2- We pulled over the docker hub public image from hub.docker.com as below
``` 
docker pull syednazrulhassan/crm:jan182024
```

3- We then we run the docker container using following code 
```
docker run -d -p 8000:8000 syednazrulhassan/crm:jan182024
```

4- To SSH into the docker contain you just spun you can run following command to get container id   https://imgur.com/mpDA56G 
```
docker container ls
```

5- Now from previous command you get container id and you can us that container id which is cbfe903a1086 in my case to SSH into  the container using following commands  https://imgur.com/a/TWqrwoM
```
docker exec -it cbfe903a1086 /bin/bash
```


**Video 2** Deploy manually Django app on AWS EC2 from github
https://www.youtube.com/watch?v=BuDXIcPsA_8

1- Clone from git in my case it was 
```
git clone git clone https://github.com/syednazrulhasan/djangocrm.git
```

2- CD into the cloned folder in my case its 
```
cd djangocrm
```

3- Activate Virtual Enviorment  in my case i pushed the venv to git so it got cloned but need to activate using command below
```
source advacrm/bin/activate
```
 
4- Install all packages using following command ( Make Sure to keep requirements.txt updated  on git) 
```
pip install -r requirements.txt
```

5- Finally run the command to django on your instance is 
```
python3 manage.py runserver 0.0.0.0:8005
```


**Video 3** Deploy Django app on AWS EC2 from github on Nginx Reverse Proxy Gunicorn(Application Server) with Nginx and Gunicorn as Service
https://www.youtube.com/watch?v=a0KQLmwL7fY

```
sudo apt-get update && upgrade
sudo apt-get install vim python3 python3-pip python3-dev pkg-config libmysqlclient-dev nginx
```

1- Clone from git in my case it was 
```
git clone https://github.com/syednazrulhasan/djangocrm.git
```

2- CD into the cloned folder in my case its djangocrm
```
cd djangocrm
```

3- Install pip3 inside project directory in my case its djangocrm
```
sudo pip3 install virtualenv
```

4- Create a  virtual environment with name as venv
```
virtualenv venv
```

5- Activate the virtual environment
```
source venv/bin/activate
```

6- Install all packages using following command  Make Sure to keep requirements.txt updated  on git) 
```
pip install -r requirements.txt
```

7- Run following commands to make sure migrate and makemigrations commands are run
```
python3 manage.py migrate
```
```
python3 manage.py makemigrations
```

8- Create a super user
```
python manage.py createsuperuser
```

9- Finally run the command to django on your instance is 
```
python3 manage.py runserver 0.0.0.0:8000
```

10- Install Gunicorn (INSIDE Virtual Environment)
```
pip install gunicorn
```

11- Starting Gunicorn to serve a Django application named "advacrmproject"
```
gunicorn --bind 0.0.0.0:8000 advacrmproject.wsgi:application
```

12- Deactivate virtual enviorment
```
deactivate
```

12- Create a Gunicorn Socket

```
sudo vi /etc/systemd/system/gunicorn.socket
```

```
[Unit]
Description=gunicorn socket

[Socket]
ListenStream=/run/gunicorn.sock

[Install]
WantedBy=sockets.target
```

13- Find out user group and present working directory 
ll
pwd 

14- Create a gunicorn.service File:
```
sudo vi /etc/systemd/system/gunicorn.service
```

```
[Unit]
Description=gunicorn daemon
Requires=gunicorn.socket
After=network.target

[Service]
User=ubuntu
Group=www-data
WorkingDirectory=/home/ubuntu/djangocrm
ExecStart=/home/ubuntu/djangocrm/venv/bin/gunicorn \
          --access-logfile - \
          --workers 3 \
          --bind unix:/run/gunicorn.sock \
          advacrmproject.wsgi:application

[Install]
WantedBy=multi-user.target
```

14- Start gunicorn enable gunicorn as a service(to start automatically along with operating system in case instance is restarted)
```
sudo systemctl start gunicorn.socket
sudo systemctl enable gunicorn.socket
```

15- Create a nginx configuration file 
```
sudo vi /etc/nginx/sites-available/advacrmproject
```

```
server {
    listen 80;
    server_name 18.144.68.12;

    location = /favicon.ico { access_log off; log_not_found off; }
    location /static/ {
        root /home/ubuntu/djangocrm;
    }

    location / {
        include proxy_params;
        proxy_pass http://unix:/run/gunicorn.sock;
    }
}
```

16- Enable the configuration above to enable site by creating a symbolic link to configuration file
```
sudo ln -s /etc/nginx/sites-available/advacrmproject /etc/nginx/sites-enabled/
```

17- Restart Nginx
```
sudo systemctl restart nginx
```

**Video 4** In case you prefer to deploy Django App over MySQL you can install MySQL as Docker Container 
https://www.youtube.com/watch?v=Zs4fHdyq-u8


1-Create a docker volume named as mysql_data
```
docker volume create mysql_data
```

2-Verify the volume has been created 
```
docker volume ls
```

3-To pull and install mysql version 5.7 inside docker volume after pulling mysql image. The following command exposes port 3307 of container and maps it to 3306 of mysql inside container it also creates a root user with password root and a database as crm 
```
docker run -d --name mysql-container -e MYSQL_ROOT_USERNAME=root -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=crm -v mysql_data:/var/lib/mysql -p 3307:3306 mysql:5.7
```
4-To log into mysql and skip use database command in container shell you can run following command
```
docker exec -it mysql-container mysql -uroot -proot crm
```

5- To use mysql from shell install MySQL from shell using following command 
```
apt install mysql-client-core-8.0
```

6-To login into MySQL shell from host machine(machine on which container resides)use following command specify database name at end to skip use database crm  https://imgur.com/aBUJPYi
```
mysql -uroot -proot -h127.0.0.1 -P3307 crm 
``` 

### Docker Commands
*To list all container irrespective of state https://imgur.com/IqLCyXK
docker ps -a 

*To list all running container
docker ps

*To stop a container 
docker stop 702a5d56ee6d  where 702a5d56ee6d is container id

*To start a container
docker start 702a5d56ee6d where 702a5d56ee6d is container id

*To remove(delete) a container 
docker rm 702a5d56ee6d where 702a5d56ee6d is container id and container needs to be in stopped state before this command is issued

*To list all images on system
docker images

*To remove image from system 
docker rmi 5107333e08a8  where 5107333e08a8 is image id of image

*To run a container out of an image 
docker run -d --name  --network  -e  -v  -p  mysql:5.7  where _d stands for detached mode, --name* stands for name of container, --network stands for specifying network name, -e stands for specifying environment variables -v is used to specify volume -p is used to expose/map ports 

*To create a docker volume
docker volume create mysql_data

*To list volume 
docker volume ls

*To remove volume
docker volume rm mysql_data *THIS WILL REMOVE ALL DATA MAPPED TO CONTAINER*

*To stop all running containers

docker stop $(docker ps -a -q)

*To remove all containers that are stopped

docker rm -f $(docker ps -a -q)

*To remove images that are not in use

*docker rmi -f $(docker images -q)

*To clear system of all cluttered containers

docker system prune -a

