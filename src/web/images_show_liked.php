<?php
    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
if ($page < 1 || $page > 1)
    $page = 1;
    require ('/var/www/dev/vendor/autoload.php');
    require_once('mangos.php');
    $db = get_db();

    ?><form method="post">  
<?php   
for ($i = 0; $i < count($files_array); $i++) {
    if(!isset($_SESSION['checkboxes'])){
        echo 'Brak polubionych zdjęć';
        break;
    }
    else if(count($_SESSION['checkboxes']) == 0){
        echo 'Brak polubionych zdjęć';
        break;
    }
    
    if (isset($_SESSION['checkboxes']) && in_array("Image$i", $_SESSION['checkboxes'])) {
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
        <a href="images/znakwodny/<?php echo 'znakwodny_' . $files_array[$i]; ?>" style="text-decoration: none;" target="_blank">
        <img src="images/min/<?php echo 'miniatura' . $files_array[$i]; ?>">
        </a>
        <label>
            <?php if (isset($_SESSION['user_id'])) { ?>
            <input type="checkbox" name="checkboxes[]" value="Image<?php echo $i ?>" 
            <?php
            if (!isset($_SESSION['checkboxes']) && in_array("Image$i", $_SESSION['checkboxes'])) {
                echo 'checked';
            }
            ?>/><?php }
    } ?> 
        </label>
        </div>

<?php 
    if (isset($_POST['unbaton']) && isset($_POST['checkboxes'][$i])) {
                $checkboxes = array_values($_SESSION['checkboxes']);
                $checkboxes = array_diff($checkboxes, [$_POST['checkboxes'][$i]]);
                $_SESSION['checkboxes'] = $checkboxes;
         
        }         
} ?> 
<?php if (isset($_SESSION['checkboxes'])) {
        if (count($_SESSION['checkboxes']) > 0) { ?>
<button type="submit" style="margin-top: 10px;" name="unbaton">Usuń zaznaczone z zapamiętanych</button>
<?php }
} ?>
</form>

