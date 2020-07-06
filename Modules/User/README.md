# Laravel - User Module

## Requirements
    - Laravel Passport
    - Permissions

## Steps

    1. Go to Config/auth.php
        - Change the model from provider to: Modules\User\Entities\User::class,
        
    2. Run migration:
        ```
        php artisan module:migrate User
        ```
    3. Run this command: 
        ```
        php artisan user:role-permission:init
        ```
### Assets

    1. cd Modules/User
    2. npm install
    3. npm run dev
    4. In your view add:
    
 ```    
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
 ```

 ### Laravel Passport

    1. Installation:    https://laravel.com/docs/7.x/passport#installation

    - Consuming Your API With JavaScript:
        https://laravel.com/docs/7.x/passport#consuming-your-api-with-javascript

 ### Permissions

    1. Installation:    https://docs.spatie.be/laravel-permission/v3/installation-laravel/
    2. Usage:           https://docs.spatie.be/laravel-permission/v3/basic-usage/basic-usage/


## End Points

Route Base: `https://yourhost.com/api/user/v1/`

* #### User

* #### Auth

* #### Role

* #### Permission

## Backend

    ### Pages
    
        Index:  http://mysite/en/backend/user/users
        name:   locale.admin.user.users.index

        Index:  http://mysite/en/backend/user/roles
        name:   locale.admin.user.roles.index
