# Laravel - Core Module

## Requirements
    - Laravel Modules
    - Laravel Localization
    - Laravel Translatable
    - Eloquent Sluggable
    - Laracast Presenter
    - Laravel Debugbar

## Steps

### Assets

    1.Install and Setup
        https://nwidart.com/laravel-modules/v6/basic-usage/compiling-assets

    2.Add in your main app.js:

´´´
const moduleVueFiles = require.context('../../Modules', true, /\.vue$/i);
moduleVueFiles.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], moduleVueFiles(key).default));
´´´

    3. run npm run dev


### Laravel Localization

    1. Installation:    https://github.com/mcamara/laravel-localization#installation
    2. Usage:           https://github.com/mcamara/laravel-localization#usage

### Laravel Translatable

    1. Installation:    https://docs.astrotomic.info/laravel-translatable/installation

### Eloquent Sluggable

    1. Installation:    https://github.com/cviebrock/eloquent-sluggable#installation
    2. Usage:           https://github.com/cviebrock/eloquent-sluggable#updating-your-eloquent-models

### Laracast Presenter

    1. Installation:    https://github.com/laracasts/Presenter

### Laravel Debugbar

    1. Installation:    https://github.com/barryvdh/laravel-debugbar
    

