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
                <input type="text" id="prenom">
            </div>
            <div>
                <label>Nom</label>
                <input type="text" id="nom">
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
        <script>
            document.getElementById('qui').addEventListener(
                'submit',
                function(event){
                    // -- annule la soumission du formulaire
                    event.preventDefault();
                    
                    var prenom = document.getElementById('prenom').value;
                    var nom = document.getElementById('nom').value;
                    var queryString = 'prenom=' + prenom + '&nom=' + nom;
                    
                    var xhr = new XMLHttpRequest();
                    
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById('reponse').innerHTML = xhr.responseText;
                        }
                    };
                    
                    if (document.getElementById('methode').value == 'GET'){
                        // --- en GET
                        xhr.open('GET', 'hello.php?' + queryString);
                        xhr.send();
                    } else {
                        // --- en POST
                        xhr.open('POST', 'hello.php');
                        
                        // -- on ajoute une entête HTTP pour signifier qu'il y a des données en POST
                        xhr.setRequestHeader(
                            'Content-type',
                            'application/x-www-form-urlencoded'
                        );
                        
                        // -- on passe la query string au moment de l'envoi
                        xhr.send(queryString);
                    }
                }
            );
        </script>
    </body>

<html>