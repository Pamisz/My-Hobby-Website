<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title>Trójbój siłowy</title>
	
	<meta name="description" content="Moje hobby" />
	<meta name="keywords" content="hobby, trójbój siłowy, siłownia, sport, zawody, ćwiczenia, trening, pasja, sekcja trójboju, ciężary " />

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="sticky.js"></script>    

	<link href="style.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
    <style>
        .content{
            height:1000px;
        }
    </style>

</head>

<body id="body">

    <div id="container">

    <header>
        <div class="header">
        <div style="float: right; margin-right: 1%;">
        <?php if (!isset($_SESSION['user_id'])) { ?>
        <a href="Logowanie.php" style="text-decoration: none;"><button>Zaloguj się</button></a><br />
        <a href="Rejestracja.php" style="text-decoration: none;"><button>Zarejestruj się</button></a>
        <?php } else { ?>
        <a href="logout.php" style="text-decoration: none;"><button>Wyloguj się</button></a>
        <?php }?>

        
        </div>
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
            <article>
                    <div class="content">
                        <h1 style="color: #07385c;">Galeria polubionych zdjęć</h1>
                        
                        <div style="margin-left: auto; margin-right: auto;">
                            <?php 
                            include('images_load.php');
                            require('images_show_liked.php'); 
                            ?>
                        </div>
                        <div style="clear: both;"></div>
                        
                    </div>
            </article>   
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
    document.getElementById('body').style.backgroundImage = 'url(img/tlo_js.jpg)';
 </script>   







