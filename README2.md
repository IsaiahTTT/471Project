steps to run (im sure you already know though lol)

1. Install PHP, Composer, and SQLite support.
2. Extract the project ZIP.
3. Open a terminal in the project directory.
4. Run:

   composer install

5. Copy .env.example to .env.
6. Configure SQLite in .env:

   DB_CONNECTION=sqlite

7. Create database/database.sqlite if its not there.
8. Run:

   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=ProductSeeder

9. Start the application:

   php artisan serve

10. Open http://471project.test