<div class="container mt-4 p-2">



    <?php if (isset($editar) && isset($pro) && is_object($pro)): $accion = "Editar"; ?>  
        <?php if (isset($_SESSION["modificado"]) && $_SESSION["modificado"] == "complete"): ?>

            <strong class='alerta  badge badge-success '>Registro completado correctamente</strong>
            <?php utilidades::eliminarSession("modificado") ?>
        <?php elseif (isset($_SESSION["modificado"]) && $_SESSION["modificado"] == "failed"): ?>
            <strong class='alerta alerta-error badge badge-danger '>Registro completado incorrectamente</strong>

            <?php utilidades::eliminarSession("modificado") ?>
        <?php endif; ?>


        <h1 class="display-4">Editar Producto  </h1>
        <hr>
        <?php $url_action = base_url . "producto/editarProducto&id=" . $pro->id; ?>
    <?php else: $accion = "Crear" ?>       
        <h1 class="display-4">Crear Producto</h1>
        <hr>
        <?php $url_action = base_url . "producto/save"; ?>
    <?php endif; ?>       

    <form class="" action="<?= $url_action ?>" method="POST" enctype='multipart/form-data'>
        <input  type="hidden" name="images"value="<?= $pro->imagen ?>" />

        <div class="mb-4 d-flex flex-wrap">
        <div class="col-lg-3 col-md-12">

        <label> Nombre</label>
        <input   class="form-control" type="text" required="required" name="nombre" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ""; ?>">


        <div class="row d-flex">
            <div class="col-lg-6 col-md-12">
                <label> Precio</label>
                <input   class="form-control" type="text" required="required" name="precio" value="<?= isset($pro) && is_object($pro) ? $pro->precio : ""; ?>">
            </div>
            <div class="col-lg-6 col-md-12">
                <label> Precio Descuento</label>
                <input   class="form-control" type="text" required="required" name="precioConDescuento" value="<?= isset($pro) && is_object($pro) ? $pro->precionConDescuento : ""; ?>">
            </div>
        </div>


        <label> Stock</label>
        <input  class="form-control"  type="number" required="required" name="stock" value="<?= isset($pro) && is_object($pro) ? $pro->stock : ""; ?>">
        <?php $categorias = utilidades::showCategorias() ?>
        <label> Categoria</label>
        <select  class="form-control" name="categoria_id" >
            <?php $categorias = utilidades::showCategorias() ?>

            <?php while ($categoria = $categorias->fetch_object()): ?>

                <option value="<?= $categoria->id ?>" <?= isset($pro) && is_object($pro) && $categoria->id == $pro->categoria_id ? "selected" : ""; ?>>   <?= $categoria->nombre; ?></option>


            <?php endwhile; ?>              
        </select>
           <label> Dimensiones</label>
           <textarea   class="form-control" type="text" required="required" name="dimension" value=""><?= isset($pro) && is_object($pro) ? $pro->dimensiones : ""; ?></textarea>

        </div>
        <div class="col-lg-9 col-md-12">
        <label> Descripcion</label>
        <textarea  id="ckeditor"class="ckeditor"  type="text" required="required" name="descripcion" value=""><?= isset($pro) && is_object($pro) ? $pro->descripcion : ""; ?></textarea>
       </div>
            </div>
     

        <div class="mb-4 d-flex">
            <div class="col-5">
                <label class="mt-4"> Imagen Principal</label>
                <input class="form-control mb-4 text-center" type="file" name="imagen">
            </div>
            <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>

                <div class="col-md-3 col-sm-6"> 

                    <img class="principales img-fluid rounded p-3" src="<?= base_url ?>/uploads/images/<?= $pro->imagen ?>">
                </div>  
            <?php endif; ?> 
        </div>




        <label>Imagenes secundarias</label>


        <?php $i = 2; ?>
        <div class="row d-flex">
            <?php if ($accion != "Crear"): ?>
                <?php while ($imagen = $grupoImages->fetch_object()): ?>

                    <input  type="hidden" name="images<?= $i ?>" value="<?= $imagen->nombreImagen ?>" />
                    <input  type="hidden" name="id<?= $i ?>" value="<?= $imagen->id ?>" />

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 p-4 border ">

                        <a href="<?= base_url ?>producto/eliminarImagenProduct&idPImagen=<?= $imagen->id ?>&images=<?= $imagen->nombreImagen ?>&id=<?= $imagen->id_pro ?>" class="btn btn-danger"><small>Eliminar</small></a>

                        <input class="form-control mb-4 text-center  " type="file" name="imagen<?= $i; ?>">
                        <img class="rounded img-fluid  p-3" src="<?= base_url ?>/uploads/images/<?= $imagen->nombreImagen ?>">

                    </div>
                    <?php $i++; ?>  

                <?php endwhile; ?>  
           


            <?php while ($i <= 4): ?>


                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 p-4 border ">




                    <input class="form-control mb-4 text-center  " type="file" name="imagen<?= $i; ?>">
                    <p>¡No hay imagen!</p>

                </div>
                <?php $i++; ?>

            <?php endwhile; ?>  
   <?php endif; ?>
        </div>



        <input class="btn btn-outline-success mb-4 m-4" type="submit" value=" <?= $accion ?> "><br>



    </form>

    <div class="col-4">





    </div>




