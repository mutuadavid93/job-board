##### Job Board

Create UserFactory
- $ php artisan make:factory UserFactory --model=User

Create UserSeeder
- $ php artisan make:seeder UserSeeder


###### Laravel Cashier

Create a migration which makes use of a specific table
- $ php artisan make:migration "update users table with subscriptions" --table=users

A migration which creates a subscriptions table
- $ php artisan make:migration "create subscriptions table" --create=subscriptions
