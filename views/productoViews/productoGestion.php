
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

  
                        <a href="<?= base_url ?>producto/crear" class="btn btn-outline-success"> Crear producto</a>
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
                            <strong class="alerta">Producto creado con exito</strong>

                        <?php elseif (isset($_SESSION["producto"]) && $_SESSION["producto"] == "failed"): ?>
                            <strong class="alerta alerta-error">Producto no creado con exito</strong>
                            <?php
                        endif;
                        utilidades::eliminarSession("producto");
                        ?>
                            <div id="tablaBuscarProd">
                                <table id="allProducts" class="table  table-striped table-responsive table-hover d-flex justify-content-center">

                            <tr>
                                <th>Categoria ID</th>
                                <th>Producto ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                            <?php while ($product = $productos->fetch_object()): ?>
                                <tr>
                                    <td><?= $product->categoria_id; ?></td>
                                    <td><?= $product->id; ?></td>
                                    <td><?= $product->nombre; ?></td>
                                    <td><?= $product->descripcion; ?></td>
                                    <td><?= $product->precio; ?></td>
                                    <td><?= $product->stock; ?></td>
                                    <td>   <a href="<?= base_url ?>producto/eliminar&id=<?= $product->id; ?>" style="color:black;" class="btn m-1 btn-outline-light">Eliminar </a>
                                        <a href="<?= base_url ?>producto/editar&id=<?= $product->id; ?>" style="color:black;" class="btn btn-outline-light m-1" >Editar</a></td>


                                </tr>

                            <?php endwhile; ?>
                        </table>
                                </div>
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

