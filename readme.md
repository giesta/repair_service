# Repair Service
The receiver accepts from the customer a broken device, registers, gives an access code.
Repairers note which device is repaired.
The customer sees whether his device is repaired or not.
The receiver notes when the customer takes back the device.
And the manager sees all the progress of repairing process.
### Installing
* Insert project into empty folder / git clone https://github.com/giesta/repair_service.git
* Create an empty database table
* Copy the .env.example to .env and insert the Database config
* Run the following commands
    ``` 
    composer install
    php artisan migrate --seed
    php artisan key:generate
    ```
