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


# FormRequest Validation

- $ php artisan make:request StoreJoblistingRequest

NOTE: You can as well use Precognition
[see - Precognition](https://laravel.com/docs/10.x/precognition#introduction)


# Create a Resource

NOTE:  Meant for Single Model customization's on specifically what to return,
maybe cherry-pick or add even new properties which need to belong to that single
resource. 

- $ php artisan make:resource PostResource

# Create a Resource Collection

Similar to resource but this time with multiple models which have relationships.
Best fit for related models.
- $ php artisan make:resource AllJoblistingsCollection --collection


## Normalization

- Avoid data redundancy and ensures data consistency. 

For example, if a company's name or logo changes, you only need to update it in one place (the companies table), and all related job listings will automatically reflect the change.


### HINT: Company::firstOrCreate()
Try to find the first record in the companies table that matches the given attributes i.e. company_name
but don't save it to the database yet.

###  NOTE: $company->save()
If it's a new instance (created by firstOrCreate()), it will be inserted as a new row in the companies table. 
If it's an existing instance (found by firstOrCreate()), any changes made to the instance 
(e.g., updating the logo) will be saved to the corresponding row in the table.
