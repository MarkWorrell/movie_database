Project name: Aglet Movie Database
PHP Version: 7.3
MySql Version 8
Laravel Framework 8.54

To run the project:
run from command line "composer install"
run from command line "npm install"

copy the .env.example to .env and edit the following:

APP_KEY=base64:9TAZsMz953AbbtZtgIZHZenfW9YHJ0jiZQT0UvjufN0=
DB_USERNAME=<mysql_database_username>
DB_PASSWORD=<mysql_database_password>
MAIL_DRIVER=<mail_protocal>
MAIL_HOST=<mail_host>
MAIL_PORT=<mail_port>
MAIL_USERNAME=<mail_username>
MAIL_PASSWORD=<mail_password>
MAIL_ENCRYPTION=<encryption_type>
MAIL_FROM_ADDRESS=<email_from_address>

run from command line "php artisan migrate"
import the sql data from the sql folder in the dir root.

For further help: https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/

My choice of language for this project was PHP using the Laravel framework. This is the language and framework that I have used for development for many years. I have used many other frameworks in my time and find Laravel to be the one that suits my requirements. It has large community support and has a vast amount of libraries increasing project productivity and adheres to the MVC principles.

My approach for this project was to establish the connections to the API endpoints and consume the data within the constraints of the brief. The API only returns 20 results per page, so to get the desired result of 45 records, I have to make 3 calls to the endpoint. I then insert the data into the database and select 45 records which are paginated to 9 results. The API's are called on the page load, but this could also be achieved using a scheduled task. The configuration for the API can be found in the table "configs". The rest of the project is simply displaying the results in an elegant and user friendly way. I maintain the principles of not repeating code, and ensure that the project is scalable and future proof.

The favourites are set using a cookie. This is used to compile the list of the users favourites when logged in. The project would benefit from a cookie usage acceptance banner.

The contact form has two levels of validation. An email is sent to the user and admin when the form is submitted.

For your convenience I have hosted the application here: https://www.kccs.co.za/assessment/



