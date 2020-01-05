<?php
ob_start();
?>
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">



    <meta property="og:url"           content="http://racielarquitectos.mx/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Raciel Arte en Madera" />
    <meta property="og:description"   content="Escultura en finas maderas" />
    <meta property="og:image"         content="http://racielarquitectos.mx/img/casa1.jpg" />

    <?php
    require_once './views/layout/scripts.php';
    header("HTTP/1.1 200 OK");
    ?>
    <title>Raciel Arquitectos</title>
</head>
<body>
    <div class="container>"

         <div class="row  cabezera ">
            <div class="col d-lg-flex">
                <div class="col-lg-6 col-sm-12 text-center">
                    <a href="<?= base_url ?>" class=""> <img class="logo " src="<?= base_url ?>/assets/img/logoAr.png" alt=""></a>
                </div>

                <div id="navOpcionesQuitarPadding" class="col-lg-6 col-sm-12   d-flex  align-items-end flex-row-reverse ">
                    <nav id="navOpcionesQuitarPadding" class="col navbar navbar-expand-lg navbar-light mb-1  ">
                        <div class="collapse navbar-collapse  d-lg-flex flex-lg-column-reverse  " id="navbarTogglerDemo01">
                            <ul id="navOpcionesQuitarPadding" class="navbar-nav   pb-2 mt-2 mt-lg-0 text-center ">
                                <?php if (isset($_SESSION["identity"])): ?>                        
                                    <li class="nav-item dropdown    ">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle navHover" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <?php echo $_SESSION["identity"]->nombre; ?>              <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right quitarBorder"  aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item quitarAlineado" href="<?= base_url ?>usuario/miPerfil"> 
                                                Mi Datos
                                            </a>

                                            <!-----INICIO DE SESION ----->
                                            <?php if (isset($_SESSION["admin"])): ?>
                                                <a  class="dropdown-item "  href="<?= base_url ?>pedidos/gestionPedidos">Gestionar pedidos</a>
                                                <a class="dropdown-item"  href="<?= base_url ?>categorias/index">Gestionar categorias</a>
                                                <a class="dropdown-item"  href="<?= base_url ?>producto/gestion">Gestionar productos</a>
                                                <a class="dropdown-item"  href="<?= base_url ?>?controller=noticias&action=Gestion">Gestionar noticias</a>
                                                <a class="dropdown-item"  href="<?= base_url ?>obrasArquitecto/gestion">Gestionar Obras </a>
                                                <a class="dropdown-item"  href="<?= base_url ?>usuario/gestion">Gestionar Usuarios </a>
                                            <?php endif; ?>

                                            <?php if (isset($_SESSION["identity"])): ?>
                                                <a class="dropdown-item"  href="<?= base_url ?>pedidos/misPedidos">Mis pedidos</a>
                                                <a  class="dropdown-item" href="<?php echo base_url; ?>usuario/logout">Cerrar sesion</a>
                                            <?php else: ?>
                                                <a class="dropdown-item"  href="<?= base_url ?>usuario/registro">Registrate aqui</a>
                                            <?php endif; ?>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            </form>
                                        </div>
                                    </li>


                                <?php else: ?> 


                                    <li class="nav-item">
                                        <a class="nav-link navLogin navHover"href="<?= base_url ?>usuario/loggearse">INICIAR SESION</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  navLogin navHover" href="#">REGRISTRARSE</a>
                                    </li>


                                <?php endif; ?> 
                                <!-----CARRITO DE COMPRAS ----->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle navHover" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img class="sombra" width="35px" height="35px" src="<?= base_url; ?>/assets/img/carrito.png" alt="">            
                                    </a>

                                    <?php if (isset($_SESSION["carrito"])): ?>
                                        <?php $stats = utilidades::statsCarrito() ?>


                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item text-center"  href="<?= base_url; ?>producto/index" href="<?= base_url ?>carrito/index">Productos(<?= $stats["count"] ?>)</a>
                                            <a class="dropdown-item text-center"  href="<?= base_url ?>carrito/index">Total $<?= $stats["total"] ?></a>
                                            <a class="dropdown-item text-center"  href="<?= base_url ?>carrito/index">Ver el carrito</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            </form>
                                        </div>
                                    <?php else: ?>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item text-center"  href="#">Carrito Vacio</a>

                                            </form>
                                        </div>

                                    <?php endif; ?>
                                </li>
                                <li class="nav-item dropdown  mt-2  ">
                                    <input style="margin: -4px;"type="text" class="form-control" placeholder="Buscar">
                                </li>
                            </ul>
                        </div>
                    </nav> 
                </div>
            </div>
        </div>

        <nav class="navbar navbar-toggler fixe">
            <div class="collapse navbar-collapse  " id="--+

                 3..0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>


        <div class="col d-flex">
            <!-----BARRA DE NAVEGACION ----->

            <nav class="col navbar barraPrincipal border-2 border navbar-expand-lg navbar-light mb-1  "> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="col-lg-6 col-sm-12  d-flex justify-content-start">
                    <div class="collapse navbar-collapse  d-lg-flex flex-lg-column-reverse " id="navbarTogglerDemo01">

                        <ul class="navbar-nav  pb-2 mt-2 mt-lg-0 text-center">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link principalLetrasNav dropdown-toggle navHover" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    RACIEL ARQUITECTOS             
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="<?= base_url; ?>?controller=producto&action=verTodos">
                                        <small></small>PROYECTOS
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" id="navbarDropdown" class="nav-link principalLetrasNav dropdown-toggle navHover"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    RACIEL ARTE EN MADERA            
                                </a>                      
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center" href="<?= base_url; ?>?controller=producto&action=verTodos">
                                        PRODUCTOS
                                    </a>
                                    <?php $categorias = utilidades::showCategorias() ?>
                                    <?php while ($product = $categorias->fetch_object()): ?>
                                        <a class="dropdown-item text-center" href="<?= base_url ?>?controller=categorias&action=ver&id=<?= $product->id; ?>"><?= $product->nombre; ?></a>
                                    <?php endwhile; ?>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link principalLetrasNav navHover"   data-toggle="modal" data-target="#fm-modal" href="<?= base_url; ?>usuario/index">NOSOTROS</a>
                                <div class="container" 
                                     <div class="row">  
                                        <div class="col-md-12 ">
                                            <div class="modal fade " id="fm-modal" tabindex="-1" role="dialog" aria-labelledby="fm-modal"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p class="m-3 p-3 text-center">Somos una empresa dedicada a la fabricación de piezas de madera, como muebles y decoración para el hogar y oficina, realizados en maderas finas.</p>
                                                            <div class="video mt-4">
                                                                <video autoplay muted loop>
                                                                    <source src="<?= base_url ?>assets/img/inicio.mp4" type="video/mp4">
                                                                </video>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="d-flex justify-content-center">

            <div class="col-lg-1 col-xs-2 mt-4 ml-1 p-3  categoriasMenu ">

                <div class=" col-12">

                    <a class="dropdown-item text-center m-2 p-2 rounded principalLetrasNav " href="<?= base_url ?>carrito/index">Mi carrito</a>
                    <?php $categorias = utilidades::showCategorias() ?>
                    <?php while ($product = $categorias->fetch_object()): ?>
                        <a class="dropdown-item text-center mt-2 p-2 rounded principalLetrasNav " href="<?= base_url ?>?controller=categorias&action=ver&id=<?= $product->id; ?>"><?= $product->nombre; ?></a>
                    <?php endwhile; ?>







                </div>

            </div>     


            <div class="col-11 sliderLeft">

