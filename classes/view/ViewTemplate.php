<?php

class ViewTemplate
{
  public static function menu()
  { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
      <div class="container">
        <a class="navbar-brand">stock</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="connexion-user.php">Connexion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="deconnexion.php">Déconnexion</a>
            </li>
            
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  <?php
  }

  public static function alert($type, $message, $lien = null)
  {
?>
    <div class="container alert  alert-<?= $type ?>" role="alert">
      <?= $message ?> <br />
      <?php
      if ($lien) {  ?>
        Cliquez <a href="<?= $lien ?>" class="alert-link px-2"> ici </a> pour continuer la navigation
      <?php
      }
      ?>
    </div>

  <?php

  }

  public static function footer()
  { ?>
    <div class="bg-dark py-4 mt-5 text-center text-light h3">
      <div class="container">
        copyright &copy; <?= date("Y") ?>
      </div>
    </div>
<?php
  }
}
