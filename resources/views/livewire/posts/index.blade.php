<?php

use App\Enums\FeaturedStatus;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new class extends Component {
    use Toast, WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $state = 'all';

    public function posts(): mixed
    {
        return Post::query()
            ->with(['category'])
            ->when($this->search, fn(Builder $q) => $q->where('title', 'like', "%$this->search%"))
            ->when($this->state == 'published', fn(Builder $q) => $q->published())
            ->orderBy('title')
            ->paginate(10);
    }

    public function delete(Post $post): void
    {
        $post->delete();
        $this->success('Post deleted.');
    }

    public function states(): array
    {
        return [['id' => 'all', 'name' => 'All posts'], ['id' => 'published', 'name' => 'Published']];
    }

    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'title', 'label' => 'Title'], ['key' => 'category.name', 'label' => 'Category'], ['key' => 'is_featured', 'label' => 'Featured'], ['key' => 'created_at', 'label' => 'Created At'], ['key' => 'updated_at', 'label' => 'Updated At']];
    }

    public function with(): array
    {
        return [
            'posts' => $this->posts(),
            'headers' => $this->headers(),
            'states' => $this->states(),
        ];
    }
}; ?>

<div>
    <x-header title="Posts" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search ..." wire:model.live.debounce="search" icon="o-magnifying-glass">
                <x-slot:prepend>
                    <x-select wire:model.live="state" :options="$states" class="rounded-r-none bg-base-200" />
                </x-slot:prepend>
            </x-input>
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Create" link="/posts/create" icon="o-plus" class="btn-primary" responsive />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$posts" link="/posts/{id}">
            @scope('cell_is_featured', $post)
                <x-badge :value="FeaturedStatus::from($post->is_featured)->label()" class="{{ FeaturedStatus::from($post->is_featured)->color() }} badge-outline" />
            @endscope

            @scope('actions', $post)
                <div class="flex flex-nowrap gap-3">
                    <x-button wire:click="delete({{ $post->id }})" wire:confirm="Are you sure?" icon="o-trash"
                        class="btn-sm text-error" spinner />
                    <x-button link="/posts/{{ $post->id }}/edit" icon="o-pencil" class="btn-sm" />
                </div>
            @endscope
        </x-table>
        {{ $posts->links() }}
    </x-card>
</div>
