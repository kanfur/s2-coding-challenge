
# 1. Start the container
docker-compose build
docker-compose up -d

Run `docker ps` to find out the name of your php container. It should look like this `s2-coding-challenge_php_1` (name of the folder + php + number of instance) then you can open a bash into your container using:

```bash
 docker exec -it {NAME} /bin/bash
```

# In the container: Initialization
```bash
composer install
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
yarn install
```

# Frontend build
```bash
yarn encore dev
```

# Troubleshooting

##docker container are not starting
please shutdown all other projects in docker to avoid using port 80 and 3306. You can run `docker ps` to identify other running containers. Easiest way is to stop then via UI

#### Already used port 3306 for mysql
when you can't temporary stop the container, or you have a mysql running directly on your machine, please change the port in the following files
- In file:`./docker-compose.yml`
    - Uncomment the lines 14, 17 and 18
    - Change the port 3306 to 3307 in lines 16 and 26
- In file: `./.env`
    - Change the port 3306 to 3307 in line 34 (DATABASE_URL)
- Run `docker-compose up -d` to update the container settings
