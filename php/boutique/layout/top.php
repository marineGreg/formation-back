<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Boutique</title>
  </head>
  <body>
      <?php
      if (isUserAdmin()) :
      ?>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container navbar-nav">
                <a class="navbar-brand" href="#">Admin</a>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>admin/categories.php" class="nav-link">
                                Gestion catégories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>admin/produits.php" class="nav-link">
                                Gestion produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>admin/commandes.php" class="nav-link">
                                Gestion commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>admin/membres.php" class="nav-link">
                                Gestion membres
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
      <?php
      endif;
      ?>
      <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
          <div class="container navbar-nav">
              <a class="navbar-brand" href="<?= RACINE_WEB; ?>index.php">Boutique</a>
              <?php
              include __DIR__ . '/menu-categorie.php';
              ?>
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>panier.php" class="nav-link">
                                Panier
                            </a>
                        </li>
                    <?php
                    if (isUserConnected()) :
                    ?>
                        <li class="nav-item">
                            <a class="nav-link">
                                <?= getUserFullName(); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>deconnexion.php" class="nav-link">
                                Déconnexion
                            </a>
                        </li>
                    <?php
                    else : 
                    ?>
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>inscription.php" class="nav-link">
                                Inscription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= RACINE_WEB; ?>connexion.php" class="nav-link">
                                Connexion
                            </a>
                        </li>
                    <?php
                    endif;
                    ?>
                </ul>
          </div>
      </nav>
    <div class="container">
        <?php
        displayFlashMessage();
        ?>