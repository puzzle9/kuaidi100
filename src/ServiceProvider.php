<?php
namespace Puzzle9\Kuaidi100;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Express::class, function () {
            return new Express(config('services.kuaidi100.key'), config('services.kuaidi100.customer'), config('services.kuaidi100.callbackurl'));
        });

        $this->app->alias(Express::class, 'Kuaidi100');
    }

    public function provides()
    {
        return [Express::class, 'Kuaidi100'];
    }
}
