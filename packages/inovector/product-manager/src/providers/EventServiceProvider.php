<?php

namespace Inovector\ProductManager\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Inovector\ProductManager\Events\FiltersApplied;
use Inovector\ProductManager\Listeners\LogAndSendDiscount;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FiltersApplied::class => [
            LogAndSendDiscount::class,
        ],
    ];
}
