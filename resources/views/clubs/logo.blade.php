<div>
    <div class="relative flex flex-col items-center justify-center mb-4 md:flex-row">
        <div class="m-4 flex w-28 h-28 rounded-full overflow-hidden shadow-xl">
            <div class="w-1/2" style="background-color:{{ $club->primary_color }}"></div>
            <div class="flex items-center" style="background:linear-gradient(90deg, {{ $club->primary_color }}, {{ $club->secondary_color }})">
                <div class="flex-grow-0 logo h-24 w-24">
                    @if ($club->logo_path)
                        <img class="object-contain" src="{{ asset($club->logo_path)}}" alt="Logo de {{ $club->name }}">
                    @else
                        <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
                    @endif
                    
                </div>
            </div>
            <div class="w-1/2" style="background-color:{{ $club->secondary_color }}"></div>
        </div>
        <div class="flex justify-center items-center relative">
            <div class="bg-primary text-secondary shadow-lg rounded-lg">
                <h2 class="mx-2 text-3xl lg:text-5xl text-center px-3">{{ $club->name }}</h2>
            </div>
        </div>
    </div>
</div>