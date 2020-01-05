
<div class="container">

    <h1 class="text-center display-4">Productos Gestion</h1>
    <hr>

    <form id="buscarProductos" method="POST">
        <div class="radiogp btn-group btn-group-toggle mb-2" data-toggle="buttons">
            <label class="btn btn-outline-warning active">
                <input type="radio" name="options" value="idBuscarProducto" id="idBuscarProducto" autocomplete="off" checked> ID
            </label>
            <label class="btn btn-outline-warning">
                <input type="radio" name="options" value="nombreBuscarProducto" id="nombreBuscarProducto" autocomplete="off"> Nombre
            </label>
            <label class="btn btn-outline-warning">
                <input type="radio" name="options" value="descripcionBuscarProducto" id="descripcionBuscarProducto" autocomplete="off"> Descripcion
            </label>
        </div>
        <input class="form-control mb-4" required onchange="validar(event)"  type="text" name="buscadorProductosInput" id="inputBuscarProductoId" placeholder="Buscar un producto">

    </form>

    <div class="buscadorProductos">

  <a href="<?= base_url ?>producto/gestion"  class="mb-4 btn btn-outline-success"> Mostrar todos producto</a>
        <a href="<?= base_url ?>producto/crear" class="mb-4 btn btn-outline-success"> Crear producto</a>
        </nav>
    </div>


    <?php if (isset($_SESSION["delete"]) && $_SESSION["delete"] == "complete"): ?>
        <strong class="alerta">Producto eliminado con exito</strong>

    <?php elseif (isset($_SESSION["delete"]) && $_SESSION["delete"] == "failed"): ?>
        <strong class="alerta alerta-error">Producto no eliminado con exito</strong>
        <?php
    endif;
    utilidades::eliminarSession("delete");
    ?>



    <?php if (isset($_SESSION["producto"]) && $_SESSION["producto"] == "complete"): ?>
        <strong class="alerta badge badge-success">Producto creado con exito</strong>

    <?php elseif (isset($_SESSION["producto"]) && $_SESSION["producto"] == "failed"): ?>
        <strong class="alerta alerta-error  badge badge-danger">Producto no creado con exito</strong>
        <?php
    endif;
    utilidades::eliminarSession("producto");
    ?>
    <div class="" id="buscadorProductos">

    </div>
    <div id="tablaBuscarProd">
        <div class="row ">

            <div class='col-12 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>  
                <?php while ($product = $productos->fetch_object()): ?>

                  <?php if ($product->status=="AC") : ?>

                    <div class='card col-lg-3 col-sm-6 m-1'>
                        <div class='card-header fondoBlanco d-flex'>
                            <div class="container-avatar ">
                                <img class="img-fluid " style="width: 80px;height: 80px;" src="<?= base_url ?>uploads/images/<?= $product->imagen ?>">
                            </div>
                            <a href='<?= base_url ?>producto/ver&id=<?= $product->id; ?>' > <label><?= $product->nombre; ?> </label> </a>
                        </div>


                        <div class='card-body fondoBlanco'>
                            <div class=' row d-flex  flex-wrap '>
                                <div class='col-12 fondoBlanco'>
                                    <label>   Producto ID: <?= $product->id; ?> </label>
                                    <p>  Categoria: <?= $product->nombreCategoria; ?> </p>
                                    <p>Descripcion :</p>
                                    <p><?= $product->descripcion; ?>'</p>
                                </div>
                                <div class='col-6  fondoBlanco'>Precio: $<?= $product->precio; ?></div>
                              
                            </div>
                        </div>
                        <div class='card-footer fondoBlanco'>
                            <td>   <a href='<?= base_url ?>producto/eliminar&id=<?= $product->id; ?>' style='color:black;' class='btn m-1 btn-outline-danger'>Eliminar </a>
                                <a href='<?= base_url ?>producto/editar&id=<?= $product->id; ?>' style='color:black;' class='btn btn-outline-warning m-1' >Editar</a>
                            </td>
                        </div>


                    </div>
                 <?php endif; ?>

                <?php endwhile; ?>
            </div>
            </table>

            <div id="buscadorProductos">

            </div>


        </div>
    <?php

/* <>   <>  <>  <>  <>  <>  <>  <>  <>  <>  <>  <>  <>  <>  <> <> <> <>
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and   ddddddd open the template in the editor.isaul mendieya galindo  -
 * 872
 */

