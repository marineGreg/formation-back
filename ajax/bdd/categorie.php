<!--
    Faire un formulaire pour ajouter une catégorie en ajax :
    - faire un formulaire avec un champ nom
    - intercepter le submit en js
    - envoyer la valeur contenue dans le champ nom en ajax en POST vers un fichier PHP
    - ce fichier vérifie que le champ nom n'est pas vide
    - s'il n'est pas vide, insert en bdd
    - ce fichier retourne un JSON avec 2 informations : 
        * statut OK ou KO
        * message de confirmation ou d'erreur
    - en retour d'appel ajax, afficher le message en vert si ok, en rouge si ko
-->

<?php
require_once __DIR__ . '/cnx.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charseet="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Ajout catégorie</h1>

        <div id="message"></div>
        <form id="form-categorie">
            <div>
                <label>Nom</label>
                <input type="text" name="nom">
            </div>
            <div>
                <button type="submit">
                    Enregistrer
                </button>
            </div>
        </form>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
        </script>
        <script>
            $(function(){ // DOM ready
                // -- interception de l'évènement submit
                $('#form-categorie').submit(function(event){ // -- ici event est purement déclaratif, on peut mettre 'e'
                    // -- empêche la soumission du formulaire
                    event.preventDefault();
                    
                        $.post(
                            'categorie-ajax.php', // -- fichier appelé
                            $(this).serialize(), // -- données envoyées
                            function(response) { // -- fonction qui traite la réponse de categorie-ajax.php
                                var color = (response.statut == 'ok')
                                ? 'green'
                                : 'red'
                            ;
                                console.log(response);
                                $('#message').html(
                                     '<span style="background-color : ' + color + '">' + response.message + '</span>'
                                );
                            },
                            'json' // -- categorie-ajax.php va retourner du JSON
                        );
                });
            });
        </script>
    </body>

<html>