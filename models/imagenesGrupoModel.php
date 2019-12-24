
<?php 
class imagenesGrupoModel{
    
    private $id;
    private $nombreImagen;
    private $id_obra;
    private $id_pro;
    private $db;
    function __construct() {
        $this->db= Connect::conectar();
    }

    
    function getId() {
        return $this->id;
    }

    function getNombreImagen() {
        return $this->nombreImagen;
    }

    function getId_obra() {
        return $this->id_obra;
    }

    function getId_pro() {
        return $this->id_pro;
    }

    function getDb() {
        return $this->db;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombreImagen($nombreImagen) {
        $this->nombreImagen = $nombreImagen;
    }

    function setId_obra($id_obra) {
        $this->id_obra = $id_obra;
    }

    function setId_pro($id_pro) {
        $this->id_pro = $id_pro;
    }

    function setDb($db) {
        $this->db = $db;
    }


   public function getAllProducs($id){
       
       
   }
   
    public function getAllObras($id){
       
       
   }
   
   
   
   
   
   
    
    
    
    
    
    
    
}




?>