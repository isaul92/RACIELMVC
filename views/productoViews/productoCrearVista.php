<div class="container mt-4 p-2">
    


<?php if (isset($editar) && isset($pro) && is_object($pro)): $accion="Editar"; ?>  
<?php if (isset($_SESSION["modificado"]) && $_SESSION["modificado"] == "complete"): ?>

    <strong class='alerta '>Registro completado correctamente</strong>
       <?php utilidades::eliminarSession("modificado") ?>
<?php elseif (isset($_SESSION["modificado"]) && $_SESSION["modificado"] == "failed"): ?>
    <strong class='alerta alerta-error'>Registro completado incorrectamente</strong>

    <?php utilidades::eliminarSession("modificado") ?>
<?php endif; ?>
    
    
    <h1>Editar Producto   <?= $pro->nombre?></h1>
    <?php     $url_action=base_url."producto/editarProducto&id=".$pro->id;   ?>
<?php else: $accion="Crear"?>       
    <h1>Crear Producto</h1>
    <?php     $url_action=base_url."producto/save";  ?>
<?php endif; ?>       

<form action="<?=  $url_action ?>" method="POST" enctype='multipart/form-data'>
    <input  type="hidden" name="images"value="<?=$pro->imagen ?>" />
    <label> Nombre</label>
    <input type="text" required="required" name="nombre" value="<?= isset($pro) && is_object($pro)? $pro->nombre : ""; ?>">
    <label> Descripcion</label>
    <input type="text" required="required" name="descripcion" value="<?= isset($pro) && is_object($pro)? $pro->descripcion : ""; ?>">
    <label> Precio</label>
    <input type="text" required="required" name="precio" value="<?= isset($pro) && is_object($pro)? $pro->precio : ""; ?>">
    <label> Stock</label>
    <input type="number" required="required" name="stock" value="<?= isset($pro) && is_object($pro)? $pro->stock : ""; ?>">
    <?php $categorias = utilidades::showCategorias() ?>
    <label> Categoria</label>
    <select name="categoria_id" >
        <?php $categorias = utilidades::showCategorias() ?>

        <?php while ($categoria = $categorias->fetch_object()): ?>

            <option value="<?=$categoria->id ?>" <?= isset($pro) && is_object($pro) && $categoria->id==$pro->categoria_id ? "selected" : ""; ?>>   <?= $categoria->nombre; ?></option>


        <?php endwhile; ?>              
    </select>
    <label> Imagen</label>
    <input type="file" name="imagen">
  

    <input type="submit" value=" <?=$accion ?> ">
      <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
    <img class="principales" src="<?=base_url ?>/uploads/images/<?=$pro->imagen ?>"
              <?php endif; ?> 
</form>

</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

