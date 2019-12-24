<div class="container">
    <div class="row">

        <div class="col-md-12 carrito ">
            <h1 class="display-4 mb-4 d-flex justify-content-start carritoh1"> Shopping Cart</h1> 
            <?php if (isset($_SESSION["carrito"])): ?>
                <?php $stats = utilidades::statsCarrito() ?>
                <?php if (!$stats["count"] <= 0): ?>
                   
                 
                    <h3 class="carrito">Cantidad Productos     <strong> <span class="ml-4 carritoSpan"><?= $stats["count"] ?></span></strong> </h3>
                    <hr>
                    <h3 class="carrito  ">Precio Total <strong><span class="ml-4 carritoSpan">$<?= $número_formato_inglés = number_format($stats["total"]) ?></span></strong></h3>

                    <!-----   <  >  ----->

                </div>
                <div class="col-md-12 carrito  d-flex justify-content-around ">                                                         
                    <a class=" btn  btn-warning Pago  mb-4" href="<?= base_url ?>pedidos/hacer">Confirmar Pedido</a>

                </div>
          <hr>
            <?php endif; ?>
        
       
  
        <?php endif; ?>
    
        <div class="container ">       
          


            <?php if (isset($_SESSION["carrito"]) && !$stats["count"] <= 0): ?>


                <?php foreach ($carrito as $indice => $elemento): $producto = $elemento["producto"]; ?>
                    <div class="container">      
                        <div class="row ">



                            <div class="col-md-12 carrito  d-flex justify-content-around   ">

                                <div class="col-3 divimgCar mr-3 ">  <div class="container-avatar m-1"><img class="img-fluid " style="width: 80px;height: 80px;" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>">  </div></div>
                                <div class="col-3  d-flex align-items-center"><p class="m-1"><?= $producto->nombre ?></p> </div>
                                <div class="col-3  d-flex align-items-center"> <p class="m-1">  <?= $elemento["unidades"] ?>  </p> </div>
                                <div class="col-3  d-flex align-items-center">
                                    <a href="<?= base_url ?>carrito/aumentar&id=<?= $indice ?>" class="updown-unidades button mr-1">+</a>
                                    <a href="<?= base_url ?>carrito/restar&id=<?= $indice ?>" class="updown-unidades button mr-1">-</a>
                                    <a href="<?= base_url ?>carrito/remove&id=<?= $indice ?>" class="updown-unidades  button pr-3"><small>x</small></a>                  
                                </div>
                            </div>
                        <?php endforeach; ?>
  <hr>
                    <?php else: ?> 
                                                    <div class="col-md-12 carrito  d-flex justify-content-around ">
                            <h1 class="text-center text-muted m-3">El carrito esta vacio</h1>

                        </div>

                    <?php                    endif;                    $stats = utilidades::statsCarrito();                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>
</div>
