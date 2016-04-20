<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Obnovite geslo</h2>

<div>
    <p>Spoštovani,.</p>

    <p>prejeli smo zahtevo za obnovitev vašega gesla v sistemu ZIS. Če ste jo zahtevali vi, kliknite na povezavo in sledite navodilom: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
    </p>

    <p>Če ste prejeli to elektronsko sporočilo ne da bi ga zahtevali na ZIS-RS, ignorirajte to sporočilo.</p>
</div>

</body>
</html>
