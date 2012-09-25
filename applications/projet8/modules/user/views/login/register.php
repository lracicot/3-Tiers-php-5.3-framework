<h1>Formulaire d'inscription</h1>
<div id="validation_error">
<?php if(isset($errors)):?>
    <?php foreach($errors as $error):?>
    <p><?= $error?></p>
    <?php endforeach;?>
<?php endif;?>
</div>
<form action="<?= $_configs->base_url?><?= $_configs->base_uri?>register/validation" method="POST">
    <table>
        <tr>
            <td>Prénom*</td>
            <td><input type="text" name="prenom" value="<?= (isset($prenom)) ? $prenom : ''?>" /></td>
        </tr>
        <tr>
            <td>Nom*</td>
            <td><input type="text" name="nom" value="<?= (isset($nom)) ? $nom : ''?>" /></td>
        </tr>
        <tr>
            <td>Courriel*</td>
            <td><input type="text" name="email" value="<?= (isset($email)) ? $email : ''?>" /></td>
        </tr>
        <tr>
            <td>Téléphone*</td>
            <td><input type="text" name="tel" value="<?= (isset($tel)) ? $tel : ''?>" /></td>
        </tr>
        <tr>
            <td>Mot de passe*</td>
            <td><input type="password" name="passwd1" value="<?= (isset($passwd1)) ? $passwd1 : ''?>" /></td>
        </tr>
        <tr>
            <td>Confirmation*</td>
            <td><input type="password" name="passwd2" value="<?= (isset($passwd2)) ? $passwd2 : ''?>" /></td>
        </tr>
        <tr>
            <td>Adresse Ligne 1*</td>
            <td><input type="text" name="ad_l1" value="<?= (isset($ad_l1)) ? $ad_l1 : ''?>" /></td>
        </tr>
        <tr>
            <td>Adresse Ligne 2</td>
            <td><input type="text" name="ad_l2" value="<?= (isset($ad_l2)) ? $ad_l2 : ''?>" /></td>
        </tr>
        <tr>
            <td>Code postal*</td>
            <td><input type="text" name="zip_code" value="<?= (isset($zip_code)) ? $zip_code : ''?>" /></td>
        </tr>
        <tr>
            <td>Ville*</td>
            <td><input type="text" name="ville" value="<?= (isset($ville)) ? $ville : ''?>" /></td>
        </tr>
        <tr>
            <td><input type="submit" class="button" value="Soumettre" /></td>
        </tr>
    </table>
</form>