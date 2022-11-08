<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'posts';
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) => $query->where(
                'title',
                'like',
                '%' . $search . '%'
            )
        );
        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) => $query->whereHas(
                'category',
                fn($query) => $query->where('slug', $category)
            )
        );
        $query->when(
            $filters['author'] ?? false,
            fn($query, $user) => $query->whereHas(
                'user',
                fn($query) => $query->where('username', $user)
            )
        );
        $query->when(
            $filters['tags'] ?? false,
            fn($query, $tags) => $query->whereHas(
                'tags',
                fn($query) => $query->where('slug', $tags)
            )
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function incrementViewsCount()
    {
        $this->view_count++;
        return $this->save();
    }
    public function postView()
    {
        return $this->hasMany(PostView::class);
    }
    public function showPost()
    {
        return $this->postView()
            ->where('ip', '=', request()->ip())
            ->whereDate('created_at', Carbon::today())
            ->exists();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
