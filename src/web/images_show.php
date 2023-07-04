<?php
    $count = 0;
    $limit = 4;
    $total_pages = ceil(count($files_array) / $limit);
    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
if ($page < 1 || $page > $total_pages)
    $page = 1;
    $start = ($page - 1) * $limit;
    require ('/var/www/dev/vendor/autoload.php');
    require_once('mangos.php');
    $db = get_db();
    $sesja = false;
    $imagevalid = false;

    if(isset($_SESSION['user_id'])){
        $sesja = true;
    }

    
    ?><form method="post">  
<?php
for ($i = $start; $i < count($files_array); $i++) {
    
    $valid = true;
    $query = ['File' => $files_array[$i]];
    $datas = $db->datas->find($query);
    foreach ($datas as $data) {
        if ($data['status'] == 'prywatne') {
            $valid = false;
        }
        if ($sesja == true) {
            if ($_SESSION['user_id'] == (string)$data['user']) {
                $imagevalid = true; 
            }
        }
    }
    //id użytkownika od danego zdjęcia jest takie samo jak id sesji wtedy też pokaż plus info ze jest prywatne
    if (($valid != false) || ($valid==false && $sesja==true && $imagevalid==true)) {$count++;
        ?>
        <div style="float: left; margin-left: 7%;" >
        <p>Tytuł:
        <?php
        $query = ['File' => $files_array[$i]];
        $datas = $db->datas->find($query);
        foreach ($datas as $data) {
            echo $data['Tytuł'] . '<br/>';
        }
        ?>
        </p><p>
        Autor:
        <?php
        $query = ['File' => $files_array[$i]];
        $datas = $db->datas->find($query);
        foreach ($datas as $data) {
            echo $data['Autor'] . '<br/>';
        }
        ?>
        </p>
        <p>Tytuł:
        <?php
        $query = ['File' => $files_array[$i]];
        $datas = $db->datas->find($query);
        foreach ($datas as $data) {
            echo $data['status'] . '<br/>';
        }
        ?>
        </p>
        <a href="images/znakwodny/<?php echo 'znakwodny_' . $files_array[$i]; ?>" style="text-decoration: none;" target="_blank">
        <img src="images/min/<?php echo 'miniatura' . $files_array[$i]; ?>">
        </a>
        <label>
            <?php if (isset($_SESSION['user_id'])) { ?>
            <input type="checkbox" name="checkboxes[]" value="Image<?php echo $i ?>" 
            <?php
            if (isset($_SESSION['checkboxes']) && in_array("Image$i", $_SESSION['checkboxes'])) {
                echo 'checked';
            }
            ?>/><?php } ?>
        </label>
        </div>

<?php
                if (isset($_POST['baton']) && isset($_POST['checkboxes'])) {
                    if (!isset($_SESSION['checkboxes'])) {
                        $_SESSION['checkboxes'] = $_POST['checkboxes'];
                    } else {
                        $_SESSION['checkboxes'] = array_merge($_SESSION['checkboxes'], $_POST['checkboxes']);
                    }
                }
                if ($limit == $count) {
                    break;
                }
    }
}
?> <br /><br /> <br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php if(isset($_SESSION['user_id'])) { ?>
<button type="submit" style="margin-top: 10px;" name="baton">Zapamiętaj wybrane</button><br />
<?php } ?>
</form>
