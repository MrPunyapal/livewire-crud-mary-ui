<?php

namespace App\Support;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

class Spotlight
{
    public function search(Request $request): Collection
    {
        return collect()
            ->merge($this->actions($request->search))
            ->merge($this->posts($request->search));
    }

    public function posts(string $search = ''): Collection
    {
        return Post::query()
            ->with('category')
            ->where('title', 'like', "%$search%")
            ->orWhereRelation('category', 'name', 'like', "%$search%")
            ->take(5)
            ->get()
            ->map(function (Post $post) {
                return [
                    'name' => $post->title,
                    'description' => $post->category->name,
                    'avatar' => $post->image,
                    'link' => "/posts/{$post->id}"
                ];
            });
    }

    public function actions(string $search = ''): Collection
    {
        $icon = Blade::render("<x-icon name='o-bolt' class='w-11 h-11 p-2 bg-yellow-50 rounded-full' />");

        return collect([
            [
                'name' => 'Create Post',
                'description' => 'Create a new Post',
                'icon' => $icon,
                'link' => '/posts/create'
            ],
        ])->filter(function (array $item) use ($search) {
            return str($item['name'] . $item['description'])
                ->lower()
                ->contains(str($search)->lower());
        });
    }
}
