# Laravel - User Module

## Requirements
    - Laravel Passport
    - Laravel Permissions

## Steps

    1. Go to Config/auth.php
        - Change the model from provider to: Modules\User\Entities\User::class,
    2. Run migration: php artisan module:migrate User
    3. Run this command: php artisan user:role-permission:init

## Backend

    ### Pages
    
        Index:  http://mysite/backend/user/users
        name:   admin.user.users.index


