<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\User\Console\RolePermissionCommand;

use Illuminate\Support\Facades\Gate;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'User';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'user';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerBindings();

        $this->commands([
            RolePermissionCommand::class
        ]);

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerBindings()
    {

        $this->app->bind(
            'Modules\User\Repositories\UserRepository',
            function () {
                $repository = new \Modules\User\Repositories\Eloquent\EloquentUserRepository(new \Modules\User\Entities\User());
                if (! config('app.cache')) {
                    return $repository;
                }
                return new \Modules\User\Repositories\Cache\CacheUserDecorator($repository);
            }
        );

        $this->app->bind(
            'Modules\User\Repositories\RoleRepository',
            function () {
                $repository = new \Modules\User\Repositories\Eloquent\EloquentRoleRepository(new \Modules\User\Entities\Role());
                if (! config('app.cache')) {
                    return $repository;
                }
                return new \Modules\User\Repositories\Cache\CacheRoleDecorator($repository);
            }
        );

        $this->app->bind(
            'Modules\User\Repositories\PermissionRepository',
            function () {
                $repository = new \Modules\User\Repositories\Eloquent\EloquentPermissionRepository(new \Modules\User\Entities\Permission());
                if (! config('app.cache')) {
                    return $repository;
                }
                return new \Modules\User\Repositories\Cache\CachePermissionDecorator($repository);
            }
        );

    }

}
