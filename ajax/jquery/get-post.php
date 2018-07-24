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
                   
                   if($('#methode').val() == 'GET') {
                       // raccourci pour $.ajax avec methode: POST
                       $.get(
                           '../hello.php', // page appelée
                           $(this).serialize(), // données envoyées
                           function(response) { // success
                               $('#reponse').html(response);
                           }
                       );
                   } else {
                       $.post(
                           '../hello.php', // page appelée
                           $(this).serialize(), // données envoyées
                           function(response) { // success
                               $('#reponse').html(response);
                           }
                       );
                   }
               });
            });
        </script>
    </body>

<html>