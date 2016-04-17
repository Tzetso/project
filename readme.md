1.Install composer https://getcomposer.org/download/
2.Install xampp https://www.apachefriends.org/index.html or use any other software for the MySQL server.
3.Open cmd and go to the project directory.
4.Once there type: composer install
5.In file explorer go to the project directory and rename the .env.example file to .env
6.In cmd while inside the project directory type: php artisan key:generate
7.In MySQL Workbench(or any other tool for creating databases) create a schema that is going to be the database.
8.Open the .env file in a text editor and change the value of DB_DATABASE to be equal 
to the schema name you created. Next change DB_USERNAME and DB_PASSWORD to be equal to the username and password
you use to establish the database connection.
9.Start the mysql server from the xampp controler.
10.In cmd while you are in the project directory type: php artisan migrate
11.After the tables are created type: php artisan db:seed --class=PrimeSeeder
12.If there were no problems type: php artisan serve
13.The project should be now accessible at http://localhost:8000/	