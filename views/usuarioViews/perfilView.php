<div class="container">

    <div class="row justify-content-center  ">
        <div class="col-md-8">
            <div class="card cardConfiguracion">
                <div class="card-header text-center"> <h1 class="display-4 text-center">Mi perfil</h1>
                    <?php if (isset($_SESSION["update"]) && $_SESSION["update"] == "complete"): ?>

                        <p class='btn btn-block btn-success disabled'>Actualizacion  correcta</p>
                        <?php utilidades::eliminarSession("update") ?>
                    <?php elseif (isset($_SESSION["update"]) && $_SESSION["update"] == "failed"): ?>
                        <strong class='btn btn-block btn-danger disabled'>Registro completado incorrectamente</strong>

                        <?php utilidades::eliminarSession("update") ?>
                    <?php endif; ?>


                </div>

                <div class="card-body">
                    <form method="POST" action="<?= base_url ?>usuario/update" aria-label="Configuracion de mi cuenta" >

                        <div class="form-group row">
                            <?php echo isset($_SESSION["errores"]) ? ' <div class=" disabled btn-block" >' . utilidades::mostrarError($_SESSION["errores"], "nombre") . "</div> " : ""; ?>
                            <label  class="col-md-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-6">
                                <input id="nombreInput" name="nombre" type="text" onchange="validar(event)" class="form-control" placeholder="Modificar Nombre" required autofocus value='<?= $_SESSION["identity"]->nombre ?>'>

                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?php echo isset($_SESSION["errores"]) ? ' <div class=" disabled btn-block" >' . utilidades::mostrarError($_SESSION["errores"], "apellidos") . "</div> " : ""; ?>
                            <label  class="col-md-4 col-form-label text-md-right"  >Apellidos</label>

                            <div class="col-md-6">
                                <input id="apellidoInput"  name="apellidos" type="text" class="form-control" placeholder="Modificar Apellidos" onchange="validar(event)"  value="<?= $_SESSION["identity"]->apellidos ?>" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <?php echo isset($_SESSION["errores"]) ? ' <div class=" disabled btn-block" >' . utilidades::mostrarError($_SESSION["errores"], "email") . "</div> " : ""; ?>
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>
                            <div class="col-md-6">
                                <input onchange="validar(event)" id="correo"  name="correo" type="email" disabled class="form-control"   placeholder="Modificar Correo" value="<?= $_SESSION["identity"]->email ?>" autofocus>                            
                            </div>
                        </div>


                        <div class="form-group row">
                            <?php echo isset($_SESSION["errores"]) ? ' <div class=" disabled btn-block" >' . utilidades::mostrarError($_SESSION["errores"], "email") . "</div> " : ""; ?>
                            <label for="email" class="col-md-4 col-form-label text-md-right">Telefono</label>
                            <div class="col-md-6">
                                <input id="telefono"  name="telefono" type="number"  class="form-control"   placeholder="Modificar Telefono" value="<?= $_SESSION["identity"]->telefonoAlter ?>" autofocus>                            
                            </div>
                        </div>




                        <div class="form-group row">
                            <?php echo isset($_SESSION["errores"]) ? ' <div class=" disabled btn-block" >' . utilidades::mostrarError($_SESSION["errores"], "email") . "</div> " : ""; ?>
                            <label for="email" class="col-md-4 col-form-label text-md-right">Telefono Alternativo</label>
                            <div class="col-md-6">
                                <input onchange="validar(event)" id="telefonoAlternativo"  name="telefonoAlternativo" type="number"  class="form-control"   placeholder="Modificar Telefono Alternativo" value="<?= $_SESSION["identity"]->telefono ?>" autofocus>                            
                            </div>
                        </div>



                        <?php echo isset($_SESSION["errores"]) ? ' <div class=" disabled btn-block" >' . utilidades::mostrarError($_SESSION["errores"], "pass") . "</div> " : ""; ?>
                        <div class="form-group row invisible" style="display: none;" id="passFormulario" >
                            <label class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            <div class="col-md-6" ">
                                <div class="col-md-11"> 

                                </div>
                                <input   type="password" placeholder="Modificar Contraseña" class="form-control" name="password" />                         
                                <input  type="password" placeholder="Verificar Contraseña" class="form-control" name="password2"  />                            


                            </div>
                        </div>



                        <div class="form-group row  d-flex justify-content-center">
                            <div class="col-md-6 text-center">
                                <a type="submit" id="modificarContra" onclick="javascript:oculta('passFormulario')" class="btn bg-light inicionSesion">Modificar Contraseña </a>
                                <button type="submit" id="botonGuardar" class="btn bg-light inicionSesion">Guardar Cambios </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

<?php require_once 'direccionesUser/direccionesView.php'; ?>

</div>


<?php utilidades::eliminarSession("errores"); ?>
