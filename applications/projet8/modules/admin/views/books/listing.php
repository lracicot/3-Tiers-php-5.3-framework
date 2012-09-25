<h1>Liste des livre du système</h1>

<table class="cool">
    <tr>
        <th>Isbn</th>
        <th>Titre</th>
        <th>Categorie</th>
        <th>Sous categorie</th>
        <th>Auteur</th>
        <th>Action</th>
    </tr>
    <?php foreach($books AS $book):?>
    <tr>
        <td><?= $book->getIsbn()?></td>
        <td><?= $book->getTitre()?></td>
        <td><?= $book->getCategorieObj()->getLibelle()?></td>
        <td><?= $book->getSousCategorieObj()->getLibelle()?></td>
        <td><?= $book->getAuteurObj()->getPrenom()?> <?= $book->getAuteurObj()->getNom()?></td>
        <td><a href="<?= $_configs->base_url?><?= $_configs->base_uri?>admin/books/edit/<?= $book->getId()?>">Éditer</a></td>
        <td><a href="<?= $_configs->base_url?><?= $_configs->base_uri?>admin/books/delete/<?= $book->getId()?>">Supprimer</a></td>
    </tr>
    <?php endforeach;?>
</table>