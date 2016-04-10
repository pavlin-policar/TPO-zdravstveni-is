<div class="sub-title">Osebni zdravniki</div>

Osebni zdravnik: {{ $patient->hasDoctor() ? $patient->doctor->fullName : 'Oseba nima osebnega zdravnika' }}
<br>
Osebni zobozdravnik: {{ $patient->hasDentist() ? $patient->dentist->fullName : 'Oseba nima osebnega zobozdravnik' }}