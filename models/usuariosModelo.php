<?php

class usuarioModelo {

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $db;
    private $telefono;
    private $telefonoAlternativo;

    function __construct() {
        $this->db = Connect::conectar();
    }

    function getTelefono() {

        return $this->telefono ;
    }

    function getTelefonoAlternativo() {

        return $this->telefonoAlternativo;
    }

    function setTelefono($telefono) {
   $this->telefono = $this->db->real_escape_string($telefono);
    }

    function setTelefonoAlternativo($telefonoAlternativo) {
      $this->telefonoAlternativo = $this->db->real_escape_string($telefonoAlternativo);
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ["cost" => 4]);
    }

    function getImage() {
        return $this->image;
    }

    function getDb() {
        return $this->db;
    }

    function setImage($image) {
        $this->image = $this->db->real_escape_string($image);
    }

    public function save() {
        $sql = "INSERT INTO usuarios VALUES(null,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user','{$this->getImage()}','AC')";
        $save = false;
        $save = $this->db->query($sql);

        if ($save) {
            $save = true;
        }
        return $save;
    }

    public function update($password) {



        $sql = "UPDATE  usuarios SET apellidos='{$this->getApellidos()}',nombre='{$this->getNombre()}',password='$password' ,telefono='" . $this->getTelefono() . "', telefonoAlter='" . $this->getTelefonoAlternativo() . "' where id='".$this->getId()."'";               

        $save = false;
        $save = $this->db->query($sql);
        if ($save) {
            $save = true;
        }
        return $sql;
    }
    
    public function getAll(){
        $sql="SELECT * FROM usuarios ";
        $result= $this->db->query($sql);
        return $result;
    }

    public function login() {
        //COMPROBAR SI EXISTE EL USUARIO
        $result = false;
        $email = $this->email;
        $password = $this->password;

        $sql = "SELECT * FROM usuarios WHERE email= '$email'";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            }
        }


        return $result;
    }

}
