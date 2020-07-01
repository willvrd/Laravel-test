# Laravel - User Module

## Requirements
    - Laravel Passport
    - Laravel Permissions

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
## End Points

Route Base: `https://yourhost.com/api/user/v1/`

* #### User

* #### Auth

* #### Role

* #### Permission

## Backend

    ### Pages
    
        Index:  http://mysite/backend/user/users
        name:   admin.user.users.index

## Assets

    1. cd Modules/User
    2. npm install
    3. npm run dev
    4. In your view add:
    
 ```    
@section('scripts-modules')
    <script src="{{ mix('js/user.js') }}"></script>
@stop
 ```



