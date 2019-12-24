
<?php require_once './views/layout/content_index.php';
if (isset($pro)) :  ?>
    <div class="row my-4 ">
        <div class="col-md-6 col-xs-12 text-center mt-4 ">

            <img class="img-fluid  " src="<?= base_url ?>/uploads/images/<?= $pro->imagen ?>">
        </div>
        <div class="col-md-6  col-xs-12 p-4">
            <h2 class="mb-3 display-4 text-mu"><?= $pro->nombre ?></h2>

            <h1 class="precioCard my-4"><?= empty($pro->precionConDescuento) ? "" : "$" . $número_formato_inglés = number_format($pro->precionConDescuento); ?></h1>

            <h1 class="precioCard my-4"><?=
                empty($pro->precionConDescuento) ? "$" . $número_formato_inglés = number_format($pro->precio) :
                        "<small><strike class='text-muted'> $" .
                        $número_formato_inglés = number_format($pro->precio) . " </strike><small>"
                ?></h1>
            <?php if ($pro->stock < 1) : ?>
                <h4><a href="#" class="badge badge-danger mb-4">No disponible</a></h4>
    <?php else : ?>
                <a href="<?=base_url ?>carrito/add&id=<?=$pro->id ?>" class="btn btn-warning  mb-4">AGREGAR AL CARRO</a>
                <h4 class="mb-4"><small>Stock disponible  <?= $pro->stock ?></small></h4>
    <?php endif; ?>
            <h4>Descripcion</h4>
            <p class="lead mb-4"><?= $pro->descripcion ?></p>
            <h4>Dimensiones</h4>
            <p class="lead mb-4"><?= $pro->dimensiones ?></p>
        </div>
    </div>
<?php else : ?>
    <h1>No existe el producto</h1>
<?php endif; ?>
