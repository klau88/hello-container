## About this project

A Laravel 11 application built for HelloContainer to queue and send notifications whenever a customer authorizes the release of a 'bill of lading (BL)' to the consignee, which uses one of HelloContainer's contracts.

This project includes some API routes which accept and return JSON so that it can be extended for API calls in the future. There is no authentication required to use the API routes for now. Authentication and authorization could be added in the future as well.

To not have the home page be a 404, I have simply added a link there to the orders index page.

**URIs:**
- `/` - Homepage
- `/orders` - Overview of orders (50 per page)
- `/orders/create` - A form to create an order
- `/orders/unprocessed` - Overview of unprocessed orders
- `/api/orders` - API route to list orders
- `/api/orders/create` - API route to create an order

## Requirements
- PHP 8.2+
- [Laravel 11](https://laravel.com/)
- [Laravel Herd (or Valet)](https://herd.laravel.com/) or [Docker/Laravel Sail](https://laravel.com/docs/11.x/sail)
- [Composer](https://getcomposer.org/)
- [(Optional) Postman or any API testing tool](https://www.postman.com/downloads/)

## After cloning this project
**If you use Docker, here's how to install Composer dependencies if you don't have Composer installed:**<br>
<pre><code>docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
composer install --ignore-platform-reqs</code></pre>

Optional: Replace php82 with the PHP version you're using.<br> 
For example: If you're using PHP 8.3 then replace 82 with 83. 

**After installing Laravel Sail:**<br>
`./vendor/bin/sail up -d`

**Optional:**<br>
Add an alias for `./vendor/bin/sail` at the bottom either your `.bashrc` or `.zshrc`:<br>
`alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`
So whenever you need to use `./vendor/bin/sail`, you can just use `sail` or whatever your alias is. 

**PHP Artisan**<br>
Artisan commands are needed to install dependencies and run necessary commands like migrations.<br>
- For Sail, it's `./vendor/bin/sail artisan`
- For Laravel Herd/Valet or any other PHP install: `php artisan`

## Installation
**Dependencies**<br>
If you haven't installed Composer dependencies yet, run `composer install`

**Environment**<br>
`cp .env.example .env`

**Run migrations:**<br>
`./vendor/bin/sail artisan migrate` or `php artisan migrate`

**Generate application key:**<br>
`./vendor/bin/sail artisan key:generate` or `php artisan key:generate`
For testing: `./vendor/bin/sail artisan key:generate --env=testing` or `php artisan key:generate --env=testing`

**NPM:**<br>
- `npm install`
- `npm run build`

**Run tests:**<br>
`./vendor/bin/sail artisan test` or `php artisan test`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
