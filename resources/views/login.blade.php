<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="p-4 sm:w-8/12 md:w-7/12 lg:w-full bg-white rounded-lg shadow-xl">
        <h2 class="text-primary text-2xl text-center px-4 m-auto pb-4">Connecte toi</h2>
        <div class="flex flex-col">
            <label class="hidden" for="email">{{ __('Email') }}</label>
            <div class="flex w-full my-1 focus:outline-none justify-center">
                <span class="inline-flex items-center px-3 rounded-l-md">
                    <i class="fas fa-user text-lg"></i>
                </span>
                <input class="inputForm border-2 border-darkGray" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="email">
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
            <div class="flex justify-center">
                <input type="checkbox" class="form-checkbox" name="remember">
                <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
            </div>
        </div>
        <div class="flex justify-center my-6">
            <button class="btn btnSecondary">
                {{ __('Login') }}
            </button>
        </div>
        <div class="flex justify-between items-center font-bold lg:mx-16 xl:mx-32">
            @if (Route::has('password.request'))
            <a class="underline text-sm" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
            <a class="underline text-sm" href="/register">Créer un compte</a>
        </div>
    </div>
</form>