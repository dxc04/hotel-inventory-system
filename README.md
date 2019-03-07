## HSG Portal

## Installation
Steps:

1. Install [Docker Toolbox](https://docs.docker.com/toolbox/overview/) or [Docker Community Edition](https://store.docker.com/search?type=edition&offering=community) 

   * **Windows 10: Install [Docker Toolbox Windows](https://docs.docker.com/docker-for-windows/)**
   
   * **Linux Ubuntu [Docker CE](https://docs.docker.com/install/linux/docker-ce/ubuntu/)**

   * **Mac: Yosemite 10.10.3 or above Install [Docker Community Edition for Mac](https://store.docker.com/editions/community/docker-ce-desktop-mac); otherwise, Install [Docker Toolbox for Mac](https://docs.docker.com/docker-for-mac/)**

2. Clone the repo and run docker-compose

    ```git clone git@github.com:sorit/hsg.git hsg_portal```

    ```docker-compose up```

3. Setup Laravel framework. Open a new terminal.

    ```docker-compose exec app composer install```

    ```cp .env.example .env```

    ```docker-compose exec app php artisan key:generate```

    ```docker-compose exec app chmod -R o+w storage/ bootstrap/cache/```
    
    ```docker-compose exec app php artisan migrate```
    
5. You can then access the new app on http://0.0.0.0:8080
6. The admin site can be access on http://0.0.0.0:8080/admin
    Email Address: admin@example.com
    Password: admin123

## Config
**Database**

 db name: hsg_portal 
 
 user: homestead
 
 host: 0.0.0.0
 
 port: 33061
 
 password: secret

## What's inside on docker?
* Nginx,
* PHP 7.2.2-fpm,
* composer,
* MySQL 5.7.2,
* Laravel 5.7.*
* composer

