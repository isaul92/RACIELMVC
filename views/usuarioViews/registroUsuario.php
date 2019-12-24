
<!--  <>  -->
<?php if (isset($_SESSION["register"]) && $_SESSION["register"] == "complete"): ?>

    <strong class='alerta '>Registro completado correctamente</strong>
       <?php utilidades::eliminarSession("register") ?>
<?php elseif (isset($_SESSION["register"]) && $_SESSION["register"] == "failed"): ?>
    <strong class='alerta alerta-error'>Registro completado incorrectamente</strong>

    <?php utilidades::eliminarSession("register") ?>
<?php endif; ?>
<h1>Registrarse</h1>
<form action="<?= base_url ?>usuario/saveUsuario" method="POST">

    <label for="nombre">Nombre</label>
    <?php echo isset($_SESSION["errores"]) ? utilidades::mostrarError($_SESSION["errores"], "nombre") : ""; ?>
    <input onchange="validar(event)"  type="text" required="required" name="nombre"/>
    <?php echo isset($_SESSION["errores"]) ? utilidades::mostrarError($_SESSION["errores"], "apellidos") : ""; ?>
    <label for="apellidos">Apellidos</label>
    <input onchange="validar(event)"  type="text" required="required" name="apellidos"/>
    <?php echo isset($_SESSION["errores"]) ? utilidades::mostrarError($_SESSION["errores"], "email") : ""; ?>
    <label for="email">Email</label>
    <input onchange="validar(event)"  type="email" required="required" name="email"/>
    <?php echo isset($_SESSION["errores"]) ? utilidades::mostrarError($_SESSION["errores"], "pass") : ""; ?>
    <label for="password">Contraseña</label>
    <input  onchange="validar(event)" type="password" required="required" name="password"/>
    <input  type="submit" value="Registrar"/>

</form>
       <?php utilidades::borrarErrores() ?>
