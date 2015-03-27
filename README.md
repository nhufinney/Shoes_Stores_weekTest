SHOES_STORES APP.

1. Function: this app is to manage stores selling shoes. A user can access information about a brand of shoes is being available for sale in what stores and find out a store is selling what brands. The user can change information about stores and shoes brands as needed.

2. Set up requirements: the program needs to install 3 independencies that are Silex, Twig and PHPUnit.

3. Author: Nhu Finney.

4. Contact or question: Epicodus.com.

5. License and copyright: free and open to everyone.

6. Database structure:

    Shoes database has 3 tables:

    1. brands table: 2 columns: id, shoes;
    2. stores table: 2 columns: id, store;
    3. brands_stores: 4 colums: id, shoes_id, store_id, sold.

7. SQL code:

CREATE DATABASE shoes;
\c shoes
CREATE TABLE brands (id serial PRIMARY KEY, shoes varchar);
CREATE TABLE stores (id serial PRIMARY KEY, store varchar);
CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int, sold boolean);
CREATE DATABASE shoes_test WITH TEMPLATE shoes;

8. Import database:

In psql: CREATE DATABASE shoes;

\c shoes;

In new terminal window:

\i shoes.sql
