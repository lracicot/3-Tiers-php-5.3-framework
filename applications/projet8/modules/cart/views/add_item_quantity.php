<script type="text/javascript">
    $(document).ready(function(){
        $('#nope').click(function(){
            $('#popup').html('');
             $('#popup').hide();
        });
    });
</script>
Cet item est déjà présent dans votre panier, voulez-vous<br/>
en ajouter un deuxième ?<br />
<a href="javascript:add_item('<?= $product?>', '1')" id="yess" class="button">Oui</a>
<a href="javascript:void(0);" id="nope" class="button">Non</a>