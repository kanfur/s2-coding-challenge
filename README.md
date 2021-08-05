
# 1. Start the container
docker-compose build
docker-compose up -d

Run `docker ps` to find out the name of your php container, then you can open a bash into your container using:
```bash
 docker exec -it {NAME} /bin/bash
```

# In the container: Initialization
```bash
composer install
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
yarn
```

# Frontend build
yarn run dev

# Troubleshooting

#### Already used port 3306 for mysql

- In file:`./docker-compose.yml`
    - Uncomment the lines 14, 17 and 18
    - Change the port 3306 to 3307 in lines 16 and 26
- In file: `./.env`
    - Change the port 3306 to 3307 in line 34 (DATABASE_URL)
- Run `docker-compose up -d` to update the container settings
