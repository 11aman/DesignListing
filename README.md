# DesignListing
Whole module is developed using livewire
For Excel management we have used spatie/simple-excel


Installation Guide
 Clone the Repository
 git clone https://github.com/your-username/designList.git

 Install Dependencies
 composer install
npm install && npm run dev

Set Up the Environment
copy .env.example .env

in env file update
DB_DATABASE=design
DB_USERNAME=root
DB_PASSWORD=

Generate app key
php artisan key:generate


Import the Database
mysql -u root -p design < database.sql


Use seeder for pre existing some data
php artisan migrate --seed

Run project
php artisan serve
