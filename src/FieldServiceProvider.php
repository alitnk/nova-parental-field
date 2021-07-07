<?php

namespace Wama\NovaParentalField;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Nova::serving(function (ServingNova $event) {
        //     Nova::script('nova-parental-field', __DIR__.'/../dist/js/field.js');
        //     Nova::style('nova-parental-field', __DIR__.'/../dist/css/field.css');
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
