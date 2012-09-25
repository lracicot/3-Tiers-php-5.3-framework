<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>E-com de livres</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
        window.apppath = '<?= $_configs->base_url?><?= $_configs->base_uri?>';
    </script>
    <script type="text/javascript" src="<?= $_configs->base_url?><?= $_configs->base_uri?>js/json.js"></script>
    <script type="text/javascript" src="<?= $_configs->base_url?><?= $_configs->base_uri?>js/jquery.js"></script>
    <script type="text/javascript" src="<?= $_configs->base_url?><?= $_configs->base_uri?>js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#search_submit').click(function(){
                $(this).parent().submit();
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $_configs->base_url?><?= $_configs->base_uri?>css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $_configs->base_url?><?= $_configs->base_uri?>css/admin.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $_configs->base_url?><?= $_configs->base_uri?>css/guest.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $_configs->base_url?><?= $_configs->base_uri?>css/users.css" />
  </head>
  <body>
      <div id="container">
          <div id="header">
              <?php if ($authentification->getAuthData()->getId()):?>
              <div id="cart_lbl">
                Votre panier contiens <span id="nb_items"><?= count($cart->getItems())?></span> items.<br />
                <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>cart/checkout" class="button">Panier</a>
              </div>
              <?php endif;?>
              <div class="maintitle">E-com de livres</div>
              <?php if ($authentification->getAuthData()->getId()):?>
                  Bonjour <?= $authentification->getAuthData()->getPrenom()?> <?= $authentification->getAuthData()->getNom()?>
              <?php endif;?>
          </div>
          <div id="content">
              <div id="top_menu">
                <div id="navigation_menu">
                    <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>">
                        Accueil
                    </a>
                    <?php if (isset($sous_categorie) && $sous_categorie->getParent()):?>
                    >
                    <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>category/<?= $sous_categorie->getParent()?>">
                        <?= $sous_categorie->getCategorieObj()->getLibelle()?>
                    </a>
                    <?php endif;?>
                    <?php if (isset($book) && $book->getCategorie()):?>
                    >
                    <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>category/<?= $book->getCategorie()?>">
                        <?= $book->getCategorieObj()->getLibelle()?>
                    </a>
                    <?php endif;?>
                    <?php if(isset($book) && $book->getSousCategorie()):?>
                        >
                        <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>souscategorie/<?= $book->getSousCategorie()?>">
                            <?= $book->getSousCategorieObj()->getLibelle()?>
                        </a>
                    <?php endif;?>
                </div>
                <div id="search_menu">
                    <form action="<?= $_configs->base_url?><?= $_configs->base_uri?>book/search" method="POST">
                        <input type="text" name="search" value="<?= (isset($search) ? $search : '')?>" />
                        <img alt="search" class="button" id="search_submit" src="<?= $_configs->base_url?><?= $_configs->base_uri?>img/toolbar_find.png" />
                    </form><br />
                </div>
              </div>
              <div id="content_left">
                  <div id="left_menu_header">Menu</div>
                  <ul>
                      <li class="odd"><a href="<?= $_configs->base_url?><?= $_configs->base_uri?>"><div class="link">Accueil</div></a></li>
                      <?php $i=0?>
                      <?php foreach ($menu as $category):?>
                          <li class="<?= ($i%2)?'odd':'even';$i++?>"><a href="<?= $_configs->base_url?><?= $_configs->base_uri?>category/<?= $category->getId()?>" ><div class="link"><?= $category->getLibelle()?></div></a></li>
                      <?php endforeach;?>
                  </ul>
                  <div id="login">
                  <?php if (!$authentification->getAuthData()->getId()):?>
                      <form action="<?= $_configs->base_url?><?= $_configs->base_uri?>login" method="POST">
                          <label>Courriel :</label><br />
                          <input type="text" name="email" />
                          <label>Mot de passe :</label><br />
                          <input type="password" name="passwd" />
                          <input type="submit" value="connexion" class="button" />
                      </form>
                      <a id="register" href="<?= $_configs->base_url?><?= $_configs->base_uri?>register">S'enregistrer</a>
                  <?php else:?>
                      <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>logout">Déconnexion</a><br />
                      <a href="<?= $_configs->base_url?><?= $_configs->base_uri?>order/list">Mes commandes</a>
                  <?php endif;?>
                  </div>
              </div>
              <div id="content_center">
                <?php echo $_output ?>
              </div>
              <div id="content_right"></div>
          </div>
          <div id="footer"></div>
      </div>
      <div id="popup"></div>
  </body>
</html>
