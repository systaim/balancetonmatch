<div>
    <div class="mb-2">
        @if($club->city == null || $club->zip_code == null)
        <div class="flex justify-center">
            <button class="btn" wire:click="clickButtonCity">Renseigner l'adresse <i class="ml-2 fas fa-pencil-alt"></i></button></p>
        </div>
        @if($buttonCity == '1')
        <form class="w-8/12 m-auto" wire:submit.prevent="citySave()">
            @csrf
            <div>
                <input class="inputForm mb-2 w-full" placeholder="adresse" type="text" name="inputAddress" id="inputAddress" wire:model="inputAddress">
                @error('inputAddress')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col justify-between w-full mb-2">
                <input class="inputForm mb-2" placeholder="Code postal" type="text" name="inputZip" id="inputZip" wire:model="inputZip">
                @error('inputZip')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input class="inputForm" placeholder="Ville" type="text" name="inputCity" id="inputCity" wire:model="inputCity">
                @error('inputCity')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-center">
                <input class="btn btnPrimary" type="submit" value="Valider">
            </div>
            @endif
            @else
            <div class="flex justify-center items-start">
                <div class="mr-2">
                    <p>Adresse du siège : </p>
                </div>
                <div>
                    <p>{{ $club->address }}</p>
                    <p class="capitalize">{{ $club->zip_code }} {{ $club->city }}</p>
                </div>

                <div>
                    <p class="absolute top-2 right-2" wire:click="citySave()"><i class="fas fa-pencil-alt"></i></p>
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