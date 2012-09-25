<div id="author_name" class="title">
    <label>Auteur: </label>
    <?= $author->getPrenom();?>
    <?= $author->getNom();?>
</div>
<br />
<div id="author_books">
    <label><strong>Liste des livres</strong></label><br />

    <?php foreach($author->getBooks() as $book):?>
    <div class="bookPage">
        <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>book/<?= $book->getId()?>">
            <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/books/<?= $book->getId();?>.jpg" alt="[<?= $book->getTitre();?>]" height="150px;" /><br />
            <?= $book->getTitre()?>
        </a><br />
        <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>cart/add/<?= $book->getId()?>">
            <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/cart.png" alt="[BUY]" />Acheter
        </a>
    </div>
    <?php endforeach;?>
</div>



<!--    <table class="bookList" cellspacing="0">
    <?/*php $i=0; foreach($author->getBooks() as $book):?>
        <tr class="<?= ($i++%2) ? 'odd' : 'even'?>">
            <td>
                <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/books/<?= $book->getId();?>.jpg" alt="[<?= $book->getTitre();?>]" height="50px;" />
            </td>
            <td class="bookTitle">
                <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>book/<?= $book->getId()?>">
                    <div class="tableLink"><?= $book->getTitre()?></div>
                </a>
            </td>
            <td class="bookListBuy">
                <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>cart/add/<?= $book->getId()?>">
                    <div class="tableLinkImg"><img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/cart.png" alt="[BUY]" /></div>
                </a>
            </td>
        </tr>
    <?php endforeach;*/?>
    </table>-->