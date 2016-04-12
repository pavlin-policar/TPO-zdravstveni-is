<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Zaključite registracijo</h2>

<div>
    <p>Ustvarjen je bil vaš račun na portalu ZIS-RS.</p>

    <p>Da bi zaključili registracijo, morate potrditi elektronski naslov. To lahko storite tako, da sledite povezavi {!! link_to_route('registration.do-confirm-email', 'TUKAJ', [$confirmationCode]) !!} ali pa ročno vnesite aktivacijsko kodo:
        <br>
        <b>Aktivacijska koda:</b> {{ $confirmationCode }}
    </p>

    <p>Vaše začasno geslo je <b> {{ $password }} </b>. Prosimo vas, da ga čim prej po aktivaciji računa spremenite.</p>

    <p>Če ste prejeli to elektronsko sporočilo ne da bi se registrirali na ZIS-RS, ignorirajte to sporočilo.</p>
</div>

</body>
</html>