<div>
    <div class="mb-2">
        @if($club->city == null || $club->zip_code == null)
        <div class="flex justify-center">
            <button class="btn" wire:click="clickButtonCity">Renseigner l'adresse <i class="ml-2 fas fa-pencil-alt"></i></button></p>
        </div>
        @endif
        @if($buttonCity == '1')
        <div>
            <div>
                <label class="sr-only" for="inputAddress">Adresse</label>
                <input class="inputForm mb-2 w-full" placeholder="Adresse" type="text" name="inputAddress" id="inputAddress" wire:model="inputAddress">
                @error('inputAddress')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col justify-between w-full mb-2">
                <label class="sr-only" for="inputZip">Code postal</label>
                <input class="inputForm mb-2" placeholder="Code postal" type="text" name="inputZip" id="inputZip" wire:model="inputZip">
                @error('inputZip')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label class="sr-only" for="inputCity">Ville</label>
                <input class="inputForm" placeholder="Ville" type="text" name="inputCity" id="inputCity" wire:model="inputCity">
                @error('inputCity')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col">
                <div class="flex justify-between w-full sm:w-7/12 m-2">
                    <label for="inputPrimaryColor">Couleur primaire</label>
                    <input type="color" name="inputPrimaryColor" id="inputPrimaryColor" wire:model="inputPrimaryColor">
                </div>
                <div class="flex justify-between w-full sm:w-7/12 m-2">
                    <label for="inputSecondaryColor">Couleur Secondaire</label>
                    <input type="color" name="inputSecondaryColor" id="inputSecondaryColor" wire:model="inputSecondaryColor">
                </div>
                <div class="flex justify-between w-full sm:w-7/12 m-2">
                    <label for="inputNbrTeams">Nombre d'équipes</label>
                    <input class="text-primary" type="number" name="inputNbrTeams" id="inputNbrTeams" wire:model="inputNbrTeams">
                </div>
            </div>
            <div class="flex justify-center">
                <input class="btn btnSuccess" type="submit" value="Valider" wire:click="citySave">
            </div>
        </div>
        @else
        <div>
            <div class="flex justify-center items-start">
                <div class="mr-2">
                    <p>Adresse du siège : </p>
                </div>
                <div>
                    <p>{{ $club->address }}</p>
                    <p class="capitalize">{{ $club->zip_code }} {{ $club->city }}</p>
                </div>
            </div>
            <div class="flex justify-center items-start">
                <p>Nombre d'équipes sénior : {{ $club->number_teams }}</p>
            </div>
            <div>
                <p class="absolute top-2 right-2 cursor-pointer" wire:click="clickButtonCity"><i class="fas fa-pencil-alt"></i></p>
            </div>
        </div>
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