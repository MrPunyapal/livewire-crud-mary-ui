<?php

namespace App\Livewire\Posts;

use App\Enums\FeaturedStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast, WithFileUploads;

    #[Validate('required|int')]
    public int $category_id;

    #[Validate('required')]
    public string $title;

    #[Validate('required')]
    public string $slug;

    #[Validate('required')]
    public string $description;

    #[Validate('required')]
    public string $body;

    #[Validate('required|date')]
    public string $published_at;

    #[Validate('required')]
    public bool $is_featured;

    #[Validate('required')]
    public array $tags;

    #[Validate('image|max:1024')]
    public $image;

    public function featured(): array
    {
        // TODO
        return [
            ['id' => FeaturedStatus::NOT_FEATURED, 'name' => 'No'],
            ['id' => FeaturedStatus::FEATURED, 'name' => 'Yes'],
        ];
    }

    public function save(): void
    {
        $post = Post::create($this->validate());
        $post->tags()->sync($this->tags);
        $url = $this->image->store('posts', 'public');
        $post->update(['image' => url("/storage/$url")]);

        $this->success('Post updated', redirectTo: route('volt.posts.show', $post));
    }

    public function render(): mixed
    {
        return view('livewire.posts.create', [
            'categories' => Category::all(),
            'allTags' => Tag::all(),
            'featured' => $this->featured(),
        ]);
    }
}
