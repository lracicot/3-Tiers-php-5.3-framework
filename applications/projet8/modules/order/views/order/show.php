<h1>Commande #<?= $order->getId()?></h1>

<table class="cool">
    <tr>
        <th>Article</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
    </tr>
<?php foreach ($order->getOrderLines() AS $order_line):?>
    <tr>
        <td><?= $order_line->getArticleObj()->getTitre()?></td>
        <td><?= $order_line->getQuantite()?></td>
        <td><?= number_format($order_line->getPrix_ht(), 2, ',', ' ')?>$</td>
        <td><?= number_format($order_line->getTotal_ht(), 2, ',', ' ')?>$</td>
    </tr>
<?php endforeach;?>
    <tr>
        <td colspan="2"></td>
        <td>Total:</td>
        <th id="total_notaxes"><?= number_format($order->getTotal_ht(), 2, ',', ' ')?>$</th>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td>Total Taxes:</td>
        <th id="total_taxes"><?= number_format($order->getTotal_ttc(), 2, ',', ' ')?>$</th>
    </tr>
</table>

<input type="button" class="button" value="Payer maintenant">