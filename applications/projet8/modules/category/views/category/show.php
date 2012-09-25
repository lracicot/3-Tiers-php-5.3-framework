<div id="categorie_name" class="title">
    <label>Categorie: </label>
    <?= $categorie->getLibelle();?>
</div>
<br />
<div id="category_books">
    <?php foreach($categorie->getBooks() as $book):?>
    <div class="bookPage">
        <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>book/<?= $book->getId()?>">
            <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/books/<?= $book->getId();?>.jpg" alt="[<?= $book->getTitre();?>]" height="150px;" /><br />
            <?= $book->getTitre()?>
        </a><br />
        <?= number_format($book->getPrixHt(), 2, ',', ' ')?> $ +tx
        <a href="javascript:add_item(<?= $book->getId()?>)">
            <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/cart.png" alt="[BUY]" />Acheter
        </a>
    </div>
    <?php endforeach;?>
</div>