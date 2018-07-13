<?php
var_dump($_GET);
echo '<br>';

if (!empty($_GET)) { // s'il y a des infos dans la query string
    echo $_GET['titre'] . '<br>';
    // nl2br transforme les retours chariots en <br> HTML
    echo nl2br($_GET['description']);
}
?>
<form>
    <div>
        <label>Titre</label>
        <input type="text" name="titre">
    </div>
    <div>
        <label>Description</label>
        <textarea name="description"></textarea>
    </div>
    <div>
        <button type="submit">OK</button>
    </div>
</form>