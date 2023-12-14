<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Mary\Traits\Toast;

class Show extends Component
{
    use Toast;

    public Post $post;

    public function mount(): void
    {
        $this->post->load(['category', 'tags']);
    }

    public function toggleFeature(): void
    {
        $this->post->update(['is_featured' => ! $this->post->is_featured]);

        $this->success('Updated.');
    }

    public function delete(Post $post): void
    {
        $post->delete();
        $this->success('Post deleted.', redirectTo: route('posts.index'));
    }

    public function render()
    {
        return view('livewire.posts.show');
    }
}
