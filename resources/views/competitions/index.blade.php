@extends('layout')
@section('content')

    <section class="body-font">
        <div class="container px-2 lg:py-36 py-4 mx-auto text-white">
            <div class="flex flex-wrap justify-center">
                <div class="relative p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                        <h3 class="title-font text-lg bg-primary text-white p-1">
                            RÉGIONALE <span class="pl-4 text-sm">R1 R2 R3</span>
                        </h3>
                        <img class="w-full object-cover object-center h-full"
                            src="{{ asset('images/terrain.jpg') }}" alt="Coupe de France" loading="lazy">
                        <div class="absolute top-12 left-2 text-gray-900">
                            <select name="region" id="region">
                                <option value="">Bretagne</option>
                            </select>
                            <select name="poules" id="poules" onchange="location = this.value;">
                                <option>Groupes</option>
                                <option value="#">R1</option>
                                @for ($i = 1; $i <= 3; $i++)
                                    <option value="region/bretagne/regional/1/groupe/{{ $i }}">Groupe
                                        {{ $chiffreEnLettre[$i] }}</option>
                                @endfor
                                <option value="#">R2</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="region/bretagne/regional/2/groupe/{{ $i }}">Groupe
                                        {{ $chiffreEnLettre[$i] }}</option>
                                @endfor
                                <option value="#">R3</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="region/bretagne/regional/3/groupe/{{ $i }}">Groupe
                                        {{ $chiffreEnLettre[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                        <h3 class="title-font text-lg bg-primary text-white p-1">
                            DISTRICT <span class="pl-4 text-sm">D1 D2 D3</span>
                        </h3>
                        <img class="w-full object-cover object-center h-full"
                            src="{{ asset('images/terrain2.png') }}" alt="Championnat district" loading="lazy">
                        <div class="absolute top-12 left-2 text-gray-900 flex flex-wrap justify-center">
                            <select class="mr-3" name="departement" id="departement"
                                onchange="choixDep(this.selectedIndex)">
                                <option>Départements</option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </select>
                            <div id="cotesDArmor" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option value="#">D1</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="region/bretagne/departement/22/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D2</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="region/bretagne/departement/22/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D3</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="region/bretagne/departement/22/district/3/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div id="morbihan" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option value="#">D1</option>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="region/bretagne/departement/56/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D2</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="region/bretagne/departement/56/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D3</option>
                                    @for ($i = 1; $i <= 11; $i++)
                                        <option value="region/bretagne/departement/56/district/3/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div id="finistere" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option value="#">D1</option>
                                    @for ($i = 1; $i <= 7; $i++)
                                        <option value="region/bretagne/departement/29/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D2</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="region/bretagne/departement/29/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D3</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="region/bretagne/departement/29/district/3/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div id="ileEtVilaine" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option value="#">D1</option>
                                    @for ($i = 1; $i <= 7; $i++)
                                        <option value="region/bretagne/departement/35/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option value="#">D2</option>
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="region/bretagne/departement/35/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/coupe-de-france">
                        <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                            <h3 class="title-font text-lg bg-primary text-white p-1">
                                COUPE DE FRANCE
                            </h3>
                            <img class="w-full object-cover object-center h-full" loading="lazy"
                                src="{{ asset('images/francecup.png') }}" alt="Coupe de France">
                        </div>
                    </a>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/coupe-de-bretagne">
                        <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                            <h3 class="title-font text-lg bg-primary text-white p-1">
                                COUPE DE BRETAGNE
                            </h3>
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/bzh.png') }}"
                                alt="coupe de Bretagne" loading="lazy">
                        </div>
                    </a>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/coupe-ange-lemee">
                        <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                            <h3 class="title-font text-lg bg-primary text-white p-1">
                                COUPE ANGE LEMÉE
                            </h3>
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/Capture d’écran 2022-09-22 à 18.28.01.png') }}" 
                            alt="coupe de Bretagne" loading="lazy">
                        </div>
                    </a>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                        <h3 class="title-font text-lg bg-primary text-white p-1">
                            COUPE DU DÉPARTEMENT
                        </h3>
                        <img class="w-full object-cover object-center h-full"
                            src="{{ asset('images/Capture d’écran 2022-09-22 à 18.28.35.png') }}" alt="Championnat district" loading="lazy">
                        <div class="absolute top-12 left-2 text-gray-900 flex flex-wrap justify-center">
                            <select class="mr-3" name="cpeDepartement" id="cpeDepartement" onchange="location = this.value;">
                                <option>Départements</option>
                                @foreach ($departements as $departement)
                                    <option value="competitions/coupe-du-departement/region/bretagne/departement/{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/amicaux">
                        <div class="relative h-64 border-2 rounded-sm overflow-hidden shadow-2xl border-none">
                            <h3 class="title-font text-lg bg-primary text-white p-1">
                                Matchs amicaux
                            </h3>
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/Capture d’écran 2022-09-22 à 18.29.56.png') }}"
                                alt="Coupe de France" loading="lazy">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    window.onload = function() {
        let departement = document.getElementById('departement').value
        cotesDArmor = document.getElementById('cotesDArmor')
        morbihan = document.getElementById('morbihan')
        finistere = document.getElementById('finistere')
        ileEtVilaine = document.getElementById('ileEtVilaine')
    }

    function choixDep(i) {
        if (i == 1) {
            cotesDArmor.classList.add('block')
            cotesDArmor.classList.remove('hidden')
            morbihan.classList.add('hidden')
            finistere.classList.add('hidden')
            ileEtVilaine.classList.add('hidden')
        }
        if (i == 2) {
            finistere.classList.add('block')
            finistere.classList.remove('hidden')
            cotesDArmor.classList.add('hidden')
            morbihan.classList.add('hidden')
            ileEtVilaine.classList.add('hidden')
        }
        if (i == 4) {
            morbihan.classList.add('block')
            morbihan.classList.remove('hidden')
            cotesDArmor.classList.add('hidden')
            finistere.classList.add('hidden')
            ileEtVilaine.classList.add('hidden')
        }
        if (i == 3) {
            ileEtVilaine.classList.add('block')
            ileEtVilaine.classList.remove('hidden')
            cotesDArmor.classList.add('hidden')
            finistere.classList.add('hidden')
            morbihan.classList.add('hidden')
        }


    }
</script>
