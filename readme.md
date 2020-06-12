* Insert project into empty folder / git clone https://github.com/giesta/repair-service.git
* Create an empty database table
* Copy the .env.example to .env and insert the Database config
* Run the following commands
    ``` 
    composer install
    php artisan migrate --seed
    php artisan key:generate
    ```