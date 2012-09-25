<div id="categorie_name" class="title">
    <label>Categorie: </label>
    <?= $categorie->getLibelle();?>
</div>
<br />
<div id="category_books">
    <?php foreach($categorie->getSousCategorie() as $sous_categorie):?>
    <div>
        <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>souscategorie/<?= $sous_categorie->getId()?>">
            <?= $sous_categorie->getLibelle();?>
        </a>
    </div>
    <?php endforeach;?>
</div>