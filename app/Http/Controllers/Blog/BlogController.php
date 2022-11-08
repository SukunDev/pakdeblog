<?php

namespace App\Http\Controllers\Blog;

use App\Models\Pages;
use App\Models\Posts;
use App\Models\PostView;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Posts::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(5);
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        $blogPostSchema = Schema::webSite()
            ->name(strip_tags(AppHelper::instance()->getOptions('site_name')))
            ->description(AppHelper::instance()->getOptions('description'))
            ->url(AppHelper::instance()->getOptions('site_url'))
            ->potentialAction(
                Schema::searchAction()
                    ->target(
                        AppHelper::instance()->getOptions('site_url') .
                            '?search={search_term_string}'
                    )
                    ->setProperty(
                        'query-input',
                        'required name=search_term_string'
                    )
            );
        return view('index', [
            'posts' => $posts,
            'popular_post' => $popularPost,
            'blog_post_schema' => $blogPostSchema->toScript(),
        ]);
    }
    public function filterIndex($name, $value)
    {
        $filter = [$name => $value];
        $posts = Posts::whereNotNull('published_at')
            ->filter($filter)
            ->latest('published_at')
            ->paginate(5);
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        $blogPostSchema = Schema::webSite()
            ->name(strip_tags(AppHelper::instance()->getOptions('site_name')))
            ->description(AppHelper::instance()->getOptions('description'))
            ->url(AppHelper::instance()->getOptions('site_url'))
            ->potentialAction(
                Schema::searchAction()
                    ->target(
                        AppHelper::instance()->getOptions('site_url') .
                            '?search={search_term_string}'
                    )
                    ->setProperty(
                        'query-input',
                        'required name=search_term_string'
                    )
            );
        return view('index', [
            'posts' => $posts,
            'popular_post' => $popularPost,
            'blog_post_schema' => $blogPostSchema->toScript(),
        ]);
    }
    public function singlePost(Posts $post)
    {
        if (!$post->published_at) {
            return abort(404);
        }
        $relatedPost = Posts::whereNotNull('published_at')
            ->where('category_id', $post->category->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        $blogPostSchema = Schema::BlogPosting()
            ->mainEntityOfPage(
                Schema::WebPage()->setProperty(
                    '@id',
                    AppHelper::instance()->getOptions('site_url') .
                        '/' .
                        $post->slug
                )
            )
            ->headline($post->title)
            ->description($post->excerpt)
            ->image($post->thumbnail)
            ->url(
                AppHelper::instance()->getOptions('site_url') .
                    '/' .
                    $post->slug
            )
            ->datePublished($post->published_at)
            ->dateModified($post->updated_at->format('Y-m-d H:i:s'))
            ->author(Schema::person()->name($post->user->name))
            ->publisher(
                Schema::organization()
                    ->name(
                        strip_tags(
                            AppHelper::instance()->getOptions('site_name')
                        )
                    )
                    ->logo(Schema::imageObject()->url($post->thumbnail))
            );
        if ($post->showPost()) {
            return view('single.index', [
                'post' => $post,
                'popular_post' => $popularPost,
                'related_post' => $relatedPost,
                'blog_post_schema' => $blogPostSchema->toScript(),
            ]);
        }
        $post->incrementViewsCount(); //count the view
        PostView::createViewLog($post);
        return view('single.index', [
            'post' => $post,
            'popular_post' => $popularPost,
            'related_post' => $relatedPost,
            'blog_post_schema' => $blogPostSchema->toScript(),
        ]);
    }
    public function singlePages(Pages $page)
    {
        if (!$page->published_at) {
            return abort(404);
        }
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        return view('single.pages.index', [
            'page' => $page,
            'popular_post' => $popularPost,
        ]);
    }
    public function contactIndex()
    {
        $popularPost = Posts::whereNotNull('published_at')
            ->latest('view_count')
            ->limit(3)
            ->get();
        return view('single.contact.index', [
            'popular_post' => $popularPost,
        ]);
    }
}
