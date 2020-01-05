<div class="container mt-2">
    <div class="row">
        <div class=" col-md-12 col-sm-6 col-sm-12 cols d-flex d-sm-block  align-content-center flex-wrap justify-content-center">
            <div class="card-columns">
           
                <?php while ($pro = $productos->fetch_object()): ?>
    <?php if ($pro->status=="AC") : ?>


                    <div class="card m-2 border-1  ">

                        <?php if ($pro->imagen != null): ?>
                            <img  src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="" class="card-image-top sombra img-fluid">
                        <?php else: ?>
                            <img  src="<?= base_url ?>assets/img/camiseta.png">
                        <?php endif; ?>

                        <div class="card-body text-center pt-4">
                            <h4><a  href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>" ><?= $pro->nombre ?></a></h4>
                            <h3 class="precioCard"><?= empty($pro->precionConDescuento) ? "" : "$" .$número_formato_inglés = number_format($pro->precionConDescuento) ; ?>
                            </h3>
                            <h5 class="precioCard"><?= empty($pro->precionConDescuento) ? "$" . $número_formato_inglés = number_format($pro->precio) :
                                "<small><strike class='text-muted'> $" .$número_formato_inglés = number_format($pro->precio)  . " </strike><small>" ?></h5>
                             <?php if ($pro->stock < 1) : ?>
                  <a href="#" class="btn btn-outline-danger mt-2">No disponible</a>
    <?php else : ?>
                 <a  href="<?=base_url ?>carrito/add&id=<?=$pro->id ?>" class="btn btn-outline-warning mt-2">Añadir al carro</a> 
         <?php endif; ?>
                            <a href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>" class="btn btn-outline-info mt-2">Detalles</a> 

                        </div>


                    </div>
                 <?php endif; ?>
                <?php endwhile; ?>

            </div>   

        </div>

    </div>
    <?php $pagination->render(); ?>
</div>
