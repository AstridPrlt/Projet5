## What is this app ?
This app permits to handle events and a community of members.
- Events : admin can create, modify and delete. Users can register for events and pay
- Community : members can create and modify their profile, see other members' one, add members in their list of favorites and contact them


## Tools and requirements
Built with [Laravel 7](https://laravel.com/docs/7.x/), [Vue.js 2](https://vuejs.org/) and [Bootstrap](https://getbootstrap.com/)

Uses :
[Stripe](https://stripe.com/) for payments

Github and Google for login


## How to install it ?
Clone the repository

Create a database

Create a .env file with all information

Install dependencies :
```sh
composer install
npm install

```

Migrate all tables in database
```sh
php artisan migrate

```

Create a symbolic link between storage and public folder
```sh
php artisan storage:link

```
