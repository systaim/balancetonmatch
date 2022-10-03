<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="p-4 sm:w-8/12 md:w-7/12 lg:w-6/12 bg-white shadow-xl">
        <h2 class="text-primary text-2xl px-4 m-auto pb-4">Je me connecte</h2>
        <div class="flex flex-col">
            <label class="hidden" for="email">{{ __('Email') }}</label>
            <div class="flex my-1 focus:outline-none justify-center">
                <input class="inputForm" id="email" type="email" name="email" required
                    autofocus autocomplete="email" placeholder="email">
            </div>
        </div>
        <div class="flex flex-col">
            <label class="hidden" for="password">{{ __('Password') }}</label>
            <div class="relative flex justify-center">
                <div class="relative">
                    <input class="inputForm" type="password" name="password" id="password" required
                        placeholder="mot de passe">
                    <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute right-3 top-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <script>
                    const togglePassword = document.querySelector("#togglePassword");
                    const password = document.querySelector("#password");

                    togglePassword.addEventListener("click", function() {
                        // toggle the type attribute
                        const type = password.getAttribute("type") === "password" ? "text" : "password";
                        password.setAttribute("type", type);
                    });
                </script>
            </div>
            <div class="flex flex-col items-center mt-4">
                <div class="flex justify-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="flex justify-center my-6">
            <button class="btn btnSecondary">
                {{ __('Login') }}
            </button>
        </div>
        <h2 class="text-primary text-2xl px-4 m-auto pb-4">Ou je m'inscris</h2>
        <div class="w-full">
            <a class="block bg-primary text-white py-3 px-4 text-center shadow-lg" href="/register">Créer un compte</a>
        </div>
    </div>
</form>
