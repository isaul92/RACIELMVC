<div class="container">
    <h1 class="display-4 text-center mb-3">Detalle pedido</h1>
    <hr>
    <?php if (isset($pedido)): ?>
        <?php if (isset($_SESSION["admin"])): ?>

            <h3 class="display-4 text-center m-4">Cambiar estado del pedido</h3>
            <form action="<?= base_url ?>pedidos/estado" class="" method="POST">
                <select class="form-control" name="estado">
                    <option value="confirm" <?= $pedido->estadoPedido == "confirm" ? "selected" : ""; ?> >Pendiente</option>
                    <option value="preparation"  <?= $pedido->estadoPedido == "preparation" ? "selected" : ""; ?>>En preparacion</option>
                    <option value="ready" <?= $pedido->estadoPedido == "ready" ? "selected" : ""; ?>>Preparado para enviar</option>
                    <option value="send" <?= $pedido->estadoPedido == "send" ? "selected" : ""; ?>>Enviado</option>
                    <option value="cancel" <?= $pedido->estadoPedido == "cancel" ? "selected" : ""; ?>>Cancelado</option>
                </select>
                <input type="hidden" value="<?= $pedido->idPedido ?>" name="pedido_id">
                <input type="submit" class="btn btn-outline-warning text-center" value="Cambiar estado del pedido">
            </form>
            <h3>Datos del comprador</h3>
            <p>Nombre: <?php echo $pedido->nombre . " " . $pedido->apellidos ?></p>
            <p>Telefono:   <?php echo $pedido->telefono ?></p>
            <p>Email:   <?php echo $pedido->email ?></p>

        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($pedido)): ?>
        <div> 
            <hr>
            <h3>Direccion del envio</h3>

            <p>Codigo Postal : <?php echo $pedido->codigoPostal ?></p>
            <p>Estado : <?php echo $pedido->estado ?></p>
            <p>Municipio :   <?php echo $pedido->municipio ?></p>
            <p>Colonia :   <?php echo $pedido->colonia ?></p>
            <p>Calle :   <?php echo $pedido->calle ?></p>
            <p>Numero Exterior :  <?php echo $pedido->noExterior ?></p>
            <p>Numero Interior : <?php echo $pedido->noInterior ?></p>
            <p>Entre Calles :  <?php echo $pedido->entreCalles ?></p>
            <p>Referencias :    <?php echo $pedido->referencias ?></p>
            <p> <?php echo "Telefono: " . $pedido->teleContacto ?></p>
            <hr>
            <h3>Datos del pedido</h3>
            Numero del pedido:  <?= $pedido->idPedido ?>  <br>
            Total a pagar:  $<?= $número_formato_inglés = number_format($pedido->coste); ?><br>
         
            Estado: <?= utilidades::showStatus($pedido->estadoPedido) ?><br>



        </div>


        <div class="container mt-4 border rounded-3 p-2">    
            <div class="row ">
                <?php while ($producto = $productos->fetch_object()): ?>




                    <div class="col-md-12 carrito  d-flex justify-content-around   ">

                        <div class="col-3 divimgCar mr-3 ">  <div class="container-avatar m-1"><img class="img-fluid " style="width: 80px;height: 80px;" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>">  </div></div>
                        <div class="col-3  d-flex align-items-center"><p class="m-1"><?= $producto->nombre ?></p> </div>
                        <div class="col-3  d-flex align-items-center"> <p class="m-1"> <?= $producto->unidades ?>  </p> </div>
                        <div class="col-3  d-flex align-items-center"> <p class="m-1">$ <?= $número_formato_inglés = number_format($producto->precio); ?>  </p> </div>
                    </div>

                <?php endwhile; ?>

            </div> </div> 














    <?php endif; ?>