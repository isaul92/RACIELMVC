<?php


class obrasArquitectoModel {
 
    private $id;
    private $nombre;
    private $descripcion;
    private $id_usuario;
    private $fecha;
    private $imagenPrincipal;
    private $db;
    
    function __construct() {
   $this->db = Connect::conectar();
    }

    function getDb() {
        return $this->db;
    }

    function setDb($db) {
        $this->db = $db;
    }

        function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagenPrincipal() {
        return $this->imagenPrincipal;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagenPrincipal($imagenPrincipal) {
        $this->imagenPrincipal = $imagenPrincipal;
    }

        
   public function getRandoms($limit) {

        $obra = $this->db->query("select * from obrasarquite ORDER BY RAND() LIMIT $limit");
        return $obra;
    }
    
    
     public function getOne() {
        $obra = $this->db->query("select * from obrasarquite where id={$this->getId()}");

        return $obra->fetch_object();
    }
    
    
    
}

