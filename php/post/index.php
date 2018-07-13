<?php
var_dump($_POST);
?>

<form method="post">
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