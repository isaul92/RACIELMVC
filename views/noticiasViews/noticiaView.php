<?php require_once './views/layout/content_noticias.php';
?>
<div class="row widget justify-content-center ">
    <div class=" col-md-6  col-sm-12   ">
        <div class="card ">




            <div class="card  border-1  ">

                <?php if ($noticia->nombreImagen != null): ?>
                    <img  src="<?= base_url ?>uploads/images/<?= $noticia->nombreImagen ?>" alt="" class="card-image-top img-fluid">
                <?php else: ?>
                    <img  src="<?= base_url ?>assets/images/img.jpg">
                <?php endif; ?>

                <div class="card-body text-center">
                    <h4 class="display-4"><?= $noticia->nombre ?></h4>
                    <p style="background:white;" class="mt-4"> <?= $noticia->texto ?> </p>
                </div>



            </div>
            <hr>


        </div>   
    </div>
</div>
