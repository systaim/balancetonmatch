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

        <div style="background-color: #091c3e; color: white; padding:1.5rem">
            <div
                style="padding: 1.5 rem;">
                <div>
                    <h2 class="bold">{{ $user['first_name'] }} {{ $user['last_name'] }} </h2>
                    <h3 class="bold">{{ $user['pseudo'] }}</h3>
                    <h3 class="bold">{{ $user['email'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
