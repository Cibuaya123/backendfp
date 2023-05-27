<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\User;
use App\Observers\UserObserver;

use App\Models\Recipe;
use App\Observers\RecipeObserver;

use App\Models\Tool;
use App\Observers\ToolObserver;

use App\Models\Ingredient;
use App\Observers\IngredientObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::Observe(UserObserver::class);

        Recipe::Observe(RecipeObserver::class);
        Tool::Observe(ToolObserver::class);
        Ingredient::Observe(IngredientObserver::class);
    }
}
