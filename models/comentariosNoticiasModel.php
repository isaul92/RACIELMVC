<?php

class comentariosNoticiasModel {

    private $id;
    private $id_user;
    private $id_noticia;
    private $content;
    private $created_at;
    private $updated_at;
    private $db;

    function getId() {

        return $this->id;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getId_noticia() {
        return $this->id_noticia;
    }

    function getContent() {
        return $this->content;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getUpdated_at() {
        return $this->updated_at;
    }

    function setId($id) {
        $this->id = $this->db->real_escape_string($id);
    }

    function setId_user($id_user) {
        $this->id_user = $this->db->real_escape_string($id_user);
    }

    function setId_noticia($id_noticia) {
        $this->id_noticia = $this->db->real_escape_string($id_noticia);
    }

    function setContent($content) {
        $this->content = $this->db->real_escape_string($content);
    }

    function setCreated_at($created_at) {
        $this->created_at = $this->db->real_escape_string($created_at);
    }

    function setUpdated_at($updated_at) {
        $this->updated_at = $this->db->real_escape_string($updated_at);
    }

    function __construct() {
        $this->db = Connect::conectar();
    }

    function obtenerNumeroDeComentatios($id) {
        $query = "select count(id) as 'numero' from comments where id_noticia=" . $id . " order by created_at asc";
        $comentariosNoticias = $this->db->query($query);
        return $comentariosNoticias;
    }

    function obtenerComentatiosNoticia($id) {
        $query = "select c.*,u.nombre from comments c inner join usuarios u on c.id_user=u.id where id_noticia=" . $id;
        $comentariosNoticias = $this->db->query($query);
        return $comentariosNoticias;
    }

    function eliminarComentario() {
        $query = "delete from comments where id=" . $this->id;
        $comentariosNoticias = $this->db->query($query);
        return $this->db->affected_rows;
    }

    function guardarComentario() {
        $date = date('Y-m-d H:i:s');
        $query = "insert into comments VALUES(null," . $this->getId_user() . "," . $this->getId_noticia() . ",'" . $this->getContent() . "','" . $date . "','" . $date . "' )";
        $comentariosNoticias = $this->db->query($query);
        $estado = $this->db->affected_rows;
        $query = " SELECT MAX(id) as 'id' from comments";
        $comentariosNoticias = $this->db->query($query);

        while ($comment = $comentariosNoticias->fetch_object()) {
            $idComment = $comment->id;
        }


        $datos = array(
            'idComentario' => $idComment,
            "estado" => $estado
        );
        return $datos;
    }

}
