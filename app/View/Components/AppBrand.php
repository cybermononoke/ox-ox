<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppBrand extends Component
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
        return <<<'HTML'
                <a href="/" wire:navigate>
                    <!-- Hidden when collapsed -->
                    <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
                    <div class="flex items-center gap-2">
                        <!-- SVG as an image -->
                        <img src="{{ asset('svgs/cow-svgrepo-com.svg') }}" alt="Cow Icon" class="w-6 -mb-1 text-purple-500" />
                    </div>

                    </div>

                </a>
            HTML;
    }
}
