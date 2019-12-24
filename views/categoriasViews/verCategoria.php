
<?php if (isset($categoria))  : ?>



  
<div class="container mt-2">
    <h1 class="text-center display-4"> <?=$categoria->nombre ?></h1>
        <?php if ($productos): ?>
    <div class="row">
        <div class=" col-md-12 col-sm-6 col-sm-12 cols d-flex d-sm-block  align-content-center flex-wrap justify-content-center">
        
            <div class="card-columns">
                 
  <?php while ($pro = $productos->fetch_object()): ?>



                    <div class="card m-2 border-1  ">

                        <?php if ($pro->imagen != null): ?>
                        
                        <div class="col categoria-img  ">
                            <img  src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="" class="card-image-top img-fluid">
                            </div>
                        <?php else: ?>
                            <img  src="<?= base_url ?>assets/img/camiseta.png">
                        <?php endif; ?>

                        <div class="card-body text-center">
                            <h4><a  href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>" ><?= $pro->nombre ?></a></h4>
                            <h3 class="precioCard"><?= empty($pro->precionConDescuento) ? "" : "$" .$número_formato_inglés = number_format($pro->precionConDescuento) ; ?></h3>
                            <h5 class="precioCard"><?= empty($pro->precionConDescuento) ? "$" . $número_formato_inglés = number_format($pro->precio) :
                                "<small><strike class='text-muted'> $" .$número_formato_inglés = number_format($pro->precio)  . " </strike><small>" ?></h5>

                              <?php if ($pro->stock < 1) : ?>
                <h4>   <a href="" class="btn btn-outline-danger mt-2">No disponible</a></h4>
    <?php else : ?>
                 <a  href="<?=base_url ?>carrito/add&id=<?=$pro->id ?>" class="btn btn-outline-warning mt-2">Añadir al carro</a> 
         <?php endif; ?>
                            
                            
                           
                            <a href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>" class="btn btn-outline-info mt-2">Detalles</a> 

                        </div>


                    </div>
                <?php endwhile; ?>
              

            </div>   
            
              

        </div>

    </div>
 <?php else : ?>
               
                <h2 class="text-center mt-4">Aun no existen Productos para esta categoria</h2>
              
                 <?php endif; ?>
    
    <?php $pagination->render(); ?>
</div>
v>

<?php else : ?>
<h1>No existe la categoria</h1>
<?php endif; ?>
