<?php

require_once 'models/pedidosModelo.php';

class pedidosController {

    public function index() {
        echo "controllador pedidos";
    }

    public function hacer() {
        utilidades::isLogger();

        $misDirecciones = new direccionesUserController();
        $misDirecciones = $misDirecciones->getMyAdresses($_SESSION["identity"]->id);


        require_once 'views/pedidosViews/pedido.php';
    }

    public function add() {
        if (isset($_SESSION["identity"])) {

            $usuario_id = $_SESSION["identity"]->id;

            $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : false;

            if ($direccion) {
                //GUARDAR DATOS
                $stats = utilidades::statsCarrito();
                $coste = $stats["total"];
                $pedido = new PedidoModelo();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
                $save = $pedido->save();
                $saveLineas = $pedido->saveLinea();
                if ($save && $saveLineas) {
                    $_SESSION["pedido"] = "complete";
                    $_SESSION["carrito"] = null;
                } else {
                    $_SESSION["pedido"] = "failed";
                }
            }
        } else {
            header("Location:" . base_url);
        }
        header("Location:" . base_url . "pedidos/confirmado");
          echo"<script language='javascript'>window.location='".base_url . "pedidos/confirmado"."'</script>;";
    }

    public function confirmado() {
        if (isset($_SESSION["identity"])) {
            $pedido = new PedidoModelo();
            $identity = $_SESSION["identity"];
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();

            $pedido_productos = new PedidoModelo();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        } else {
            header("Location:" . base_url);
              echo"<script language='javascript'>window.location='".base_url . "</script>;";
        }

        require_once 'views/pedidosViews/confirmacion.php';
    }

    public function misPedidos() {
        utilidades::isLogger();
        $pedido = new PedidoModelo();
        $usuario_id = $_SESSION["identity"]->id;
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedidosViews/mispedidos.php';
    }

    public function detalle() {
        utilidades::isLogger();
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $pedido = new PedidoModelo();
            $usuario_id = $_SESSION["identity"]->id;
            $pedido->setId($id);
            $pedido = $pedido->getOne();
            $pedido_productos = new PedidoModelo();
            $productos = $pedido_productos->getProductosByPedido($id);
        } else {
            header("Location:" . base_url . "pedidos/mispedidos");
              echo"<script language='javascript'>window.location='".base_url . "pedidos/mispedidos"."'</script>;";
        }

        require_once 'views/pedidosViews/pedidoDetalle.php';
    }

    public function gestionPedidos() {
        utilidades::isAdmin();
        $gestion = true;
        $pedido = new PedidoModelo();
        $pedidos = $pedido->getAll();


        require_once 'views/pedidosViews/mispedidos.php';
    }

    public function estado() {
        utilidades::isAdmin();
        if (isset($_POST["pedido_id"]) && isset($_POST["estado"])) {
            $id = $_POST["pedido_id"];

            $estado = $_POST["estado"];


            $pedido = new PedidoModelo();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->cambiarEstadoPedido();
            header("Location:" . base_url . "pedidos/gestionPedidos");
              echo"<script language='javascript'>window.location='".base_url . "pedidos/gestionPedidos"."'</script>;";
        } else {
            echo"<script language='javascript'>window.location='".base_url."'</script>;";
        }
    }

}
