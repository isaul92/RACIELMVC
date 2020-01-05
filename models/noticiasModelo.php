
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
       
        $this->nombreImagen = $this->db->real_escape_string($nombreImagen);
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
        
        $this->id  = $this->db->real_escape_string($id);
    }

    function setNombre($nombre) {
        
        $this->nombre  = $this->db->real_escape_string($nombre);
    }

    function setId_autor($id_autor) {
        $this->id_autor  = $this->db->real_escape_string($id_autor);
        
    }

    function setFecha($fecha) {
        $this->fecha  = $this->db->real_escape_string($fecha);
        
    }

    function setTexto($texto) {
        
        $this->texto  = $this->db->real_escape_string($texto);
    }

    function setId_imagenes($id_imagenes) {
        
    $this->id_imagenes  = $this->db->real_escape_string($id_imagenes);
        
    }

    public function obtenerNoticias() {
        $query = "select n.*,i.nombreImagen FROM noticias n inner join imagenesgruponoticias i on i.id_noticia=n.id where n.status='AC'";
        $noticias = $this->db->query($query);
        return $noticias;
    }

    public function getNoticia($id) {
        $query = "select n.*,i.nombreImagen FROM noticias n inner join imagenesgruponoticias i on i.id_noticia=n.id where n.id=$id and n.status='AC'";
        $noticia = $this->db->query($query);
        return $noticia->fetch_object();
    }

    public function obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina) {
        $noticias = $this->db->query("select u.nombre as 'autor', n.*,i.nombreImagen FROM noticias n inner join imagenesgruponoticias i on i.id_noticia=n.id INNER JOIN usuarios u on n.id_autor=u.id  where n.status='AC' order by n.created_at desc LIMIT $empiezaAqui,$numeroDeElementosPagina");
        return $noticias;
    }

    public function getById() {
        $noticias = $this->db->query("select u.nombre as 'autor', n.*,i.nombreImagen FROM noticias n inner join imagenesgruponoticias i on i.id_noticia=n.id INNER JOIN usuarios u on n.id_autor=u.id where n.id like '%{$this->getId()}%' and n.status='AC' order by n.created_at desc  ");
        return $noticias;
    }

    public function getByDate() {
$query="select u.nombre as 'autor', n.*,i.nombreImagen FROM noticias n inner join imagenesgruponoticias i on i.id_noticia=n.id INNER JOIN usuarios u on n.id_autor=u.id where n.created_at like '%{$this->getFecha()}%'   and n.status='AC' order by n.created_at desc  ";        
        $noticias = $this->db->query($query);
        return $noticias; 
    }

    public function getByName() {
        $noticias = $this->db->query("select u.nombre as 'autor', n.*,i.nombreImagen FROM noticias n inner join imagenesgruponoticias i on i.id_noticia=n.id INNER JOIN usuarios u on n.id_autor=u.id where n.nombre like '%{$this->getNombre()}%' and n.status='AC' order by n.created_at desc  ");
        return $noticias;
    }
    
    
    
    public function getOne() {
        $noticia = $this->db->query("select n.*,i.* from noticias n  INNER JOIN imagenesgruponoticias i on n.id=i.id_noticia where n.id={$this->getId()} and n.status='AC'" );

        return $noticia->fetch_object();
    }

    public function editNew(){
        $query="UPDATE noticias  SET nombre='{$this->getNombre()}',texto='{$this->getTexto()}' WHERE id={$this->getId()} ";
        $result= $this->db->query($query);
        return $query;
    }


    public function delete(){
        $query="UPDATE noticias SET status='DC' where id={$this->getId()}";
        $result= $this->db->query($query);
        return $result;
    }
    
    
    public function save(){
           $date = date('Y-m-d H:i:s');
           
        $query="INSERT INTO noticias VALUES(NULL,'{$this->getNombre()}','{$this->getId_autor()}','{$date}','{$this->getTexto()}','AC')";
        $noticia= $this->db->query($query);
                $sql = "SELECT MAX(id) as 'idNoticia' from noticias";
        $query = $this->db->query($sql);
       $noticia_id = $query->fetch_object()->idNoticia;
        return $noticia_id;
        
        
    }

}
