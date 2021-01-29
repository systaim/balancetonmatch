<h2>Une nouvelle demande de création de clubs</h2>

<p>Prénom nom : {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>

<p>Région : {{ $contact['region'] }}</p>

<p>district : {{ $contact['departement'] }}</p>

<p>nom du club souhaité: {{ $contact['nomClub'] }}</p>
