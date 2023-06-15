##### Job Board

Create UserFactory
- $ php artisan make:factory UserFactory --model=User

Create UserSeeder
- $ php artisan make:seeder UserSeeder


# Jobs and Queues :: 

Create Queue table
- $ php artisan queue:table

Run a Job's migration
- $ php artisan migrate

Create the Job to run in the queue
- $ php artisan make:job NotifyPaymentSucceededJob

Finally run the worker to execute jobs on the queue
- $ php artisan queue:work


# Tasks are scheduled using command:

Create a command. Remind these are suited for tasks that need to happen regularly 
without manual intervention e.g. Sending Reminders To Customers, Clearing Trash Bin e.t.c.
- $ php artisan make:command RemindOfUnpaidOrders

Start the Scheduled Command
- $ php artisan app:remind-of-unpaid-orders


# Send Notifications 

Create a notification
- $ php artisan make:notification RemindOfUnpaidOrdersNotification
