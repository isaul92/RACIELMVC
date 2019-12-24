<?php

require_once 'models/productoModelo.php';

class productoController {

    public function index() {
$producto=new productoModelo();
$productos=$producto->getRandom(6);

        require_once 'views/productoViews/productosDestacados.php';
    }

    public function gestion() {
        utilidades::isAdmin();
        $producto = new productoModelo();
        $productos = $producto->getAll();
        require_once 'views/productoViews/productoGestion.php';
    }

    public function crear() {
        utilidades::isAdmin();

        require_once 'views/productoViews/productoCrearVista.php';
    }

    public function save() {
        utilidades::isAdmin();
        if (isset($_POST)) {

            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $categoria_id = isset($_POST["categoria_id"]) ? $_POST["categoria_id"] : false;
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
            $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
            $imagen = isset($_POST["imagen"]) ? $_POST["imagen"] : false;


            if ($nombre && $descripcion && $categoria_id && $precio && $stock) {

                $producto = new productoModelo();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria_id);

                $producto->setPrecio($precio);
                $producto->setStock($stock);


                $archivo = $_FILES["imagen"];
                $filename = $archivo["name"];
                $mimetype = $archivo["type"];



                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {


                    if (!is_dir("uploads/images")) {
                        mkdir("uploads/images", 0777, true);
                    }

                    move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                    $producto->setImagen($filename);
                }
                $save = $producto->save();
                if ($save) {
                    $_SESSION["producto"] = "complete";
                } else {
                    $_SESSION["producto"] = "failed";
                }
            } else {

                $_SESSION["producto"] = "failed";
            }
        }
        header("Location:" . base_url . "producto/gestion");
    }

    public function editarProducto() {
        utilidades::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $categoria_id = isset($_POST["categoria_id"]) ? $_POST["categoria_id"] : false;
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
            $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
            if ($nombre && $descripcion && $categoria_id && $precio && $stock) {
                $producto = new productoModelo();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria_id);
                $producto->setId($_GET["id"]);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $desprendible = $_FILES["imagen"];
                if ($_FILES['imagen']['name'] != null) {
                    $archivo = $_FILES["imagen"];
                    $filename = $archivo["name"];
                    $mimetype = $archivo["type"];
                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir("uploads/images")) {
                            mkdir("uploads/images", 0777, true);
                        }
                        move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                        $producto->setImagen($filename);
                    }
                } else {

                    $producto->setImagen($_POST["images"]);
                }

                $save = $producto->editar();
                if ($save) {
                    $_SESSION["modificado"] = "complete";
                } else {
                    $_SESSION["modificado"] = "failed";
                }
            } else {

                $_SESSION["modificado"] = "failed";
            }
        }
        header("Location:" . base_url . "producto/editar&id={$_GET["id"]}");
    }

    public function editar() {
        utilidades::isAdmin();
        $editar = true;
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setId($_GET["id"]);
            $pro = $producto->getOne();



            require_once 'views/productoViews/productoCrearVista.php';
        } else {
            header("Location:" . base_url . "producto/gestion");
        }
    }

    public function eliminar() {
        utilidades::isAdmin();
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setId($_GET["id"]);
            $delete = $producto->delete();
            if ($delete) {
                $_SESSION["delete"] = "complete";
            } else {
                $_SESSION["delete"] = "failed";
            }
        } else {
            $_SESSION["delete"] = "failed";
        }
        header("Location:" . base_url . "producto/gestion");
    }
    public function ver(){
        utilidades::isAdmin();
        $editar = true;
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setId($_GET["id"]);
            $pro = $producto->getOne();



          
      
        }
          require_once 'views/productoViews/verProducto.php';
    }

}
