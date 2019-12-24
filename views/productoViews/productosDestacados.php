<div class="container mt-2">
<div class="row">
    <div class=" col-md-12 col-sm-6 col-sm-12 cols d-flex d-sm-block  align-content-center flex-wrap justify-content-center">
         <div class="card-columns">
            <?php while ($pro = $productos->fetch_object()): ?>



                <div class="card m-2 border-1  ">

                    <?php if ($pro->imagen != null): ?>
                        <img  src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="" class="card-image-top img-fluid">
                    <?php else: ?>
                        <img  src="<?= base_url ?>assets/img/camiseta.png">
                    <?php endif; ?>

                    <div class="card-body text-center"> <h4><a href="http://192.168.0.14/racielMVC/pedidos/hacer" class="btn btn-outline-wa mx-1">Continuar con el pedido</a></h4></div>



                </div>
            <?php endwhile; ?>

        </div>   
        </div>
    </div>
</div>