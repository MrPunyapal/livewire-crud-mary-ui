<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast, WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $state = 'all';

    // Reset table pagination only if these properties has changed
    public function updated($property)
    {
        if (in_array($property, ['search', 'state'])) {
            $this->resetPage();
        }
    }

    public function posts(): mixed
    {
        return Post::query()
            ->with(['category'])
            ->when($this->search, fn (Builder $q) => $q->where('title', 'like', "%$this->search%"))
            ->when($this->state == 'published', fn (Builder $q) => $q->published())
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
        return [
            ['id' => 'all', 'name' => 'All posts'],
            ['id' => 'published', 'name' => 'Published'],
        ];
    }

    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'category.name', 'label' => 'Category'],
            ['key' => 'is_featured', 'label' => 'Featured'],
            ['key' => 'created_at', 'label' => 'Created At'],
            ['key' => 'updated_at', 'label' => 'Updated At'],
        ];
    }

    public function render(): mixed
    {
        return view('livewire.posts.index', [
            'posts' => $this->posts(),
            'headers' => $this->headers(),
            'states' => $this->states(),
        ]);
    }
}
