

<?php
$stats = utilidades::statsCarrito();
$coste = $stats["total"];
$carr = json_encode($_SESSION["carrito"], JSON_FORCE_OBJECT);
?>
<div class="container mt-4 p-3 text-center d-lg-flex justify-content-center" >

    <div class=" col-6    my-3 p-2  ">  
        <h1 class="display-4 mb-4  carritoh1">Seleccionar Destino </h1>
        <a href="<?= base_url ?>carrito/index" class="">Ver los detalle del pedido </a>
        <input type='hidden' id='coste' value='<?= $coste ?>'>
        <input type='hidden' id='idUser' value='<?= $_SESSION["identity"]->id ?>'>
        <input type='hidden' id='carrito' value='<?= $carr ?>'>
    </div>  
    <?php if (isset($_SESSION["identity"])): ?>
        <div class=" col-lg-6 col-md-12   d-flex my-3 p-2  ">    


            <div class="col-10 ">
                <div class="btn btn-group-toggle " data-toggle="buttons">
                    <?php while ($direccion = $misDirecciones->fetch_object()): $id = $direccion->id ?>


                        <label class="btn rounded-3 border contenedorDireccionesPedido mb-2 selectAdress" name="<?= $direccion->id ?>" >
                            <input type="radio" name="direccion" id="direccionid<?= $id ?>">
                            <?php echo $direccion->codigoPostal ?>
                            <?php echo $direccion->estado ?>
                            <?php echo $direccion->municipio ?>
                            <?php echo $direccion->colonia ?>
                            <?php echo $direccion->calle ?>
                            <?php echo $direccion->noExterior ?>
                            <?php echo $direccion->noInterior ?>
                            <?php echo $direccion->entreCalles ?>
                            <?php echo $direccion->referencias ?>
                            <?php echo "Telefono: " . $direccion->teleContacto ?>
                            <div class='col-2 p-0 ' >
                                <form class='direccionDiv' id='direccion<?= $id ?>'>

                                    <div class="" >
                                        <label >

                                            <input type='hidden' id='estado<?= $id ?>' value='<?= $direccion->idEstado ?>'>
                                            <input type='hidden' id='calle<?= $id ?>' value='<?= $direccion->calle ?>'>
                                            <input type='hidden' id='noExterior<?= $id ?>' value='<?= $direccion->noExterior ?>'>
                                            <input type='hidden' id='noInterior<?= $id ?>' value='<?= $direccion->noInterior ?>'>
                                            <input type='hidden' id='entreCalles<?= $id ?>' value='<?= $direccion->entreCalles ?>'>
                                            <input type='hidden' id='referencias<?= $id ?>' value='<?= $direccion->referencias ?>'>
                                            <input type='hidden' id='teleContacto<?= $id ?>' value='<?= $direccion->teleContacto ?>'>
                                            <input type='hidden' id='cdpostal<?= $id ?>' value='<?= $direccion->codigoPostal ?>'>
                                            <input type='hidden' id='colonia<?= $id ?>' value='<?= $direccion->colonia ?>'>
                                            <input type='hidden' id='municipio<?= $id ?>' value='<?= $direccion->idMunicipio ?>'>



                                            </div>
                                            </form>

                                            </div>
                                        </label>




                                    <?php endwhile; /*  <a href='#'   name='<?= $id ?>' value='modificarDireccion'  onclick="javascript:oculta('item0')" class='editarDireccion'>Seleccionar Direccion</a> */ ?>
                                   
                                </div>

                        </div>

                </div>



            <?php else : ?>
                <h1>Necesitas estar identificado</h1>
                <p>Necesitas estar logeado en la web para realizar tu pedido</p>
            <?php endif; ?>


        </div>

 <form action="<?= base_url ?>pedidos/add" method="POST">
                                        <input type="hidden" id="direccion" name="direccion" value="">
                                       <input type="submit" id="confirmarDireccion" class="btn btn-light my-3" disabled  value="Hacer Pedido">
                                    </form> 
       