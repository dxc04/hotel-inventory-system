# HSG Portal

Used by hotel attendants to track guests' purchases

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Docker

### Installing

Steps:

**Notes**

* Add `sudo` if commands don't work.
* Run all commands in the terminal. You ma use [Git Bash](https://gitforwindows.org/) in Windows
* You may also need to setup your github ssh keys https://help.github.com/en/articles/connecting-to-github-with-ssh

1. Install [Docker Toolbox](https://docs.docker.com/toolbox/overview/) or [Docker Community Edition](https://store.docker.com/search?type=edition&offering=community) 
   
   * **Linux Ubuntu [Docker CE](https://docs.docker.com/install/linux/docker-ce/ubuntu/)**

2. Clone the repo and run docker-compose

    ```git clone git@github.com:sorit/hsg.git hsg_portal```
    
    ```cd hsg_portal```

    ```docker-compose up```

3. Setup Laravel framework. Open a new terminal.

    ```docker exec -ti hsg_portal_web_1 bash```

    ```cp .env.example .env```
           
    ```composer install```
    
    ```php artisan config:cache```

    ```php artisan key:generate```

    ```chmod -R o+w storage/ bootstrap/cache/```
    
    ```php artisan migrate```
    
5. You can then access the new app on http://0.0.0.0
6. The admin site can be access on http://0.0.0.0/admin
    
    Email Address: admin@example.com
    
    Password: admin123
    
**Resetting Setup**

* If you need to reset the development setup just run the following:

    ```docker rm hsg_portal_web_1```

    ```docker volume rm hsg_portal_dbdata```
    
    ```docker-compose up```

## Config
**Database**

 db name: hsg_portal 
 
 user: homestead
 
 host: 0.0.0.0
 
 port: 33061
 
 password: secret

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Vue.js](https://vuejs.org/) - Package Management
* [LAP](https://lap.kjjdion.com/docs) - Admin System
* [sb-admin-2](https://github.com/BlackrockDigital/startbootstrap-sb-admin-2) - Frontend UI Template


## DEMO SITE 

http://hsg-portal-demo.herokuapp.com  - Front End
http://hsg-portal-demo.herokuapp.com/admin - Admin 

    Email Address: admin@example.com
    
    Password: admin123

