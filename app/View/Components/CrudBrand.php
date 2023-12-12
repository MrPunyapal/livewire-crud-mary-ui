<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CrudBrand extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
                <a href="/" wire:navigate>
                    <div class="flex items-center">
                            <x-icon name="o-rocket-launch" class="w-6 text-purple-500" />
                            <span class="ml-2 text-3xl mr-3 bg-gradient-to-r from-purple-500 to-pink-300 bg-clip-text text-transparent font-bold">
                               <span class="font-black">Livewire</span>
                            </span>
                    </div>
                </a>
                blade;
    }
}
