
<?php
require_once './views/layout/content_index.php';
if (isset($ob)) :
    ?>
<div class="container">
<div class="row my-4 d-flex justify-content-center">
        <div class="col-md-12 col-xs-6 text-center mt-4 ">
            <div class="col-12  mt-2">
            <img class="img-fluid rounded sombra " src="<?= base_url ?>/uploads/images/<?= $ob->imagen ?>">
         
</div>
            
          
          
        <div class="row my-4 d-flex justify-content-center">
            <div class="m-3 p-3 border rounded ">
                <p> <?= $ob->descripcion ?> </p>
            </div>
            
    <?php $first = 1;
    if (!empty($imagenesGrupo)): ?>
                <div class="col-md-12 col-xs-6  mt-3">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner d-flex align-content-center">


        <?php while ($img = $imagenesGrupo->fetch_object()): ?>      
                                <div class="carousel-item <?php if ($first == 1) {
                echo "active";
            } $first++; ?>">
                                    <img class=" sombra img-fluid" src="<?= base_url ?>/uploads/images/<?= $img->nombreImagen ?>">
                                </div>

        <?php endwhile; ?>
<hr>



                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
    <?php endif; ?>  
        </div>

    </div>





<?php else : ?>
    <h1>No existe el producto</h1>
<?php endif; ?>

</div>