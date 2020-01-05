
<?php

class categoriasModelo {

    private $db;
    private $id;
    private $nombre;

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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getOne($id) {
        $sql = "select * from categorias where id=$id ";
        $categoria = $this->db->query($sql);
        return $categoria->fetch_object();
    }

    public function getAll() {
        $sql = "select p.*,c.*, count(p.categoria_id) AS 'numeroP' from  categorias c left join  productos p  on p.categoria_id=c.id and p.status='AC'  group by c.id";
        $categorias = $this->db->query($sql);
        return $categorias;
    }

    public function update() {
        $sql = "UPDATE categorias set nombre='" . $this->getNombre() . "' where id=" . $this->getId();
        $categorias = $this->db->query($sql);
        return $categorias;
    }
//select p.*,c.*, count(p.categoria_id) AS 'numeroP' from  categorias c left join  productos p  on p.categoria_id=c.id and p.status='AC'  group by c.id
    public function save() {
        $sql = "insert into categorias values(null,'" . $this->getNombre() . "')";
        $categorias = $this->db->query($sql);
        return $sql;
    }

}

?>