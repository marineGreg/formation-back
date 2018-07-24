<!DOCTYPE html>
<html>
    <head>
        <meta charseet="UTF-8">
        <title></title>
    </head>
    <body>
        <form id="qui">
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom">
            </div>
            <div>
                <label>Nom</label>
                <input type="text" name="nom">
            </div>
            <label>Méthode d'envoi</label>
            <select id="methode">
                <option value="GET">GET</option>
                <option value="POST">POST</option>
            </select>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
        <div id="reponse"></div>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
        </script>
        <script>
            // DOM ready, éq : $(document).ready(function() {
            $(function(){
               $('#qui').submit(function(event){
                   event.preventDefault();
                   
                   $.ajax({
                       url: '../hello.php',
                       method: $('#methode').val(), // GET ou POST
                       // serialize() créé une query string en utilisant l'attribut name des champs de formulaire
                       // this = le formulaire => $('#qui')
                       data: $(this).serialize(),
                       // dans success la fonction qui traite le contenu retourné par hello.php
                       success: function(response){
                           $('#reponse').html(response);
                       }
                   });
               });
            });
        </script>
    </body>

<html>