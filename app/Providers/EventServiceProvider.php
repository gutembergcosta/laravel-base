<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\UserCreated;
use App\Events\RequisitaNovaSenha;

use App\Listeners\SendEmailNovoCadastro;
use App\Listeners\SendEmailTokenNovaSenha;

use App\Models\Item;
use App\Models\User;
use App\Models\Arquivo;

use App\Observers\ArquivoObserver;
use App\Observers\ItemObserver;
use App\Observers\UserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        UserCreated::class => [
            SendEmailNovoCadastro::class,
        ],
        RequisitaNovaSenha::class => [
            SendEmailTokenNovaSenha::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Item::observe(ItemObserver::class);
        Arquivo::observe(ArquivoObserver::class);
        User::observe(UserObserver::class);
    }
}
