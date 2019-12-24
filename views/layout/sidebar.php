<aside id="lateral" >
    <div id="carrito" class="block_aside">

        <h3>Mi carrito</h3>  
        <ul>
            <?php if (isset($_SESSION["carrito"])): ?>
            <?php $stats = utilidades::statsCarrito() ?>
            
            <li><a href="<?= base_url ?>carrito/index">Productos(<?= $stats["count"] ?>)</a></li>
            <li><a href="<?= base_url ?>carrito/index">Total $<?= $stats["total"] ?></a></li>
            <li><a href="<?= base_url ?>carrito/index">Ver el carrito</a></li>
        </ul>
    </div>
      <?php endif; ?>  
    <?php if (!isset($_SESSION["identity"])): ?>
        <h3>Entrar a la web</h3>  
        <div id="login" class="block_aside">
            <form action=" <?= base_url ?>usuario/login" method="POST">
                <label>Email  </label>
                <input type="email" name="email">
                <label>Contraseña  </label>
                <input type="password" name="password">
                <input type="submit" value="Entrar">
            </form>


        <?php else: ?>

            <h3>      <?= $_SESSION['identity']->nombre ?></h3>                                         
        <?php endif; ?>  

        <ul>
            <?php if (isset($_SESSION["admin"])): ?>
                <li>    <a href="<?= base_url ?>pedidos/gestionPedidos">Gestionar pedidos</a></li>
                <li>    <a href="<?= base_url ?>categoria/index">Gestionar categorias</a></li>
                <li>    <a href="<?= base_url ?>producto/gestion">Gestionar productos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION["identity"])): ?>
                <li>    <a href="<?= base_url ?>pedidos/misPedidos">Mis pedidos</a></li>
                <li>    <a href="<?= base_url ?>usuario/logout">Cerrar sesion</a></li>
            <?php else: ?>
                <li>  <a href="<?= base_url ?>usuario/registro">Registrate aqui</a></li> 

            <?php endif; ?>
        </ul>

    </div>

</aside> 
<div id="central">