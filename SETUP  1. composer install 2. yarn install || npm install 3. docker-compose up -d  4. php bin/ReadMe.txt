SETUP

1. composer install
2. yarn install || npm install
3. docker-compose up -d 
4. php bin/console doctrine:migrations:migrate
5. php bin/console doctrine:fixtures:load
6. symfony serve -d
7. yarn build || npm run build - if styles didnt load
