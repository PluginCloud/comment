<?php

namespace PluginCloud\Comment;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use PluginCloud\Comment\Commands\GenerateSitemap;
use PluginCloud\Comment\Http\Kernel;
use PluginCloud\Comment\Http\Middleware\UserSessionMiddleware;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Comment $extension)
    {
        if (! Comment::boot()) {
            return ;
        }

        $this->mergeConfigFrom(__DIR__.'/../config/comment.php', 'comment');
        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'comment');
        }

        $this->commands([
            GenerateSitemap::class,
        ]);
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [__DIR__.'/../resources/assets' => public_path('vendor/plugin-cloud/comment')],
                'comment'
            );
            $this->publishes(
                [__DIR__.'/../resources/lang' => resource_path('lang/')],
                'comment'
            );
            $this->publishes(
                [__DIR__.'/../resources/public' => public_path('/')],
                'comment'
            );
            $this->publishes(
                [__DIR__.'/../resources/views' => resource_path('views/comment/')],
                'comment'
            );
            $this->publishes(
                [__DIR__.'/../database/migrations' => database_path('migrations')],
                'comment'
            );
            $this->publishes(
                [__DIR__.'/../database/seeds' => database_path('seeds')],
                'comment'
            );
        }

        $this->app->booted(function () {
            $this->app->router->aliasMiddleware("logged", UserSessionMiddleware::class);
            /*Route::domain("www.shoucangwu.net")->namespace(__NAMESPACE__.'\Http\Controllers\Home')->name("comment.home.")->middleware(["web"])
                ->group( __DIR__.'/../routes/beian.php');*/
            Route::namespace(__NAMESPACE__.'\Http\Controllers\Home')->name("comment.home.")->middleware(["web"])
                ->group( __DIR__.'/../routes/home.php');
            Comment::routes(function (){
                Route::namespace(__NAMESPACE__.'\Http\Controllers\Admin')
                    ->prefix('comment')->name("comment.admin.")
                    ->group( __DIR__.'/../routes/admin.php');
            });
        });
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('sitemap:generate')->daily();
        });
    }
}
