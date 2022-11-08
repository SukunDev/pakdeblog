<?php

namespace App\Console;

use App\Models\Tags;
use App\Models\User;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\PostView;
use App\Models\Categories;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule
            ->call(function () {
                $sitemap = Sitemap::create()->add(Url::create('/contact'));
                $posts = Posts::whereNotNull('published_at')
                    ->latest('published_at')
                    ->get();
                foreach ($posts as $post) {
                    $sitemap->add(Url::create("/{$post->slug}"));
                }
                $pages = Pages::all();
                foreach ($pages as $page) {
                    $sitemap->add(Url::create("/p/{$page->slug}"));
                }
                $users = User::all();
                foreach ($users as $user) {
                    $sitemap->add(Url::create("/author/{$user->username}"));
                }
                $tags = Tags::all();
                foreach ($tags as $tag) {
                    $sitemap->add(Url::create("/tags/{$tag->slug}"));
                }
                $categories = Categories::all();
                foreach ($categories as $category) {
                    $sitemap->add(Url::create("/category/{$category->slug}"));
                }
                $sitemap->writeToFile(public_path('sitemap.xml'));
            })
            ->description('Update sitemap.xml')
            ->everyMinute();
        $schedule
            ->call(function () {
                PostView::truncate();
            })
            ->description('Delete PostView')
            ->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
