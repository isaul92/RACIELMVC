<?php

require_once 'models/productoModelo.php';

class carritoController {

    public function index() {
        if (isset($_SESSION["carrito"])) {
            $carrito = $_SESSION["carrito"];
        }


        require_once 'views/carritoViews/verCarritoView.php';
    }

    public function add() {
        if (isset($_GET["id"])) {
            $producto_id = $_GET["id"];
        } else {
            header("Location:" . base_url);
        }

        if (isset($_SESSION["carrito"])) {
            $counter = 0;
            foreach ($_SESSION["carrito"] as $indice => $elemento) {
                if ($elemento["id_producto"] == $producto_id) {
                    $_SESSION["carrito"][$indice]["unidades"] ++;
                    $counter++;
                }
            }
        }
        if (!isset($counter) || $counter == 0) {
            //CONSEGUIR PRODUCTO
            $producto = new productoModelo();
            $producto->setId($producto_id);
            $producto = $producto->getOne();
            if ($producto->precionConDescuento !== "0") {
                $precio = $producto->precionConDescuento;
            } else {
                $precio = $producto->precio;
            }

            //AÑADIR AL CARRITO
            if (is_object($producto)) {
                $_SESSION["carrito"][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }

        header("Location:" . base_url . "carrito/index");
    }

    public function remove() {
        if (isset($_GET["id"])) {
            $indice = $_GET["id"];
            unset($_SESSION["carrito"][$indice]);
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function aumentar() {
        if (isset($_GET["id"])) {
            $indice = $_GET["id"];
            $_SESSION["carrito"][$indice][unidades] ++;
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function restar() {
        if (isset($_GET["id"])) {
            $indice = $_GET["id"];
            $_SESSION["carrito"][$indice][unidades] --;
            if ($_SESSION["carrito"][$indice]["unidades"] == 0) {
                unset($_SESSION["carrito"][$indice]);
            }
            if (empty($_SESSION["carrito"])) {
                unset($_SESSION["carrito"]);
            }
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function delete_all() {
        unset($_SESSION["carrito"]);
        $_SESSION["carrito"] = null;
        header("Location:" . base_url . "carrito/index");
    }

}
