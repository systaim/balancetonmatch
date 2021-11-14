<div x-show="open" @click.outside="open = false">
    <div wire:ignore id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v11.0"
                nonce="tGIyRgh0">
    </script>
    <a target="_blank"
        href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbalancetonmatch.com/%2Fmatches%2F{{ $match->id }}&amp;src=sdkpreparse"
        class="fb-xfbml-parse-ignore">
        <div>
            <div data-href="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}"
                data-layout="button" data-size="large">
                <div class="flex justify-center items-center">
                    <i class="fab fa-facebook text-2xl text-white"></i>
                    <img src="https://img.icons8.com/fluency/48/000000/facebook-circled.png"/>
                </div>
            </div>
        </div>
    </a>
</div>