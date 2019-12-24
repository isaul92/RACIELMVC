
<?php

class noticiasModelo {

    private $db;
    private $id;
    private $nombre;
    private $id_autor;
    private $fecha;
    private $texto;
    private $id_imagenes;
    private $nombreImagen;

    function __construct() {
        $this->db = Connect::conectar();
    }

    function getNombreImagen() {
        return $this->nombreImagen;
    }

    function setNombreImagen($nombreImagen) {
        $this->nombreImagen = $nombreImagen;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getId_autor() {
        return $this->id_autor;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getTexto() {
        return $this->texto;
    }

    function getId_imagenes() {
        return $this->id_imagenes;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setId_autor($id_autor) {
        $this->id_autor = $id_autor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setId_imagenes($id_imagenes) {
        $this->id_imagenes = $id_imagenes;
    }

    public function obtenerNoticias() {
        $query = "select n.*,i.nombreImagen,u.nombre as 'nombreUser' FROM noticias n inner join imagenesgrupo i on i.id=n.id ";
        $noticias = $this->db->query($query);
        return $noticias;
    }
    
      public function getNoticia($id) {
        $query = "select n.*,i.nombreImagen FROM noticias n inner join imagenesgrupo i on i.id=n.id where n.id=$id";
        $noticia = $this->db->query($query);
        return $noticia->fetch_object();
    }
    
       public function obtenerPaginacionTodos($empiezaAqui,$numeroDeElementosPagina){
        $productos = $this->db->query("select n.*,i.nombreImagen FROM noticias n inner join imagenesgrupo i on i.id=n.id order by n.created_at desc LIMIT $empiezaAqui,$numeroDeElementosPagina");
        return $productos;
    }

}
