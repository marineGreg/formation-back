<!DOCTYPE html>
<html>
    <head>
        <meta charseet="UTF-8">
        <title></title>
    </head>
    <body>
        <button type="button" id="appel">
            Appeler le fichier hello.php
        </button>
        <div id="reponse"></div>
    </body>
    <script>
        document.getElementById('appel').addEventListener(
            'click',
            function() {
                var xhr = new XMLHttpRequest();
                // On définit ce qui va être fait après l'appel ajax
                xhr.onreadystatechange = function () {
                    // xhr.readyState == 4 : on a reçu la réponse du serveur
                    // xhr.status == 200 : le serveur a répondu par le code HTTP 200 OK
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Dans xhr.responseText, on a le contenu que nous a retourné le fichier hello.php
                        document.getElementById('reponse').innerHTML = xhr.responseText;

                    }
                };

                // Appel en HTTP GET du fichier hello.php
                xhr.open('GET', 'hello.php');
                // Envoi de l'appel
                xhr.send();
            }
        );
    </script>
<html>