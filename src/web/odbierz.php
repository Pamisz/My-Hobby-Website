<?php
    if(isset($_GET['Imię']) and isset($_GET['Nazwisko']) and isset($_GET['Płeć']) and isset($_GET['Wiek']) and isset($_GET['Ćwiczenie']) and isset($_GET['Waga']) and isset($_GET['Komentarz'])){
        echo '<b>DANE</b><br><br>';
        echo 'Imię: '; echo $_GET['Imię'];

        echo '<br>Nazwisko: '; echo $_GET['Nazwisko'];

        echo '<br>Płeć: '; echo $_GET['Płeć'];

        echo '<br>Wiek: '; echo $_GET['Wiek'];

        echo '<br>Ulubione ćwiczenie: '; echo $_GET['Ćwiczenie'];

        echo '<br>Waga: '; echo $_GET['Waga'];

        echo '<br>Doświadczenie: '; echo $_GET['Komentarz'];
    }
    else{
        echo 'Nie wypełniono poprawnie formularza!';
    }
?>
