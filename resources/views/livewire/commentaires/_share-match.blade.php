<div x-show="open" class="flex justify-center items-center p-2">
    <div class="relative">
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
                    <div class="border rounded-full h-10 w-10 flex justify-center items-center m-1 shadow-lg">
                        <p class="text-xl">f</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="relative border rounded-full h-10 w-10 flex justify-center items-center m-1 shadow-lg" wire:ignore>
        <textarea class="hidden" id="input_copy">{{ request()->url() }}</textarea>
        <button type="button" id="copy" onclick="copyToClipBoard()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
        </button>
        <div id="copy_link" class="hidden absolute bottom-10 left-2 text-sm bg-darkGray text-white p-2 rounded-lg z-20">
            lien copié
        </div>
        <script>
            function copyToClipBoard() {
                var content = document.getElementById('input_copy').innerHTML;

                navigator.clipboard.writeText(content)
                    .then(() => {
                        console.log("Text copied to clipboard...")
                        document.getElementById('copy_link').classList.add('block')
                        document.getElementById('copy_link').classList.remove('hidden')
                    })
                    .catch(err => {
                        console.log('Something went wrong', err);
                    })
            }
        </script>
    </div>
</div>
