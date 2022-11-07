
<?php
class ViewUser
{
  public static function connexion()
  {
?>
    <form class="col-md-6 offset-md-3 d-flex justify-content-center py-4" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
      <div class="card mb-3" style="max-width: 18rem; border:#580000 1px solid;">
        <div class="card-header text-center" style="border-bottom:#580000 1px solid;">Connection à votre compte</div>
        <div class="card-body">
          <h5 class="card-title text-center">Saisissez vos identifiants</h5>
          <form class="row g-3">
            <div class="col-auto">
              <label for="mail" class="form-label">Votre mail : </label>
              <input type="mail" class="form-control" name="mail" id="mail" aria-describedby="mailHelp" data-type="email" data-message="format non valide" placeholder="Votre adresse electronique">
              <small id="mailHelp" class="form-text text-muted"></small>
            </div>
            <div class="col-auto">
              <label for="pwd" class="form-label">Votre mot de passe : </label>
              <input type="password" class="form-control" name="pass" id="pass" aria-describedby="pwdHelp" data-type="pass" data-message="Mot de passe incorrect" placeholder="Votre mot de passe">
              <small id="mailHelp" class="form-text text-muted"></small>
            </div>
            <div class="col-auto d-flex justify-content-center">
              <button type="submit" name="connexion" class="btn btn-primary">Connexion</button>
              <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    </form>
<?php
  }
}