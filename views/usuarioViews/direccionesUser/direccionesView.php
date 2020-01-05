<div class="row justify-content-center border rounded mt-4">
    <div class="col-md-8 ">
        <h1 class="display-4 text-center">Mis direcciones</h1>
        <hr>


        <?php while ($direccion = $misDirecciones->fetch_object()): $id = $direccion->id ?>
         <?php if ($direccion->estadoDir=="AC"): ?>
        
            <div class=" col-12 d-flex my-3 p-2 contenedorDirecciones divEliminarDireccion<?= $id ?>">    


                <div class="col-10">

                    <label> <?php echo $direccion->codigoPostal ?></label>
                    <label>   <?php echo $direccion->estado ?></label>
                    <label>   <?php echo $direccion->municipio ?></label>
                    <label>   <?php echo $direccion->colonia ?></label>
                    <label>   <?php echo $direccion->calle ?></label>
                    <label>  <?php echo $direccion->noExterior ?></label>
                    <label><?php echo $direccion->noInterior ?></label>
                    <label>  <?php echo $direccion->entreCalles ?></label>
                    <label>    <?php echo $direccion->referencias ?></label>
                    <label> <?php echo "Telefono: " . $direccion->teleContacto ?></label>

                </div>
                <div class='col-2 p-0 '>
                    <form class='direccionDiv' id='direccion<?= $id ?>'>

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




                        <a href='#'   name='<?= $id ?>' value='modificarDireccion'  onclick="javascript:oculta('item0')" class='editarDireccion'>Editar</a>
                        <a href='#'  name='<?= $id ?>' class='eliminarDireccion'>Eliminar</a>
                    </form>

                </div>

            </div>
         <?php endif; ?>
        <?php endwhile; ?>
        <div class="agregarDivsDirecciones"></div>
        <?php
        if (isset($_REQUEST['rutear'])) {
            echo "Estado: " . $_REQUEST['cmbEstados'] . "<br>";
            echo "Total: " . $_REQUEST['totalMunicipios'] . "<br>";
            echo "Municipio: " . $_REQUEST['cmbMunicipios'] . "<br>";
            echo "Texto: " . $_REQUEST['areaTexto'] . "<br>";
        } else
            
            ?>

        <!------ AGREGAR DIRECCIONES----->
        <div class="col-12 ">

            <div id='messageEliminado' class=' badge badge-danger'>Direccion Eliminada</div>
            <button class="agregarDireccion btn btn-light " id="btnAgregar"  onclick="javascript:oculta('item0')"> Agregar direccion</button>
            <div class="invisible" id="item0" style="display: none;">
                <form id="frmCombos" name="frmCombos" class="my-4">
                    <input type="hidden" id="idDireccion" value="">
                    <input type="hidden" id="user_id" value="<?= $_SESSION["identity"]->id ?>">
                    <div class="form-group row">


                        <div class="col-md-12 d-lg-flex">
                            <div class="col-lg-6 col-md-12 m-0 p-0">
                                Estado:
                                <?= utilidades::llenarEstados() ?>
                            </div>
                            <div class="col-lg-6 col-md-12 m-0 p-0">
                                Municipios:
                                <?= utilidades::llenarMunicipios() ?> 
                            </div>
                        </div> 
    
                        <div class="col-md-12 d-lg-flex">
                            <div class="col-lg-6 col-md-12 m-0 p-0 " >
                                <input id="CDPOSTAL" name="CDPOSTAL" type="number" onchange="validar(event)" class="inputDirecciones form-control " placeholder="CODIGO POSTAL" required >
                            </div>
                            <div class="col-lg-6 col-md-12 m-0 p-0">
                                <input id="colonia" name="colonia" type="text" onchange="validar(event)" class="inputDirecciones form-control " placeholder="COLONIA" required >
                            </div>
                        </div>

                        <div class="col-md-12 d-lg-flex">
                            <div class="col-lg-6 col-md-12 m-0 p-0">
                                <input id="calle" name="calle" type="text" onchange="validar(event)" class="inputDirecciones form-control " placeholder="CALLE" required >
                            </div>    
                            <div class="col-lg-3 col-md-12 p-0 m-0">
                                <input id="noExterior" name="noExterior" type="text" onchange="validar(event)" class="inputDirecciones form-control " placeholder="NO. EXTERIOR" required >
                            </div>
                            <div class="col-lg-3 col-md-12 p-0 m-0">
                                <input id="noInterior" name="noInterior" type="text" onchange="validar(event)" class="inputDirecciones form-control " placeholder="NO. INTERIOR" required >
                            </div>
                        </div>

                        <div class="col-md-12 d-lg-flex">
                            <div class="col-lg-6 col-md-12 m-0 p-0">
                                <input id="entreCalles" name="entreCalles" type="text" onchange="validar(event)" class="inputDirecciones form-control " placeholder="ENTRE CALLES" required >
                            </div>
                            <div class="col-lg-6 col-md-12 m-0 p-0">
                                <input id="referencias" name="referencias" type="text" onchange="validar(event)" class="inputDirecciones form-control " placeholder="REFERENCIAS" required >
                            </div>
                        </div>
                        <div class="col-md-12 d-lg-flex">
                            <input id="teleContacto" name="teleContacto" type="number" onchange="validar(event)" class="inputDirecciones form-control " placeholder="TELEFONO DE CONTACTO" required >
                        </div>


                    </div>
                    <button  href="#" id="btnAgregarDireccion" value="nuevaDireccion" class=" btn bg-light ">Guardar Direccion </button>
                    <button class="agregarDireccion btn btn-light "   onclick="javascript:oculta('item0')"> Cancelar</button>   
                </form>
            </div>




        </div>
    </div>
</div>