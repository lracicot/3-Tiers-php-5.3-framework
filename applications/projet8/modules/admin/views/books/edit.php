<h1>Modification d'un livre</h1>
<div id="validation_error">
<?php if(isset($errors)):?>
    <?php foreach($errors as $error):?>
    <p><?= $error?></p>
    <?php endforeach;?>
<?php endif;?>
</div>
<form action="<?= $_configs->base_url?><?= $_configs->base_uri?>admin/books/edit/<?= $book->getId()?>" method="POST">
    <table>
        <tr>
            <td>ISBN</td>
            <td><input type="text" name="isbn" value="<?= $book->getIsbn()?>" /></td>
        </tr>
        <tr>
            <td>Categorie</td>
            <td>
                <select name="categorie">
                <?php foreach($menu AS $category):?>
                    <option value="<?= $category->getId()?>" <?= ($book->getCategorie() == $category->getId()) ? 'selected' : ''?>>
                            <?= $category->getLibelle()?>
                    </option>
                <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Sous-catégorie</td>
            <td>
                <select name="sous_categorie">
                <?php foreach($sous_categorieList AS $sousCategory):?>
                    <option value="<?= $sousCategory->getId()?>" <?= ($book->getSousCategorie() == $sousCategory->getId()) ? 'selected' : ''?>>
                            <?= $sousCategory->getLibelle()?>
                    </option>
                <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Titre</td>
            <td><input type="text" name="titre" value="<?= $book->getTitre()?>" /></td>
        </tr>
        <tr>
            <td>Prix</td>
            <td><input type="text" name="prix_ht" value="<?= $book->getPrixHt()?>" />$</td>
        </tr>
        <tr>
            <td>Prix avec taxes</td>
            <td><input type="text" name="prix_ttc" value="<?= $book->getPrixTtc()?>" />$</td>
        </tr>
        <tr>
            <td>Date de parution</td>
            <td><input type="text" name="parution" value="<?= $book->getParution()?>" /></td>
        </tr>
        <tr>
            <td>Résumé</td>
            <td><textarea name="resume" cols="50" row="20"><?= $book->getResume()?></textarea></td>
        </tr>
        <tr>
            <td>Auteur</td>
            <td>
                <select name="auteur">
                <?php foreach($authorsList AS $author):?>
                    <option value="<?= $author->getId()?>" <?= ($book->getAuteur() == $author->getId()) ? 'selected' : ''?>>
                            <?= $author->getPrenom()?> <?= $author->getNom()?>
                    </option>
                <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" class="button" value="Soumettre" /></td>
        </tr>
    </table>
</form>