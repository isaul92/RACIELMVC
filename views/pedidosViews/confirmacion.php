<?php if (isset($_SESSION["pedido"]) && $_SESSION["pedido"] == "complete"): ?>
    <h1>Pedido confirmado</h1>
    <p>Tu pedido ha sido guardado con exito, una vez que realices el pago sera procesado y enviado</p><br>
    <h3>Datos del pedido</h3>

    <?php if (isset($pedido)): ?>

        Numero del pedido:  <?= $pedido->id ?>  <br>
        Total a pagar:  $<?= $pedido->coste ?><br>
        Productos:   
        <table  id="table">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>

            </tr>
            <?php while ($producto = $productos->fetch_object()): ?>
                <tr>
                    <?php if (empty($producto->imagen)): ?>
                        <td> <img class="carrito" src="<?= base_url ?>/assets/img/camiseta.png"></td>
                    <?php endif; ?> 
                    <td> <img class="carrito"  src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>">  </td>
                    <td><a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>" ><?= $producto->nombre ?></a></td>
                    <td><?= $producto->precio ?></td> 


                    <td>
                        <?= $producto->unidades ?>

                </tr>


            <?php endwhile; ?>
        </table>
    <?php endif; ?>
<?php else: ?>
    <p>Tu pedido no ha sido guardado con exito</p>
<?php endif; ?>
