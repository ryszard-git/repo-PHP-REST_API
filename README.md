
Prezentacja danych zawierających 7 ostatnich notowań kursów walut przez NBP.




Serwis przyjmuje następujące parametry:
---------------------------------------
1.

.../weekly/?currency={CURRENCY}   - gdzie {CURRENCY} to trzyliterowy kod waluty (standard ISO 4217) , na przykład: 'Euro' (EUR).
...............................

Generowany jest pojedynczy wykres liniowy dla wskazanej waluty (7 ostatnich notowań dziennych kursów średnich).



2.

.../weekly/?currencies={CURRENCY1}:{CURRENCY2}:{CURRENCY3} ...   - można użyć wielu walut, oddzielając je dwukropkiem.
..............................................................

Generowanych jest tyle wykresów liniowych, ile walut wskazano w parametrach wywołania (7 ostatnich notowań dziennych kursów średnich).
Gdy wskażemy tylko jedną walutę, domyślnie zostanie wygenerowany wykres notowań dla waluty 'Euro', bez względu na wskazaną walutę.




UWAGI KOŃCOWE:
--------------

Kod waluty można podać za pomocą dużych, jak i małych liter.

Pominięcie parametrów skutkuje wygenerowaniem jednego wykresu liniowego dla waluty 'Euro' (EUR).

Serwis posiada właściwość RWD.