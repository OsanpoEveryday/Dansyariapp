<?php

namespace App\Providers;

use App\Policies\ItemPolicy;
use App\Policies\CategoryPolicy;
use App\Item;
use App\Category;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Item::class => ItemPolicy::class,
        Category::class => CategoryPolicy::class,
        Rule::class => RulePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('deleteItem','App\Policies\ItemPolicy@userItem');
    }
}
