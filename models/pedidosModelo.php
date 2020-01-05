

<?php

class PedidoModelo {

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    function __construct() {
        $this->db = Connect::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad) {

        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste) {
        $this->coste = $this->db->real_escape_string($coste);
    }

    public function save() {
        $sql = "INSERT INTO pedidos VALUES(null,{$this->getUsuario_id()},{$this->getDireccion()}"
                . ",{$this->getCoste()},'confirm',CURDATE(),CURTIME())";

        $save = false;
        $save = $this->db->query($sql);

        return $save;
    }

    public function saveLinea() {
        $sql = "SELECT MAX(id) as 'pedido' from pedidos";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        $save = false;
        foreach ($_SESSION["carrito"] as $indice => $elemento) {
            $producto = $elemento["producto"];
            $insert = "INSERT INTO lineas_pedido VALUES (NULL,{$pedido_id},{$producto->id},{$elemento["unidades"]})";
            //   echo $insert;
            // die();
            $save = $this->db->query($insert);
        }


        return $save;
    }

    public function getOneByUser() {
        $sql = "select p.id,p.coste from pedidos p INNER JOIN lineas_pedido lp ON lp.pedido_id=p.id where p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";

        $pedido = $this->db->query($sql);


        return $pedido->fetch_object();
    }

    public function getAllByUser() {
        $sql = "select p.* from pedidos p "
                . "where p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC";

        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getOne() {
        $sql = "select p.*,p.estado as 'estadoPedido',p.id as 'idPedido' ,d.*,u.* from pedidos p INNER JOIN direccionesuser d on d.id=p.direccion inner join usuarios u on u.id=p.usuario_id  where p.id={$this->getId()} ORDER BY p.id DESC";

        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAll() {
        $sql = "select * from pedidos  ORDER BY id DESC";

        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductosByPedido($id) {
        $sql = "SELECT * FROM productos WHERE id IN"
                . " (SELECT producto_id FROM lineas_pedido WHERE pedido_id={$id})";

        $sql = "SELECT pr.*,lp.unidades from productos pr INNER JOIN lineas_pedido lp ON pr.id=lp.producto_id WHERE pedido_id={$id}";
        $productos = $this->db->query($sql);
        return $productos;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function cambiarEstadoPedido() {
        $sql = "UPDATE  pedidos SET  estado='{$this->getEstado()}' where id={$this->getId()}";


        $save = false;
        $save = $this->db->query($sql);

        if ($save) {
            $save = true;
        }
        return $save;
    }

}
