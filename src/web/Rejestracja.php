<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title>Trójbój siłowy</title>
	
	<meta name="description" content="Moje hobby" />
	<meta name="keywords" content="hobby, trójbój siłowy, siłownia, sport, zawody, ćwiczenia, trening, pasja, sekcja trójboju, ciężary " />

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="sticky.js"></script>

	<link href="style.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <style>
        .content{
            height:650px;
        }
        .error{
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
	
</head>

<body>
    <div id="container">

        <header>
        <div class="header">
            <div class="logo">
                <img src="img/logo.png" style="float:left;" alt="logo">    
                <span style="color: #B22222;">TRÓJBÓJ </span><span style="color: #07385c;">SIŁOWY</span>
                <div style="clear:both;"></div>
            </div>      
        </div>
        </header>

        <nav>
        <div class="nav">
            <ol>
                <li><a href="index.html">Strona Główna</a></li>
                <li><a href="dyscypliny.html">Dyscypliny</a></li>
                <li><a href="#">Federacje</a>
                    <ul>
                        <li><a href="http://www.pzkfits.pl/" target="_blank">PZKFiTS</a></li>
                        <li><a href="https://www.powerlifting.sport/" target="_blank">IPF</a></li>
                        <li><a href="https://www.europowerlifting.org/" target="_blank">EPF</a></li>
                    </ul>   
                </li>    
                <li><a href="rekordy.html">Rekordy</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
                <li><a href="galeria.php">Galeria</a></li>
            </ol>    
        </div>
        </nav>

        <main>
        <div class="content">
            <h1 style="color: #07385c;">Rejestracja</h1>
                <form style="text-align:center;" method="post">
                <label><p>Adres e-mail:</p><input type="email" name="mail" required/></label><br /><br />
                <label><p>Login:</p><input type="text" name="login" required/></label><br /><br />
                <label><p>Hasło:</p><input type="password" name="haslo" required/></label><br /><br />
                <label><p>Powtórz hasło:</p><input type="password" name="haslo2" required/></label><br /><br />
                <label><input type="submit" name="submit" value="Zarejestruj się"/></label>
                <label><input type="reset" value="Wyczyść"/></label><br /><br />
                <?php
                        if(isset($_POST['submit'])){
                            $validation = true;
                            $login = $_POST['login'];
                            $haslo = $_POST['haslo'];
                            $mail = $_POST['mail'];
                            $objectId = new MongoDB\BSON\ObjectId();

                            require ('/var/www/dev/vendor/autoload.php');
                            require_once('mangos.php');
                            $db = get_db();
                            $login_query = ['login' => $login];
                            $user_count = $db->users->count($login_query);

                            if($user_count > 0){
                                $validation = false;
                                echo "Login jest już zajęty!";
                            }
                            
                            if(!($haslo == $_POST['haslo2'])){
                                $validation = false;
                                echo "Hasła nie są takie same!";
                            }
                             
                            if($validation == true){
                                $haslo_hash = password_hash($_POST['haslo'], PASSWORD_DEFAULT);

                                $user = [ "login" => $login, "haslo" => $haslo_hash, "mail" => $mail, '_id' => $objectId];                                        
                                            
                                $db->users->insertOne($user);

                                echo "Zarejestrowano użytkownika!";
                                
                            }
                        }
                    ?>
                </form>
                    
        </div>
        </main>

        <footer>
        <div class="footer">
            Wszelkie prawa zastrzeżone &copy; Patryk Miszke_Grupa Ⅰ
        </div>   
        </footer>

    </div>
</body>
</html>

<script>
    document.getElementById('container').style.backgroundImage = 'url(img/tlo_js.jpg)';
 </script>   
