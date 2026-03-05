<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use Tailwind-compatible pagination views
        Paginator::useTailwind();

        // Register admin middleware alias
        $this->app['router']->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);

        // Blade directive for star ratings
        Blade::directive('stars', function (string $expression) {
            return "<?php echo str_repeat('★', {$expression}) . str_repeat('☆', 5 - {$expression}); ?>";
        });
    }
}
