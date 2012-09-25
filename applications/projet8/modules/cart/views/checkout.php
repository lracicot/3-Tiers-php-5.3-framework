<h1>Panier</h1>

<script type="text/javascript">

    <?php $itemsSerialized=array(); foreach ($cart->getItems() as $item):?>
        <?php $itemsSerialized[] = array(
            'id' => $item->getId(),
            'article' => $item->getArticle()->getId(),
            'quantite' => $item->getQuantite()
                );?>
    <?php endforeach;?>
    
    item = <?= json_encode($itemsSerialized)?>;

    function change_qty(item_id)
    {
        item[item_id].quantite = $('#item_qty_'+item_id).attr('value');
    }

    $(document).ready(function(){
        $('#update_all').click(function(){
            $.post(window.apppath+'cart/update_all', {items: json_encode(item)}, function(){
                location.reload();
            });
        });
    });
</script>

<table class="cool">
    <tr>
        <th></th>
        <th>Article</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
    </tr>
<?php $total = 0;?>
<?php $totaltx = 0;?>
<?php $i=0;foreach ($cart->getItems() AS $item):?>
    <tr>
        <td><a class="button" href="<?= $_configs->base_url?><?= $_configs->base_uri?>cart/remove/<?= $item->getArticle()->getId()?>">Retirer</a></td>
        <td><?= $item->getArticle()->getTitre()?></td>
        <td><input onchange="change_qty(<?= $i?>)" type="text" id="item_qty_<?= $i++?>" size="2" value="<?= $item->getQuantite()?>"></td>
        <td><?= number_format($item->getArticle()->getPrixHt(), 2, ',', ' ')?>$</td>
            <?php $total += $item->getArticle()->getPrixHt() * $item->getQuantite()?>
            <?php $totaltx += $item->getArticle()->getPrixTtc() * $item->getQuantite()?>
        <td><?= number_format($item->getArticle()->getPrixHt() * $item->getQuantite(), 2, ',', ' ')?>$</td>
    </tr>
<?php endforeach;?>
    <tr>
        <td colspan="3"></td>
        <td>Total:</td>
        <th id="total_notaxes"><?= number_format($total, 2, ',', ' ')?>$</th>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Total Taxes:</td>
        <th id="total_taxes"><?= number_format($totaltx, 2, ',', ' ')?>$</th>
    </tr>
</table>

<input id="update_all" type="button" class="button" value="Mettre à jour" /><br /><br />
<a href="<?= $_configs->base_url?><?= $_configs->base_uri?>cart/confirm" class="button">Valider ma commande</a>