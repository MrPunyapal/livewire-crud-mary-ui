<?php

use App\Models\Post;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
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
        $this->success('Post deleted.', redirectTo: '/posts');
    }
}; ?>

<div>
    {{--  IMAGE --}}
    <div class="h-64 h-[227px] mb-8 rounded-lg bg-base-300">
        <img src="{{ $post->image }}" class="object-cover h-full w-full rounded-lg" />
    </div>

    <x-header :title="$post->title" subtitle="Created at {{ $post->created_at }}" separator />

    {{-- INFO --}}
    <div class="flex justify-between -mt-6 pb-3">
        <div>
            <x-badge :value="$post->category->name" class="badge-primary" />

            {{-- TAGS--}}
            @foreach($post->tags as $tag)
                <x-badge :value="$tag->name" />
            @endforeach
        </div>
        {{-- ACTIONS --}}
        <div class="flex items-center">
            <x-button
                :label="$post->is_featured ? 'Featured' : 'Feature'"
                wire:click="toggleFeature"
                icon="o-star"
                tooltip="Toggle featured"
                @class(["btn-ghost btn-sm", "text-amber-500" => $post->is_featured])
                spinner />

            <x-button label="Delete" wire:click="delete({{ $post->id }})" wire:confirm="Are you sure?" icon="o-trash" class="btn-ghost btn-sm text-error" spinner />
            <x-button label="Edit" link="/posts/{{ $post->id }}/edit" icon="o-pencil" class="btn-ghost btn-sm" />
        </div>
    </div>

    {{-- BODY --}}
    <div class="mt-5 leading-7">
        {!! $post->body !!}
    </div>

</div>
