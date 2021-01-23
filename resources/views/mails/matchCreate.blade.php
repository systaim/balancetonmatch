<h2>Match créé</h2>

<div>
    <p>Voici les informations envoyées par
        <span class="capitalize">{{ $match['user_first_name'] }}</span> <span class="uppercase">{{ $match['user_last_name'] }}</span> ({{ $match['user_id'] }}) :
    </p>
</div>

<div class="">
    <div class="text-center flex justify-center font-bold">
        <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match['date_match']}}</p>
    </div>
    <div class="grid grid-cols-12">
        <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
            <div class="ml-2">
                <p class="text-xs md:text-base md:font-bold truncate">{{$match['homeTeam']}}</p>
            </div>
        </div>
        <div class="col-span-2 flex flex-row justify-center items-center">
            <div class="flex items-center justify-center text-secondary">
                <p class="text-3xl p-2 font-bold">VS</p>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center col-span-5 overflow-hidden">
            <div class="ml-2">
                <p class="text-xs md:text-base md:font-bold truncate">{{$match['awayTeam']}}</p>
            </div>
        </div>
    </div>
</div>