<?php
require_once __DIR__ . '/cnx.php';

$query = 'SELECT id, nom, prenom FROM utilisateur ORDER BY prenom, nom';
$stmt = $pdo->query($query);
$utilisateurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charseet="UTF-8">
        <title></title>
    </head>
    <body>
        <select id="utilisateur">
            <option value="">Choisissez</option>
            <?php 
            foreach($utilisateurs as $utilisateur) :
            ?>
            <option value="<?= $utilisateur['id']; ?>">
                <?= $utilisateur['prenom'] . ' ' . $utilisateur['nom']; ?>
            </option>
            <?php
            endforeach;
            ?>
        </select>
        <div id="detail"></div>
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
        </script>
        <script>
            // - intercepter l'évènement change de la liste déroulante
            // - récupérer l'id utilisateur de l'option sélectionnée
            // - appeler utilisateur.php en ajax en lui passant cet id en GET
            // - utilisateur.php utilise cet id pour récupérer les infos utilisateur en bdd
            //  et construit un tableau HTML ou une liste <dl>
            // - le traitement de la réponse en javascript inclus le détail de l'utilisateur dans la div #detail
            // - si c'est l'option vide qui est choisie, on vide la div#detail
            
            $(function(){ // DOM ready
                // interception de l'évènement change du select
                $('#utilisateur').change(function(){
                    // valeur de l'option sélectionnée
                    // this fait référence à la balise select
                    var id = $(this).val();
                    
                    if(id != ''){ 
                        // - si on a pas choisi la première option vide
                        $.get( // -- appel ajax en GET
                            'utilisateur.php', // -- sur la page utilisateur.php
                            'id=' + id, // -- en lui passant l'id venant du select
                            // -- fonction qui traite la réponse d'utilisateur.php
                            function(response){ 
                                // on met le contenu de la réponse dans la div#detail
                                $('#detail').html(response);
                            }
                        );
                    } else { 
                        // - si on a choisi l'option vide
                        $('#detail').html('');
                    }
                });
            });
        </script>
    </body>

<html>