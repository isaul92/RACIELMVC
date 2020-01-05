<?php

class obrasArquitectoModel {

    private $id;
    private $nombre;
    private $descripcion;
    private $id_usuario;
    private $fecha;
    private $imagenPrincipal;
    private $db;
    private $idImagenP;
  

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

    function getIdImagenP() {
        return $this->idImagenP;
    }

    function setIdImagenP($idImagenP) {
        $this->idImagenP = $idImagenP;
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

    public function guardarImagenSecundaria() {
        $query = "INSERT INTO imagenesgrupo VALUES(NULL,'{$this->getImagenPrincipal()}',{$this->getId()})";
        $producto = $this->db->query($query);
        return $query;
    }

    public function getRandoms($limit) {

        $obra = $this->db->query("SELECT * FROM obrasarquite WHERE status='AC' ORDER BY RAND() LIMIT $limit");
        return $obra;
    }

    public function obtenerObras() {
        $query = "SELECT * FROM obrasarquite WHERE status='AC'";
        $result = $this->db->query($query);
        return $result;
    }

    public function editarImagenSecundaria() {
        $query = "UPDATE  imagenesgrupo set nombreImagen='{$this->getImagenPrincipal()}'  where id={$this->getIdImagenP()}";
        $result = $this->db->query($query);
        return $result;
    }

    public function getAllByid() {
        $query = "SELECT * FROM obrasarquite where id={$this->getId()} and status='AC'";
        $producto = $this->db->query($query);
        return $producto;
    }

     public function  getByDate() {
        $query = "SELECT * FROM obrasarquite where fecha like '%{$this->getFecha()}% and status='AC''";
        $producto = $this->db->query($query);
        return $producto;
    }
    
    
    public function getAllByDescrip() {
        $query = "SELECT * FROM obrasarquite where nombre like '%{$this->getDescripcion()}%' and status='AC's";
        $producto = $this->db->query($query);
        return $producto;
    }

    public function obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina) {
        $obras = $this->db->query("SELECT * FROM obrasarquite WHERE status='AC' LIMIT $empiezaAqui,$numeroDeElementosPagina");
        return $obras;
    }

    public function getOne() {
        $obra = $this->db->query("select * from obrasarquite where id={$this->getId()} and status='AC'");

        return $obra->fetch_object();
    }

    public function getGroupImages() {
        $query = "SELECT * FROM imagenesgrupo where id_obra={$this->getId()}";
        $result = $this->db->query($query);
        return $result;
    }
    
    public function delete(){
        $sql="UPDATE obrasarquite SET status='DC' where id={$this->getId()}";
        $result= $this->db->query($sql);
        return $result;
    }
    
    

    public function editar() {
        $sql = "UPDATE  obrasarquite SET nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}', imagen='{$this->getImagenPrincipal()}' where id={$this->getId()}";
        $save = false;
        $save = $this->db->query($sql);

        if ($save) {
            $save = true;
        }
        return $sql;
    }

    public function save(){
         $date = date('Y-m-d H:i:s');
        $query="INSERT INTO obrasarquite VALUES(NULL,'{$this->getNombre()}','{$this->getDescripcion()}','{$this->getId_usuario()}','{$date}','{$this->getImagenPrincipal()}','AC')";
        $result= $this->db->query($query);
    }
    
    
}
