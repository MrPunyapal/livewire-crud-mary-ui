@use('App\Enums\FeaturedStatus')
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
            <x-button label="Create" link="/volt/posts/create" icon="o-plus" class="btn-primary" responsive />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$posts" link="/volt/posts/{id}" with-pagination>
            @scope('cell_is_featured', $post)
            <x-badge :value="FeaturedStatus::from($post->is_featured)->label()"
                class="{{ FeaturedStatus::from($post->is_featured)->color() }} badge-outline" />
            @endscope

            @scope('actions', $post)
            <div class="flex flex-nowrap gap-3">
                <x-button wire:click="delete({{ $post->id }})" wire:confirm="Are you sure?" icon="o-trash"
                    class="btn-sm text-error" spinner />
                <x-button link="{{ route('volt.posts.edit', $post) }}" icon="o-pencil" class="btn-sm" />
            </div>
            @endscope
        </x-table>
    </x-card>
</div>
