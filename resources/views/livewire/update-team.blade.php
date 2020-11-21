
<div>
    <div class="mb-2">
        @if($club->city == null || $club->zip_code == null)
        <p>Adresse : <button class="btn" wire:click="citySave()">à renseigner 🖊</button></p>
        @if($buttonCity == 'cliqué')
        <form wire:submit.prevent="citySave()">
            @csrf
            <textarea class="text-primary rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full py-2" placeholder="adresse" type="text" name="inputAddress" id="inputAddress" wire:model="inputAddress"></textarea>
            @error('inputAddress')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="text-primary rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline py-2" placeholder="Code postal" type="text" name="inputZip" id="inputZip" wire:model="inputZip">
            @error('inputZip')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="text-primary rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline py-2" placeholder="Ville" type="text" name="inputCity" id="inputCity" wire:model="inputCity">
            @error('inputCity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="btn btnPrimary" type="submit" value="Valider">
            @endif
            @else
            <div class="flex flex-row justify-between">
                <div class="flex flex-row">
                    <p>Adresse : </p>
                    <div class="flex flex-col ml-2">
                        <p>{{ $club->address }}</p>
                        <p class="capitalize">{{ $club->zip_code }} {{ $club->city }}</p>
                    </div>
                </div>
                <div>
                    <p wire:click="citySave()">🖊</p>
                </div>
            </div>
        </form>
        @endif
    </div>
    <!-- <div class="mb-2">
        @if($club->number_teams == null)
        <p>Nombre d'équipes sénior: <button class="btn" wire:click="nbrTeamsSave()">à renseigner 🖊</button></p>
        @if($buttonNbrTeams == 'cliqué')
        <form wire:submit.prevent="nbrTeamsSave()">
            @csrf
            <input class="text-primary rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline py-2 ml-4" placeholder="Nombre d'équipes" type="number" name="inputNbrTeams" id="inputNbrTeams" wire:model="inputNbrTeams">
            @error('inputZip')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="btn btnPrimary" type="submit" value="Valider">
        </form>
        @endif
        @else
        <div class="flex flex-row justify-between">
            <p>Nombre d'équipes sénior : {{ $club->number_teams }}</p>
            <p class="text-right" wire:click="nbrTeamsSave()">🖊</p>
        </div>
        @endif
    </div> -->
</div>