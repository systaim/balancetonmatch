<div class="relative h-auto w-11/12 lg:w-6/12 bg-primary shadow-xl mx-auto py-8 px-4 text-white flex flex-col justify-start items-center">
    <figure class="">
        <img class="rounded-full h-32 w-32 object-cover border-2 border-white shadow-xl" src="{{ $user->profile_photo_url }}" alt="image de profil">
    </figure>
    <h3 class="text-center m-2">{{ $user->pseudo }}</h3>
    <h3 class="text-center m-2">{{ $user->club ? $user->club->name : "<< Pas de club >>"}}</h3>
    <p class="text-center m-2">role : {{ $user->role }}</p>
    <form class="flex flex-col" wire:submit.prevent="userUpdate">
        @if($user->role != "super-admin")
        <label for="role">Choisis un nouveau rôle</label>
        <select class="inputForm" name="role" id="role" wire:model="role">
            <option value="{{ $user->role }}">{{ $user->role }}</option>
            @can('isSuperAdmin')
            <option value="super-admin">super-admin</option>
            @endcan
            <option value="admin">admin</option>
            <option value="manager">manager</option>
            <option value="guest">guest</option>
        </select>
        <div>
            @if (session()->has('success'))
            <div class="message-alert success">
                <i class="fas fa-check-circle text-5xl text-white rounded-full shadow-xl"></i>
                {{ session('success') }}
            </div>
            @endif
        </div>
        <input class="btn btnSecondary" type="submit" value="Je valide">
        @endif
    </form>
</div>