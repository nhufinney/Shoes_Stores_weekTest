SHOES_STORES APP.

1. Function: this app is to manage stores selling shoes. A user can access information about a brand of shoes is being available for sale in what stores and find out a store is selling what brands. The user can change information about stores and shoes brands as needed.

2. Set up requirements: the program needs to install 3 independencies that are Silex, Twig and PHPUnit.

3. Author: Nhu Finney.

4. Contact or question: Epicodus.com.

5. License and copyright: free and open to everyone.

6. Database structure:

    Shoes database has 3 tables:

    1. brands table: 2 columns: id, shoe;
    2. stores table: 2 columns: id, store_name;
    3. brands_stores: 4 colums: id, shoe_id, store_id.

7. Setup instructions

    Clone this git repository:

    1.1 Copy the repo remote address https://github.com/nhufinney/Brands_Stores_WeekTest.git from the bottom right side under HTTPS clone URL

    1.2 Run a git clone https://github.com/nhufinney/Brands_Stores_WeekTest.git in a terminal window

    Use Composer to install required dependencies in the composer.json file:

    2.1 In terminal window, change to the Shoes directory using cd Shoes;

    2.2 Install the dependencies in the composer.json file by typing composer install

    Import the database schema:

    3.1 Open a new terminal tab and start your postgres database by typing postgres

    3.2 Open a new terminal tab/window and type psql to enter the database command line

    3.3 Create a database named shoes by typing CREATE DATABASE shoes;

    3.4 Connect to the database with \c shoes

    3.5 Import the development database schema with \i shoes.sql

    3.6 Create the test database by running the SQL query CREATE DATABASE shoes_test WITH TEMPLATE shoes;

    Set up your development server

    4.1 In a new terminal tab/window, navigate to the web folder inside the Shoes/ main project directory

    4.2 Start a php server by typing php -S localhost:8000

    4.3 Open a web browser and connect to the address http://localhost:8000/

8. Troubleshooting

    If the database schema import doesn't work you can manually create the Postgres database on your local machine using the following Postgres commands.

    Note: The application has not been tested to work with MySQL.

    CREATE DATABASE shoes;
    \c shoes
    CREATE TABLE brands (id serial PRIMARY KEY, shoe varchar);
    CREATE TABLE stores (id serial PRIMARY KEY, store_name varchar);
    CREATE TABLE brands_stores (id serial PRIMARY KEY, shoe_id int, store_id int);
    CREATE DATABASE shoes_test WITH TEMPLATE shoes;

9. Technologies used

    HTML5

    CSS3

    Bootstrap ver 3.3.1

    PHP (tested to run on PHP ver 5.6.6)

    Silex ver 1.2.3

    Twig ver 1.18.0

    PHPUnit ver 4.5.0

    PostgreSQL ver 9.4.1

####ENJOY THE APP!!!
