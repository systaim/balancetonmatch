<h2>Devenir MANAGER</h2>

<p>Demande effectuée par : </p>
<p>Prénom nom : {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} (ID : {{ Auth::user()->id }})</p>

<p>Club : {{ Auth::user()->club->name }}</p>
