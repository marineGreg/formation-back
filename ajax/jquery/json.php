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
            $(function(){
               $('#qui').submit(function(event){
                   event.preventDefault();
                   
                   $.get(
                       '../hello-json.php',
                       $(this).serialize(),
                       function(response){
                           // response est traité comme un objet JSON à cause du 4ème paramètre passé à la fonction $.get()
                           $('#reponse').html('Bonjour ' + response.nom);
                       },
                       'json' // type de données reçues
                   );
               });
           });
        </script>
    </body>

<html>