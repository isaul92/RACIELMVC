
<?php
require_once './views/layout/content_index.php';
if (isset($ob)) : ?>
    

        <div class="row my-4">
            <div class="col text-center">
              


                    <h2 class="mb-3"><?= $ob->nombre ?></h2>
                    <p class="lead mb-4"><?= $ob->descripcion ?>!</p>
                    <img class="img-fluid" src="<?= base_url ?>/uploads/images/<?= $ob->imagen ?>">



               
            </div></div>

   




<?php else : ?>
    <h1>No existe el producto</h1>
<?php endif; ?>

