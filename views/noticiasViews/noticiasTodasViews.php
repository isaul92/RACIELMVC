    <div class="row widget justify-content-center ">
        <div class=" col-md-6  col-sm-12   ">
            <div class="card ">
              <div class="card  border-1  ">

                        <?php if ($noticia->nombreImagen != null): ?>
                            <img  src="<?= base_url ?>uploads/images/<?= $noticia->nombreImagen ?>" alt="" class="card-image-top sombra img-fluid">
                        <?php else: ?>
                            <img  src="<?= base_url ?>assets/img/camiseta.png">
                        <?php endif; ?>

                        <div class="card-body text-center mt-4">
                            <h4 class="display-4"><a  href="<?= base_url ?>producto/ver&id=<?= $noticia->id ?>" ><?= $noticia->nombre ?></a></h4>
                            <p class="mt-4"> <?= $noticia->texto ?> </p>

                        </div>



                    </div>
                    <hr>

              

            </div>   
        </div>
    </div>
