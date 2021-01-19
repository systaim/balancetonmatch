<footer class="bg-gray-900 mb-0 w-full relative  bottom-0 mt-12">
    <div class="flex flex-col justify-around text-white py-12">
        <div class="flex justify-center p-2">
            <a class="px-4" href="https://www.facebook.com/balancetonmatch" target="_blank"><img src="{{ asset('images/logoFacebook.png') }}" alt="logo Facebook" class="w-10"></a>
            <!-- <a class="px-4" href="http://" target="_blank"><img src="{{ asset('images/logoInsta.png') }}" alt="logo Instagram" class="w-10"></a> -->
            <a class="px-4" href="https://twitter.com/BalanceMatch" target="_blank"><img src="{{ asset('images/logoTwitter.png') }}" alt="logo Twitter" class="w-10"></a>
        </div>
        <!-- <div class="text-center m-2 p-2">
            <p class="font-bold mb-4">Plus d'infos...</p>
            <ul>
                <li>Mention légales</li>
                <li>Qui sommes nous ?</li>
                <li>Le foot amateur</li>
                <li></li>
            </ul>
        </div> -->
        <div>
            <form class="text-white flex flex-col lg:w-6/12 m-auto" action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <label for="prenom">prenom</label>
                <input class="inputForm text-primary" type="text" name="prenom" id="prenom">

                <label for="nom">nom</label>
                <input class="inputForm text-primary" type="text" name="nom" id="nom">

                <label for="email">mail</label>
                <input class="inputForm text-primary" type="email" name="email" id="email">

                <label for="message">Ton message</label>
                <textarea class="inputForm" name="message" id="message" rows="10"></textarea>

                <input class="btn btnPrimary" type="submit" value="Envoyer">
            </form>
        </div>
    </div>

</footer>