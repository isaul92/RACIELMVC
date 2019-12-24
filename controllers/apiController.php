<?php

require_once './controllers/direccionesUserController.php';
require_once './controllers/comentariosNoticiasController.php';
require_once './config/dataBase.php';

class apiController {

    private $db;

    function __construct() {
        $this->db = Connect::conectar();
    }

    public function index() {
        header("http/1.1 200 ok");
        echo '{"id":1}';
    }

    /*     * **************************COMENTARIOS********************************************** */

    public function guardarComentario() {
        if (!empty(file_get_contents("php://input"))) {
            $datosRecibidos = file_get_contents("php://input");
# No los hemos decodificado, así que lo hacemos de una vez:
            $comentarioContent = json_decode($datosRecibidos);
            $comentarios = new comentariosNoticiasController();
            $comentario = $comentarioContent->comentario;
            $id_user = $comentarioContent->id_user;
            $id_noticia = $comentarioContent->id_noticia;
            $comentarios = $comentarios->guardarComentario($comentario, $id_user, $id_noticia);
            if ($comentarios["estado"] == 1) {
                header("http/1.1 200 ok");
//Devolvemos el array pasado a JSON como objeto
                echo json_encode($comentarios, JSON_FORCE_OBJECT);
            } else {
                header("http/1.1 500 error");
                echo '{"estado":"no se ha podido guardar"}';
            }
        } else {
            header("http/1.1 500 error");
            echo "error";
        }
    }

    public function eliminarComentario() {
        if (!empty(file_get_contents("php://input"))) {
            $datosRecibidos = file_get_contents("php://input");
# No los hemos decodificado, así que lo hacemos de una vez:
            $comentarioId = json_decode($datosRecibidos);
            $id = $comentarioId->idComentario;
            $comentarios = new comentariosNoticiasController();
            $comentarios = $comentarios->deleteComment($id);
            echo $comentarios;
            header("http/1.1 200 ok");
        } else {
            header("http/1.1 500 error");
            echo "error";
        }
    }

    /*     * ************************************DIRECCIONES********************************************************************** */

    public function guardarDireccion() {
        if (!empty(file_get_contents("php://input"))) {
            $datosRecibidos = file_get_contents("php://input");
# No los hemos decodificado, así que lo hacemos de una vez: el JSON
            $direccionContent = json_decode($datosRecibidos);
            $idUser = $direccionContent->idUser;
            $cdPostal = $direccionContent->cdPostal;
            $valorEstado = $direccionContent->valorEstado;
            $colonia = $direccionContent->colonia;
            $calle = $direccionContent->calle;
            $noExterior = $direccionContent->noExterior;
            $noInterior = $direccionContent->noInterior;
            $entreCalles = $direccionContent->entreCalles;
            $referencias = $direccionContent->referencias;
            $teleContacto = $direccionContent->teleContacto;
            $valorMunicipio = $direccionContent->valorMunicipio;
            $idEstado = $direccionContent->IdEstado;
            $idMunicipio = $direccionContent->IdMunicipio;
            $id = $direccionContent->id;
            if ($idMunicipio != "" || $idEstado != "" || $valorMunicipio != "" || $idUser != "" || $cdPostal != "" || $valorEstado != "" || $colonia != "" || $calle != "" || $noExterior != "" || $noInterior != "" || $entreCalles != "" || $referencias != "" || $teleContacto != ""
            ) {
                $nuevaDireccion = new direccionesUserController();
                $idnuevaDireccion = $nuevaDireccion->saveAdress($id, $cdPostal, $valorEstado, $valorMunicipio, $colonia, $calle, $noExterior, $noInterior, $entreCalles, $referencias, $teleContacto, $idUser, $idMunicipio, $idEstado);
                if ($idnuevaDireccion["estado"] == 1) {
                    header("http/1.1 200 ok");
//Devolvemos el array pasado a JSON como objeto
                    echo json_encode($idnuevaDireccion, JSON_FORCE_OBJECT);
                } else {
                    header("http/1.1 500 error");
                    echo $idnuevaDireccion["estado"];
                }
            } else {
                header("http/1.1 500 error");
                echo "error";
            }
        }
    }

    public function eliminarDireccion() {
        if (!empty(file_get_contents("php://input"))) {
            $datosRecibidos = file_get_contents("php://input");
# No los hemos decodificado, así que lo hacemos de una vez:
            $comentarioId = json_decode($datosRecibidos);
            $id = $comentarioId->idComentario;
            $direcciones = new direccionesUserController();
            $direcciones = $direcciones->eliminarDireccion($id);
            header("http/1.1 200 ok");
            echo $direcciones;
        } else {
            header("http/1.1 500 error");
            echo json_encode($idnuevaDireccion, JSON_FORCE_OBJECT);
        }
    }

    /*     * ********************************************************** */




    /*     * *********PEDIDOS*************** */

    public function addPedidoLinea() {
        if (!empty(file_get_contents("php://input"))) {
            $datosRecibidos = file_get_contents("php://input");
# No los hemos decodificado, así que lo hacemos de una vez:
            $pedidoLinea = json_decode($datosRecibidos);

            $id = $pedidoLinea->id;
            $coste = $pedidoLinea->coste;
            $idUser = $pedidoLinea->idUser;
            $pedido = new pedidosController();
            $pedido = $pedido->add($coste, $idUser, $id);
            echo $pedido;
            if ($pedido == "complete") {
                header("http/1.1 200 ok");
            } else {
                header("http/1.1 500 error");
            }
        }
    }

    /*     * *******************PEDIDOS FIN**************************** */




    /*     * *******************PRODUCTOS**************************** */

    public function buscarProduct() {
        if (!empty(file_get_contents("php://input"))) {
            $datosRecibidos = file_get_contents("php://input");
# No los hemos decodificado, así que lo hacemos de una vez:
            $productosBuscar = json_decode($datosRecibidos);

            $funcion = $productosBuscar->accion;
            $producto = new productoController();



            switch ($funcion) {
                case "idBuscarProducto";

                    $id = $producto->getById($productosBuscar->inputProducto);
                    if (!$id) {
                        header("http/1.1 500 error");
                        echo json_encode('{"resultado":"No hay coincidencia"}', JSON_FORCE_OBJECT);
                    } else if ($id) {
                        header("http/1.1 200 ok");
                        echo $id;
                    }
                    break;

                case "nombreBuscarProducto";

                    $id = $producto->getByNombre($productosBuscar->inputProducto);
                    if (!$id) {
                        header("http/1.1 500 error");
                        echo json_encode('{"resultado":"No hay coincidencia"}', JSON_FORCE_OBJECT);
                    } else if ($id) {
                        header("http/1.1 200 ok");
                        echo $id;
                    }

                    break;


                case "descripcionBuscarProducto";

                    $id = $producto->getByDescripcion($productosBuscar->inputProducto);
                    if (!$id) {
                        header("http/1.1 500 error");
                        echo json_encode('{"resultado":"No hay coincidencia"}', JSON_FORCE_OBJECT);
                    } else if ($id) {
                        header("http/1.1 200 ok");
                        echo $id;
                    }



                    break;
            }
        }
    }

    /*     * *******************PRODUCTOS FIN**************************** */
}

//header('Content-type: application/json; charset=utf-8');
?>