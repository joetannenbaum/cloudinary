<?php

namespace JoeTannenbaum\Cloudinary\Laravel\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cloudinary.php',
            'cloudinary'
        );

        if (config('cloudinary.url')) {
            \Cloudinary::config_from_url(config('cloudinary.url'));
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                __DIR__ . '/../config/cloudinary.php' => config_path('cloudinary.php'),
        ]);

        Blade::directive('cloudinary', function ($expression) {
            $parts = collect(explode(',', $expression))->map(function ($part) {
                return trim($part);
            });

            $public_id = $parts->shift();

            $params = $parts->implode(',') ?: '[]';

            return "<?php echo cloudinary_url("
                    . "ltrim("
                        . "trim(config('cloudinary.base_folder'), '/') . '/' . $public_id"
                    . ", '/'), "
                    . "array_merge(config('cloudinary.default_params', []), $params)); ?>";
        });
    }
}
