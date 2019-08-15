# Wunderfleet Code Challenge

This is a simple application that has 3-steps formulary to collect the payment data of future customers of Wunderfleet!

To tackle the proposed problem I choosed the Laravel PHP framework altogether with the Vue.js JavaScript framework.

With the Laravel Framework I developed two simple API endpoints:

 - `POST /api/customers` - To create the customer with the data filled on the form;
 - `GET /api/customers/{customer_uid}` - Retrieve the updated customer data.
 
Laravel has a built-in queue processing system that allows us to run heavy and/or I/O blocking routines in the 
background of the server without making the client request wait until we call the Wunderfleet fake payment API.

Then, I used Vue.js as a Single Page Application that calls these endpoints. 
This way we can decouple the interface from the backend anytime we need, also this is a highly scalable architecture.

## Getting started

To run this project you have to:

 - `composer install` - Install all package dependencies using composer
 - `cp .env.example .env` - Copy the `.env.example` to `.env` and configure the `DB_*` related variables. 
   I left the `PAYMENT_DATA_URL` already filled in the .env.example to ease the configuration.
     - Laravel can support both MySQL and SQLite, I suggest running with MySQL.
 - `php artisan migrate` - After configuring the database connection, run the migrate to create all tables. **Don't forget to prior create the database on the DBMS or the file in case of using SQLite.**
 - `php artisan serve` - Finally, run this command to start a local development server;
    - Just access `http://127.0.0.1:8000` and you already should see the first step of the registration form.

## Database schema

To keep it simple, we just have 3 tables for this system to run:

![Tables Diagram](https://gabrielf.com/img/wunder_tables.png)

## Q&A
 - What more can you optimize for performance on your project?
   - I already prepared the architecture to use processing queues to handle the API calls, 
   for thus we need to change the `QUEUE_CONNECTION` environment variable in the `.env` file to use something 
   like Beanstalkd or RabbitMQ or Redis or even Amazon SQS (all of them has drivers available). 
   Then with the queue system of your choice the only thing we need 
   to do is to bring up a worker running `php artisan queue:work --queue=default` 
   ([more on Laravel Queues here](https://laravel.com/docs/5.8/queues));
   - Another thing that can optimize our performance is to avoid 
   [doing pool requests like we do every 5 seconds until the Payment API call is done in the background](https://github.com/gabfr/wunderfleet-task/blob/master/resources/js/store/actions.js#L12) 
   and start working with web sockets and broadcast, this way we have a connection point to dispatch the customer 
   update right to the client's browser.
 - What can be better in your project?
   - I choosed to develop this solution with simplicity in mind, using only one table to store data of various entities
   is not the optimal solution in the matter of data modeling. Altought to keep this project simple to evaluate and run
   I opted to make it this way. But, in the future normalize the address and the bank information of the customer in 
   another table can ease future maintenances on this database.
 - Why did you use an string primary key in your customer table, instead of using the default auto_increment?
   - As we are working with an exposed API endpoint, using `auto_increment` would give us a breach for other users fetching another users data. So, to make it more difficult to fetch it, we use extremely random string id keys ([`uniqid`](http://php.net/uniqid) - and `md5` the generated id).



