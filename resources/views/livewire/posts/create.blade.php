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
            <div class="h-64 mb-8 rounded-lg border border-dashed border-black">
                <img src="{{ $image->temporaryUrl() }}" class="object-cover h-full w-full rounded-lg">
            </div>
            @endif

            <x-radio label="Featured" wire:model="is_featured" :options="$featured" />
            <x-textarea label="Body" id="post-body" wire:model="body" rows="8" />

            <x-slot:actions>
                <x-button label="Cancel" link="{{route('volt.posts.index')}}" />
                <x-button label="Create post" type="submit" icon="o-paper-airplane" class="btn-primary"
                    spinner="save" />
            </x-slot:actions>
        </x-form>
        <div>
            <img src="/images/edit.png" class="mx-auto" />
        </div>
    </div>
</div>
