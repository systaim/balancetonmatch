<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Facebook extends Component
{

    public function render()
    {
        return <<<'blade'
            <div>
                <a class="mx-auto" target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbalancetonmatch.com/%2Fmatches%2F{{ $match->id }}&amp;src=sdkpreparse"
                class="fb-xfbml-parse-ignore">
                    <div class="">
                        <div data-href="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}"
                            data-layout="button" data-size="large">
                            <div class="flex flex-col justify-center items-center">
                                <i class="fab fa-facebook text-4xl text-white mb-1"></i>
                                <p class="font-sans text-xs text-center my-1">Partager</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        blade;
    }
}
