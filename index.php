<?php

session_start();
require_once './vendor/autoload.php';
require_once "./autoload.php";
require_once './config/parametros.php';
require_once './config/dataBase.php';
require_once './helpers/utilidades.php';
require_once './helpers/FormatTime.php';

//require_once './views/layout/video.php';
//require_once './views/layout/sidebar.php';


function showError() {
    $error = new ErrorController();
    $error->index();
    exit();
}

if (isset($_GET['controller'])) {


    $nombre_controlador = $_GET["controller"] . 'Controller';
} elseif (!isset($_GET["controller"]) && !isset($_GET["action"])) {

    require_once './views/layout/head.php';
    $nombre_controlador = controller_default;
} else {
    showError();
    exit();
}

if (class_exists($nombre_controlador)) {

    $controlador = new $nombre_controlador();
    if ($nombre_controlador != "apiController") {
        require_once './views/layout/head.php';
    }

    if (isset($_GET["action"]) && method_exists($controlador, $_GET["action"])) {
        $action = $_GET["action"];

        $controlador->$action();

        if ($nombre_controlador != "apiController") {
            require_once './views/layout/footer.php';
        }
    } elseif (!isset($_GET["controller"]) && !isset($_GET["action"])) {

        $action_default = action_default;
        $controlador->$action_default();

        if ($nombre_controlador != "apiController") {
            require_once './views/layout/footer.php';
        }
    } else {
        showError();
    }
}


