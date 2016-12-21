<html>
<header>
    <style>
        body {
            font-family: Verdana;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ffffff;
        }

        .tableau-articles-composes {
            margin-bottom: 10px;
        }

        table, th, td {
            border: solid 1px #000000;
            text-align: center;
        }

        .cell-detail {
            background-color: #cccccc;
        }

        .text-center {
            text-align: center;
        }
    </style>
</header>
<body>
<div>
    <h1><?php echo $form["nom"]; ?></h1>
    <img src="<?php echo $image; ?>"/>

    <div class="row">
        <div class="col-md-12 text-center">
            <h3>Pièces</h3>
            <?php foreach ($produits as $produit) {
                if (!isset($produit["deleted_at"]) || $produit["deleted_at"] == null) {
                    ?>
                    <table class="tableau-articles-composes">
                    <thead>
                    <tr>
                        <th class="text-center">Libellé</th>
                        <th class="text-center">Position</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center"><?php echo $produit["nom"]; ?><?php if ($produit["ref"] != "") { ?> (<?php echo $produit["ref"]; ?>)<?php } ?></td>
                        <td class="text-center"><?php echo $produit["id_position"]; ?></td>
                    </tr>

                    <?php if (isset($produit["articles_lignes"])) { ?>
                        <tr>
                            <td colspan="2" style="padding: 15px" class="cell-detail">
                                <table class="tableau-detail">
                                    <thead>
                                    <tr>
                                        <th>Ref</th>
                                        <th>Libellé</th>
                                        <th>Quantité</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($produit["articles_lignes"] as $ligne) { ?>
                                        <tr>
                                            <td><?php echo $ligne["ref"]; ?></td>
                                            <td><?php echo $ligne["nom"]; ?></td>
                                            <td class="text-left"><?php echo $ligne["quantite"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php }
                }
                ?>



                </tbody>
                </table>
            <?php } ?>
        </div>
    </div>


</div>
</body>
</html>