<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount, 2).' Tk.'; ?>";
        });
        Blade::directive('form_date', function ($date = null) {

                return "<?php if( $date != null){
                echo date(option('date_format'), strtotime($date));
                } ?>";
        });
        date_default_timezone_set('Asia/Dhaka');
    }
}
