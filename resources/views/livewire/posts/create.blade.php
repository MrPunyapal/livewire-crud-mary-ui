<?php

use App\Enums\FeaturedStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

new class extends Component {
    use Toast, WithFileUploads;

    #[Rule('required|int')]
    public int $category_id;

    #[Rule('required')]
    public string $title;

    #[Rule('required')]
    public string $slug;

    #[Rule('required')]
    public string $description;

    #[Rule('required')]
    public string $body;

    #[Rule('required|date')]
    public string $published_at;

    #[Rule('required')]
    public bool $is_featured;

    #[Rule('required')]
    public array $tags;

    #[Rule('image|max:1024')]
    public $image;

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
        $post = Post::create($this->validate());
        $post->tags()->sync($this->tags);
        $url = $this->image->store('posts', 'public');
        $post->update(['image' => url("/storage/$url")]);

        $this->success('Post updated', redirectTo: "/posts/{$post->id}");
    }

    public function with(): array
    {
        return [
            'categories' => Category::all(),
            'allTags' => Tag::all(),
            'featured' => $this->featured()
        ];
    }
}; ?>

<div>
    <x-header title="Create Post" separator />

    <div class="grid lg:grid-cols-2 lg:pr-20 gap-8">
        <x-form wire:submit="save">
            <x-input label="Title" wire:model="title" />
            <x-input label="Slug" wire:model="slug" />
            <x-input label="Description" wire:model="description" />
            <x-datetime label="Published at" wire:model="published_at" icon="o-calendar" />
            <x-select label="Category" wire:model="category_id" :options="$categories" placeholder="---" />
            <x-choices-offline label="Tags" wire:model="tags" :options="$allTags" multiple searchable />
            <x-file label="Cover image" wire:model="image" />

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="rounded-lg">
            @endif

            <x-radio label="Featured" wire:model="is_featured" :options="$featured" />
            <x-textarea label="Body" id="post-body" wire:model="body" rows="8" />

            <x-slot:actions>
                <x-button label="Cancel" link="/posts" />
                <x-button label="Create post" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="save" />
            </x-slot:actions>
        </x-form>
        <div>
            <img src="/images/edit.png" class="mx-auto" />
        </div>
    </div>
</div>
