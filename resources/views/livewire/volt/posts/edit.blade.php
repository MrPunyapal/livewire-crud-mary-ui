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

    public Post $post;

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

    #[Rule('sometimes|nullable|image|max:1024')]
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

        $this->success('Post updated', redirectTo: "/posts/{$this->post->id}");
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
    <x-header :title="$post->title" separator />

    <div class="grid lg:grid-cols-2 lg:pr-20 gap-8">
        <x-form wire:submit="save">
            <x-input label="Title" wire:model="title" />
            <x-input label="Slug" wire:model="slug" />
            <x-input label="Description" wire:model="description" />
            <x-datetime label="Published at" wire:model="published_at" icon="o-calendar" />
            <x-select label="Category" wire:model="category_id" :options="$categories" />
            <x-choices-offline label="Tags" wire:model="tags" :options="$allTags" multiple searchable />
            <x-file label="Cover image" wire:model="coverImage" />

            <div class="h-64 mb-8 rounded-lg border border-dashed border-black">
                @if ($coverImage)
                    <img src="{{ $coverImage->temporaryUrl() }}" class="object-cover h-full w-full rounded-lg">
                @else
                    <img src="{{ $post->image }}" class="object-cover h-full w-full rounded-lg"">
                @endif
            </div>

            <x-radio label="Featured" wire:model="is_featured" :options="$featured" />
            <x-textarea label="Body" id="post-body" wire:model="body" rows="8" />

            <x-slot:actions>
                <x-button label="Cancel" link="/posts" />
                <x-button label="Save" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="save" />
            </x-slot:actions>
        </x-form>
        <div>
            <img src="/images/edit.png" class="mx-auto" />
        </div>
    </div>
</div>
