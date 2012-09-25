Vous devez vous connecter avant d'ajouter un article dans votre panier.
<form action="<?= $_configs->base_url?><?= $_configs->base_uri?>login" method="POST">
  <label>Courriel :</label><br />
  <input type="text" name="email" />
  <label>Mot de passe :</label><br />
  <input type="password" name="passwd" />
  <input type="submit" value="connexion" class="button" />
</form>
<a id="register" href="<?= $_configs->base_url?><?= $_configs->base_uri?>register">S'enregistrer</a>