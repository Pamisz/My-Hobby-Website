<?php session_start(); 
    function login(){   
        require ('/var/www/dev/vendor/autoload.php');         
        require_once('mangos.php');
        $db = get_db();
        $login_query = ['_id' => $_SESSION['user_id']];
        $users = $db->users->find($login_query);
        foreach($users as $user){
            echo $user['login'];
        }
    }

?>
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
            height:800px;
        }
    </style>

</head>

<body>

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
                        <h1 style="color: #07385c;">Galeria zdjęć</h1>
                        <form enctype="multipart/form-data" action="galeria.php"  method="post" >
                            Dodaj zdjęcie: <input type="file" name="file" /><br/><br /> 
                            <?php
                            if (isset($_SESSION['user_id'])) { ?>
                            Prywatne: <input type="radio" name="status" value="prywatne"/>
                            Publiczne: <input type="radio" name="status" value="publiczne" checked/><br /><br />
                            <?php } ?>
                            Znak wodny:    <input type="text" name="znakwodny" required /> <br /> <br />
                            Tytuł:         <input type="text" name="tytuł" /> <br /> <br />
                            Autor:         <input type="text" name="autor" <?php if (isset($_SESSION['user_id'])) { ?> value="<?php login(); ?>" <?php } ?> /> <br /> <br />
                            <input type="submit" name="submit" value="Wyślij plik" /><br /><br />
                            <?php
                              
                                    if(isset($_POST['submit'])){
                                    $file=$_FILES['file'];

                                    $fileName=$_FILES['file']['name'];
                                    $fileTmpName=$_FILES['file']['tmp_name'];
                                    $fileSize=$_FILES['file']['size'];
                                    $fileType=$_FILES['file']['type'];

                                    $watermarkText = $_POST['znakwodny'];
                                    $tytuł = $_POST['tytuł'];
                                    $autor = $_POST['autor'];
                               
                                    if(isset($_SESSION['user_id'])){
                                        $status = $_POST['status'];
                                        $user_id= $_SESSION['user_id'];
                                    } else {
                                    $user_id = 1;
                                    $status = 'publiczne';
                                    }


                                    $fileExt = explode('.',$fileName);
                                    $fileActualExt=strtolower(end($fileExt));

                                    $allowed=array('jpg','jpeg','png');

                                    if(in_array($fileActualExt,$allowed)){                                    
                                            if($fileSize<1000000){
                                                $fileNameNew=uniqid('',true).".".$fileActualExt;
                                                $fileDestination='images/oryginał/'.$fileNameNew;
                                                move_uploaded_file($fileTmpName,$fileDestination);
                                                echo "Poprawnie przesłany plik";

                                            if ($fileActualExt == 'png') {
                                                $zdj = imagecreatefrompng($fileDestination);

                                                $zdjmin = imagecreatetruecolor(200, 125);
                                                imagecopyresampled($zdjmin, $zdj, 0, 0, 0, 0, 200, 125, imagesx($zdj), imagesy($zdj) );
                                                imagepng($zdjmin, 'images/min/'.'miniatura'.$fileNameNew);

                                                $czerwony = imagecolorallocate($zdj, 255, 0, 0);
                                                imagestring($zdj, 2, 5, 5, "$watermarkText", $czerwony);
                                                imagepng($zdj, 'images/znakwodny/' . 'znakwodny_' . $fileNameNew);

                                            }
                                            
                                            if ($fileActualExt == 'jpeg'|| $fileActualExt == 'jpg' ) {
                                                $zdj = imagecreatefromjpeg($fileDestination);

                                                $zdjmin = imagecreatetruecolor(200, 125);
                                                imagecopyresampled($zdjmin, $zdj, 0, 0, 0, 0, 200, 125, imagesx($zdj), imagesy($zdj) );
                                                imagejpeg($zdjmin, 'images/min/'.'miniatura'.$fileNameNew);

                                                $czerwony = imagecolorallocate($zdj, 255, 0, 0);
                                                imagestring($zdj, 2, 5, 5, "$watermarkText", $czerwony);
                                                imagejpeg($zdj, 'images/znakwodny/' . 'znakwodny_' . $fileNameNew);

                                            }
                                            require ('/var/www/dev/vendor/autoload.php');
                                            include_once('mangos.php');
                                            $check = false;

                                            $db = get_db();        

                                            $data = [ "Tytuł" => $tytuł, "Autor" => $autor, "File" => $fileNameNew, "status"=> $status, 'user'=>$user_id];                                        
                                            
                                            $db->datas->insertOne($data);
                                            
                                            }
                                            else{
                                                echo "Plik jest za duży. Maksymalny rozmiar pliku to 1 MB.";
                                            }
                                        }
                            
                                    
                                    else{
                                        if($fileSize>1000000){
                                            echo "Plik ma niewłaściwy format i niewłaściwy rozmiar.";
                                        }
                                        else{
                                            echo "Plik ma niewłaściwy format";
                                        }
                                    }
                                    }


                            ?>
                            <br />
                            <br />

                        </form>	 
                        <div style="margin-left: auto; margin-right: auto;">
                            <?php
                            include('images_load.php');
                            require('images_show.php');
                            ?>
                        </div>
                        <div style="clear: both;"></div>
                        <?php if(isset($_SESSION['user_id'])){ ?>
                        <a href="liked.php" style="text-decoration: none;"><button >Zobacz galerię zapisanych zdjęć</button></a>
                        <?php } ?>

                        <div class="page" style="text-align: center; margin-top: 1%;">
                            <?php
                            if ($page > 1) { ?>  
                                    <a href="?page=<?php echo ($page - 1); ?>" style="text-decoration: none; link visited"><button style="float: left;">&larr; Poprzednia Strona</button></a>
                            <?php } ?>
                            <?php
                            if ($total_pages > $page) { ?>  
                                    <a href="?page=<?php echo ($page + 1); ?>" style="text-decoration: none;"><button style="float: right;">Następna Strona &rarr;</button></a>
                            <?php } ?>
                            <br />
                            Strona <?php echo (string)$page ?> z <?php echo (string)$total_pages ?>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
            </article>   
        </main>
        <br />        
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







