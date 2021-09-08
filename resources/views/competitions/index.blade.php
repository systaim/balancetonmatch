@extends('layout')
@section('content')

    <section class="body-font">
        <div class="container px-2 lg:py-36 py-4 mx-auto text-white">
            <div class="flex flex-wrap justify-center">
                <div class="realtive p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <div class="relative h-64 border-2 rounded-lg overflow-hidden shadow-2xl border-none">
                        <img class="w-full object-cover object-center h-full"
                            src="{{ asset('images/championnat-region.jpg') }}" alt="Coupe de France">
                        <div class="absolute top-3 left-2 text-gray-900">
                            <select name="poules" id="poules" onchange="location = this.value;">
                                <option>Groupes</option>
                                <option>R1</option>
                                @for ($i = 1; $i <= 3; $i++)
                                    <option value="region/3/regional/1/groupe/{{ $i }}">Groupe
                                        {{ $chiffreEnLettre[$i] }}</option>
                                @endfor
                                <option>R2</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="region/3/regional/2/groupe/{{ $i }}">Groupe
                                        {{ $chiffreEnLettre[$i] }}</option>
                                @endfor
                                <option>R3</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="region/3/regional/3/groupe/{{ $i }}">Groupe
                                        {{ $chiffreEnLettre[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">
                            RÉGIONALE <span class="pl-4 text-sm">R1 R2 R3</span></h3>
                    </div>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <div class="relative h-64 border-2 rounded-lg overflow-hidden shadow-2xl border-none">
                        <img class="w-full object-cover object-center h-full"
                            src="{{ asset('images/championnat-district.jpg') }}" alt="Championnat district">
                        <div class="absolute top-3 left-2 text-gray-900 flex flex-wrap justify-center">
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
                                    <option>D1</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="region/3/departement/22/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D2</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="region/3/departement/22/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D3</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="region/3/departement/22/district/3/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div id="morbihan" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option>D1</option>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="region/3/departement/56/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D2</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="region/3/departement/56/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D3</option>
                                    @for ($i = 1; $i <= 11; $i++)
                                        <option value="region/3/departement/56/district/3/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div id="finistere" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option>D1</option>
                                    @for ($i = 1; $i <= 7; $i++)
                                        <option value="region/3/departement/29/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D2</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="region/3/departement/29/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D3</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="region/3/departement/29/district/3/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div id="ileEtVilaine" class="hidden">
                                <select onchange="location = this.value;">
                                    <option>Groupes</option>
                                    <option>D1</option>
                                    @for ($i = 1; $i <= 7; $i++)
                                        <option value="region/3/departement/35/district/1/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                    <option>D2</option>
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="region/3/departement/35/district/2/groupe/{{ $i }}">
                                            Groupe {{ $chiffreEnLettre[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">
                            DISTRICT <span class="pl-4 text-sm">D1 D2 D3 D4</span></h3>
                    </div>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/coupe-de-france-2021-2022">
                        <div class="relative h-64 border-2 rounded-lg overflow-hidden shadow-2xl border-none">
                            <img class="w-full object-cover object-center h-full"
                                src="{{ asset('images/Coupe-de-france.jpg') }}" alt="Coupe de France">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">
                                COUPE DE FRANCE</h3>
                        </div>
                    </a>
                </div>
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/coupe-de-bretagne-2021-2022">
                        <div class="relative h-64 border-2 rounded-lg overflow-hidden shadow-2xl border-none">
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/bzh.png') }}"
                                alt="coupe de Bretagne">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">
                                COUPE DE BRETAGNE</h3>
                        </div>
                    </a>
                </div>
                {{-- <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="matches/coupe-de-bretagne-2021-2022">
                        <div class="relative h-64 border-2 rounded-lg overflow-hidden shadow-2xl border-none">
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/bzh.png') }}" alt="coupe de Bretagne">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">COUPE DÉPARTEMENTALE</h3>
                        </div>
                    </a>
                </div> --}}
                <div class="p-4 w-11/12 lg:w-1/3 h-64 my-2">
                    <a href="competitions/amicaux-2021-2022">
                        <div class="relative h-64 border-2 rounded-lg overflow-hidden shadow-2xl border-none">
                            <img class="w-full object-cover object-center h-full" src="{{ asset('images/amicaux.jpg') }}"
                                alt="Coupe de France">
                            <h3 class="absolute bottom-1 left-1 title-font text-lg bg-primary text-white p-1 rounded-lg">
                                Matchs amicaux</h3>
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
        console.log(departement);
    }

    function choixDep(i) {
        console.log(i);
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
