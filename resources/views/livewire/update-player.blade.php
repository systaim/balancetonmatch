<div>
    <div class="w-16 h-16 items-center logo mr-3" wire:click="clickPhoto">
        <img class="object-contain" src="{{ asset($player->avatar_path)}}" alt="avatar">
    </div>
    @auth
    @if($photo == 'cliqué')
    <form wire:submit.prevent="playerSave">
        <div class="text-white m-auto my-4">
            <input type="file" wire:model="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg,mov,mp4,m4v">
            @error('file')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">modifier</button>
    </form>
    @endif
    @endauth
</div>