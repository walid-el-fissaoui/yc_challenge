# YouCan Coding Challenge

YouCan Coding Challenge is a simple web application that manages a stock of products.

# Getting started

1. To run the application, clone the repository and then run the following command to install the dependencies
```
composer install
```
2. Create a .env file from the .env.example blueprint file, you can run the following command to create a copy of the .env.example file and name it .env
```
cp .env.example .env
```
Then open the .env file and configure your database connection and other environment settings
3. Generate an application key:
```
php artisan key:gen
```
4. Run migrations to create database's tables:
```
php artisan migrate
```
5. You can execute the Seeder to generate dummy categories for testing purposes:
```
php artisan db:seed CategorySeeder
```
6. Generate storage link to get a shotcut from the storage folder to the public folder, this is important to access attachments from the web:
```
php artisan storage:link
```

# Features
YouCan Coding Challenge includes the following features:

## Pages
- Products' index page : provides a list of all products with the ability to sort by price or/and filter by a category
- Create Product page : provides a web form to create new product

## CLI
- You can also create new product by using this CLI command:
```
php artisan product:new
```