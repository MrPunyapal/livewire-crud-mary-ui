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

class Edit extends Component
{
    use Toast, WithFileUploads;

    public Post $post;

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

    #[Validate('sometimes|nullable|image|max:1024')]
    public $coverImage;

    public function mount(): void
    {
        $this->fill($this->post);
        $this->tags = $this->post->tags->pluck('id')->all();
    }

    public function featured(): array
    {
        // TODO
        return [
            ['id' => FeaturedStatus::NOT_FEATURED, 'name' => 'No'],
            ['id' => FeaturedStatus::FEATURED, 'name' => 'Yes']
        ];
    }

    public function save(): void
    {
        $this->post->update($this->validate());
        $this->post->tags()->sync($this->tags);

        if ($this->coverImage) {
            $url = $this->coverImage->store('posts', 'public');
            $this->post->update(['image' => url("/storage/$url")]);
        }

        $this->success('Post updated', redirectTo: route('volt.posts.show', $this->post));
    }

    public function render()
    {
        return view('livewire.posts.edit',[
            'categories' => Category::all(),
            'allTags' => Tag::all(),
            'featured' => $this->featured()
        ]);
    }
}
