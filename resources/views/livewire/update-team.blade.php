<div>
    <div class="mb-2">
        <div class="hidden" style="display:{{ $buttonCity == 1 ? 'block' : '' }}">
            <div>
                <label class="sr-only" for="inputAddress">Adresse</label>
                <input class="inputForm mb-2 w-full" placeholder="Adresse" type="text" name="inputAddress" id="inputAddress" wire:model="inputAddress">
                @error('inputAddress')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col justify-between w-full mb-2">
                <label class="sr-only" for="inputZip">Code postal</label>
                <input class="inputForm mb-2" placeholder="Code postal" maxlength="5" type="text" name="inputZip" id="inputZip" wire:model="inputZip">
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
                <div class="flex justify-between items-center w-full sm:w-7/12 m-2">
                    <label for="inputPrimaryColor">Couleur primaire</label>
                    <div class="relative h-12 w-12 rounded-full overflow-hidden border-white border-2 cursor-pointer">
                        <input class="absolute -top-2 -left-2 h-24 w-24" type="color" name="inputPrimaryColor" id="inputPrimaryColor" wire:model="inputPrimaryColor">
                    </div>
                    @error('inputPrimaryColor')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between items-center w-full sm:w-7/12 m-2">
                    <label for="inputSecondaryColor">Couleur Secondaire</label>
                    <div class="relative h-12 w-12 rounded-full overflow-hidden border-white border-2 cursor-pointer">
                        <input class="absolute -top-2 -left-2 h-24 w-24" type="color" name="inputSecondaryColor" id="inputSecondaryColor" wire:model="inputSecondaryColor">
                    </div>
                    @error('inputSecondaryColor')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between items-center w-full sm:w-7/12 m-2">
                    <label for="inputAbbreviation">Initiales équipe</label>
                    <input class="text-primary inputForm" type="text" name="inputAbbreviation" id="inputAbbreviation" maxlength="4" wire:model="inputAbbreviation">
                    @error('inputAbbreviation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between items-center w-full sm:w-7/12 m-2">
                    <label for="inputNbrTeams">Nombre d'équipes</label>
                    <input class="text-primary inputForm" type="number" name="inputNbrTeams" id="inputNbrTeams" min="0" max="99" wire:model="inputNbrTeams">
                    @error('inputNbrTeams')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex justify-center">
                <button class="btn btnSuccess" type="button" value="Valider" wire:click="citySave">Modifier</button>
            </div>
        </div>
        <div class="block" style="display:{{ $buttonCity == 1 ? 'none' : '' }}">
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
        </div>
        @canany(['isManager', 'isSuperAdmin', 'isAdmin'])
        <div>
            @if($buttonCity == 1)
            <p class="absolute top-2 right-2 bg-danger font-bold text-xs px-2 py-1 rounded-md cursor-pointer" wire:click="clickButtonCity"><i class="fas fa-times-circle"></i></p>
            @else
            <p class="absolute top-2 right-2 bg-darkSuccess font-bold text-xs px-2 py-1 rounded-md cursor-pointer" wire:click="clickButtonCity"><i class="fas fa-pencil-alt"></i></p>
            @endif
        </div>
        @endcanany
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