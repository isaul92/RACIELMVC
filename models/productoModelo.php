<?php

class productoModelo {

    private $id;
    private $dimensiones;
    private $status;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;
    private $pagination;
    private $precionConDescuento;
    private $idImagenP;
    function getPrecionConDescuento() {
        return $this->precionConDescuento;
    }

    function setPrecionConDescuento($precionConDescuento) {
         $this->precionConDescuento = $this->db->real_escape_string($precionConDescuento);
    }

        function getDimensiones() {
        return $this->dimensiones;
    }

    function getStatus() {
        return $this->status;
    }

    function setDimensiones($dimensiones) {

        $this->dimensiones = $this->db->real_escape_string($dimensiones);
    }

    function setStatus($status) {

        $this->status = $this->db->real_escape_string($status);
    }

    function getIdImagenP() {
        return $this->idImagenP;
    }

    function setIdImagenP($idImagenP) {
        $this->idImagenP = $this->db->real_escape_string($idImagenP);
    }

    function __construct() {
        $this->db = Connect::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function getPagination() {
        return $this->pagination;
    }

    function setPagination($pagination) {
        $this->pagination = $pagination;
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $this->db->real_escape_string($fecha);
    }

    function setImagen($imagen) {
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function getAllCategory() {
        $query = "SELECT p.*,c.nombre AS 'nombreCategoria' FROM productos p "
                . "inner join categorias c on c.id=p.categoria_id"
                . "  where p.categoria_id={$this->getCategoria_id()} and p.status='AC'" ;
 
        $productos = $this->db->query($query);


        return $productos;
    }

    public function obtenerPaginacion($empiezaAqui, $numeroDeElementosPagina) {
        $productos = $this->db->query("SELECT * FROM productos where categoria_id={$this->getCategoria_id()} and status='AC' LIMIT $empiezaAqui,$numeroDeElementosPagina");
        return $productos;
    }

    public function obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina) {
        $productos = $this->db->query("SELECT * FROM productos LIMIT $empiezaAqui,$numeroDeElementosPagina");
        return $productos;
    }

    public function getAll() {
        $query = " SELECT p.*,c.nombre as 'nombreCategoria' FROM productos p inner join categorias c on p.categoria_id=c.id" ;
        $productos = $this->db->query($query);
        return $productos;
    }

    public function save() {
        $sql = "INSERT INTO productos VALUES(null,'{$this->getCategoria_id()}','{$this->getNombre()}','{$this->getDescripcion()}','{$this->getPrecio()}'"
             .",{$this->getPrecionConDescuento()}"   . ",'{$this->getStock()}',0,CURDATE(),'{$this->getImagen()}','{$this->getDimensiones()}','AC')";

        $save = false;
        $save = $this->db->query($sql);

        if ($save) {
            $save = true;
        }
        return $sql;
    }

    public function delete() {
        $sql = "UPDATE  productos SET status='DC' where id={$this->getId()}";
        $delete = $this->db->query($sql);

        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function getOne() {
        $producto = $this->db->query("select * from productos where id={$this->getId()} and status='AC'");

        return $producto->fetch_object();
    }

    public function getAllByName() {
         $query = "SELECT p.*,c.nombre AS 'nombreCategoria' FROM productos p "
                . "inner join categorias c on c.id=p.categoria_id where p.nombre like  '%{$this->getNombre()}%' and p.status='AC'";
        $producto = $this->db->query($query);
        return $producto;
    }

    public function getAllByDescrip() {
        $query = "SELECT p.*,c.nombre AS 'nombreCategoria' FROM productos p "
                . "inner join categorias c on c.id=p.categoria_id where p.descripcion like  '%{$this->getDescripcion()}%' and p.status='AC'";
        $producto = $this->db->query($query);
        return $producto;
    }

    public function getAllByid() {
          $query = "SELECT p.*,c.nombre AS 'nombreCategoria' FROM productos p "
                . "inner join categorias c on c.id=p.categoria_id where p.id like  '%{$this->getId()}%' and p.status='AC'";
        $producto = $this->db->query($query);
        return $producto;
    }

    public function editar() {
        $sql = "UPDATE  productos SET  categoria_id='{$this->getCategoria_id()}', nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',precio='{$this->getPrecio()}'"
                . ",stock='{$this->getStock()}',imagen='{$this->getImagen()}' where id={$this->getId()}" ;


        $save = false;
        $save = $this->db->query($sql);

        if ($save) {
            $save = true;
        }
        return $sql;
    }

    public function getGroupImages() {
        $query = "SELECT * FROM imagenesgrupoproductos where id_pro={$this->getId()}";
        $result = $this->db->query($query);
        return $result;
    }

    public function editarImagenSecundaria() {
        $query = "UPDATE  imagenesgrupoproductos set nombreImagen='{$this->getImagen()}'  where id={$this->getIdImagenP()}";
        $result = $this->db->query($query);
        return $result;
    }

    public function guardarImagenSecundaria() {
        $query = "INSERT INTO imagenesgrupoproductos VALUES(NULL,'{$this->getImagen()}',{$this->getId()})";
        $producto = $this->db->query($query);
        return $query;
    }

    public function getRandom($limit) {

        $producto = $this->db->query("select * from productos ORDER BY RAND() LIMIT $limit");
        return $producto;
    }

    public function deleteImageGroup() {
        $query = "DELETE FROM imagenesgrupoproductos where id={$this->getIdImagenP()} ";
        $result = $this->db->query($query);
        return;
        $result;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

