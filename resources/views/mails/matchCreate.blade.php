<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Création d'un match par un utilisateur</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            min-width: 100% !important;
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            width: 80%;
        }

        .logo {
            width: 250px
        }

        .bold {
            font-weight: 700;
        }

        .secondary {
            color: #cdfb0a;
        }

    </style>
</head>

<body>
    <div>
        <img class="logo" src="https://balancetonmatch.com/images/logos/btmLogoJB.png" alt="logo">
        <div style="padding: 2.5rem;">
            <p>Voici les informations envoyées par
                <span>{{ $match['user_first_name'] }}</span>
                <span>{{ $match['user_last_name'] }}</span> ({{ $match['user_id'] }}) :
            </p>
        </div>

        <div style="background-color: #091c3e; color: white; padding:1.5rem">
            <div>
                <p>{{ $match['date_match'] }}</p>
            </div>
            <div style="display: flex; flex-wrap:wrap; flex-direction: column; justify-content: space-evenly; padding: 1.5 rem;">
                <div>
                    <h2 class="bold">{{ $match['homeTeam'] }}</h2>
                </div>
                <div>
                    <h2 class="secondary bold">VS</h2>
                </div>
                <div>
                    <h2 class="bold">{{ $match['awayTeam'] }}</h2>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
