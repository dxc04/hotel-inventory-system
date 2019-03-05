## HSG Portal


## Installation
Steps:

1. Install [Docker Toolbox](https://docs.docker.com/toolbox/overview/) or [Docker Community Edition](https://store.docker.com/search?type=edition&offering=community) 

   * **Windows 10: Install [Docker Toolbox Windows](https://docs.docker.com/docker-for-windows/)**

   * **Mac: Yosemite 10.10.3 or above Install [Docker Community Edition for Mac](https://store.docker.com/editions/community/docker-ce-desktop-mac); otherwise, Install [Docker Toolbox for Mac](https://docs.docker.com/docker-for-mac/)**

2. Clone the repo and start setup the framework

```git clone git@github.com:sorit/hsg.git hsg_portal```

```docker pull composer```

```docker run --rm -v $(pwd):/app composer install```

```cp .env.example .env```

```docker-compose exec app php artisan key:generate```

