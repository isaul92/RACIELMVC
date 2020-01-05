

<div class="container mt-4 p-2">



    <?php if (isset($editar) && isset($pro) && is_object($pro)): $accion = "Editar"; ?>  
        <?php if (isset($_SESSION["modificado"]) && $_SESSION["modificado"] == "complete"): ?>

            <strong class='alerta  badge badge-success '>Registro completado correctamente</strong>
            <?php utilidades::eliminarSession("modificado") ?>
        <?php elseif (isset($_SESSION["modificado"]) && $_SESSION["modificado"] == "failed"): ?>
            <strong class='alerta alerta-error badge badge-danger '>Registro completado incorrectamente</strong>

            <?php utilidades::eliminarSession("modificado") ?>
        <?php endif; ?>


        <h1 class="display-4">Editar Noticia  </h1>
        <hr>
        <?php $url_action = base_url . "noticias/editarNoticia&id=" . $pro->id; ?>
    <?php else: $accion = "Crear" ?>       
        <h1 class="display-4">Crear Noticia</h1>
        <hr>
        <?php $url_action = base_url . "noticias/save"; ?>
    <?php endif; ?>       

    <form class="" action="<?= $url_action ?>" method="POST" enctype='multipart/form-data'>
         <input  type="hidden" name="id" value="<?= isset($pro) && is_object($pro) ? $pro->id : "";  ?>" />
          <input  type="hidden" name="id_noticia" value="<?= $_GET["id"] ?>" />
        <input  type="hidden" name="images" value="<?= isset($pro) && is_object($pro) ? $pro->nombreImagen : "";  ?>" />

        <div class="mb-4 d-flex flex-wrap">
        <div class="col-lg-3 col-md-12">
            <input type="hidden" id="user_id" name="user_id" value="<?=$_SESSION["identity"]->id ?>">
        <label> Nombre</label>
        <input   class="form-control" type="text" required="required" name="nombre" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ""; ?>">


       
     
                <label class="mt-4"> Imagen Principal</label>
                <input class="form-control mb-4 text-center" type="file" name="imagen">
        
            <?php if (isset($pro) && is_object($pro) && !empty($pro->nombreImagen)): ?>

             

                  
                    <img class="principales img-fluid rounded p-3" src="<?= base_url ?>/uploads/images/<?= $pro->nombreImagen ?>">
               
            <?php endif; ?> 
                <input class="btn btn-outline-success mb-4 m-4" type="submit" value=" <?= $accion ?> "><br>
        </div>
        <div class="col-lg-9 col-md-12">
        <label> Descripcion</label>
        <textarea  id="ckeditor"class="ckeditor"  type="text" required="required" name="texto" value=""><?= isset($pro) && is_object($pro) ? $pro->texto : ""; ?></textarea>
       </div>
            </div>
     




        



  



    </form>

 

