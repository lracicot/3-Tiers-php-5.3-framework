<h1>Mes commandes</h1>

<table class="cool">
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Sous-total</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
    <?php foreach($orders AS $order):?>
    <tr>
        <td><?= $order->getId()?></td>
        <td><?= $order->getDate()?></td>
        <td><?= $order->getTotal_ht()?> $</td>
        <td><?= $order->getTotal_ttc()?> $</td>
        <td><a href="<?= $_configs->base_url?><?= $_configs->base_uri?>order/<?= $order->getId()?>">Détails</a></td>
    </tr>
    <?php endforeach;?>
</table>