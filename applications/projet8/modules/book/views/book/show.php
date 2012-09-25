<link rel="stylesheet" type="text/css" media="screen" href="<?= $_configs->base_url?><?= $_configs->base_uri?>css/books.css" />

<div id="book_cover">
    <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/books/<?= $book->getId();?>.jpg" alt="[<?= $book->getTitre();?>]" />
</div>
<span id="book_title"><?= $book->getTitre();?></span>
<span id="book_author">
    <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>auteur/<?= $book->getAuteur()?>">
        <?= $book->getAuteurObj()->getPrenom();?>
        <?= $book->getAuteurObj()->getNom();?>
    </a>
</span>
<span id="book_price">
    <label>Prix: </label><?= number_format($book->getPrixHt(), 2, ',', ' ')?> $ +tx
    <a href="javascript:add_item(<?= $book->getId()?>)">
        <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/cart.png" alt="[BUY]" />Acheter
    </a>
</span>
<span id="book_date">
    <label>Date: </label><?= $book->getParution();?>
</span>
<span id="book_isbn">
    <label>ISBN: </label><?= $book->getIsbn();?>
</span>
<label id="lbl_resume">Résumé&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<span id="book_description">
    <p><?= $book->getResume();?></p>
</span>
<br />
<br />
Dans le même sujet: <br />
<?php foreach($book->getSousCategorieObj()->getBooksExcept($book->getId(), 4) as $same_book):?>
<div class="bookPage">
    <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>book/<?= $same_book->getId()?>">
        <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/books/<?= $same_book->getId();?>.jpg" alt="[<?= $same_book->getTitre();?>]" height="150px;" /><br />
        <?= $same_book->getTitre()?>
    </a><br />
    <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>cart/add/<?= $same_book->getId()?>">
        <img src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/cart.png" alt="[BUY]" />Acheter
    </a>
</div>
<?php endforeach;?>