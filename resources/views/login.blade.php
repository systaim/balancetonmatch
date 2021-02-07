<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="p-4 sm:w-8/12 md:w-7/12 lg:w-6/12 bg-white shadow-xl">
        <h2 class="text-primary text-2xl px-4 m-auto pb-4">Je me connecte</h2>
        <div class="flex flex-col">
            <label class="hidden" for="email">{{ __('Email') }}</label>
            <div class="flex w-full my-1 focus:outline-none justify-center">
                <span class="inline-flex items-center px-3 rounded-l-md">
                    <i class="fas fa-user text-lg"></i>
                </span>
                <input class="inputForm border-2 border-darkGray" id="email" type="email" name="email" required autofocus autocomplete="email" placeholder="email">
            </div>
        </div>
        <div class="flex flex-col">
            <label class="hidden" for="password">{{ __('Password') }}</label>
            <div class="flex w-full my-1 focus:outline-none justify-center">
                <span class="inline-flex items-center px-3 rounded-l-md">
                    <i class="fas fa-unlock-alt"></i>
                </span>
                <input class="inputForm border-2 border-darkGray" type="password" name="password" required placeholder="mot de passe">
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