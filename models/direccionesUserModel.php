<?php

class direccionesUserModel {

    private $db;
    private $id;
    private $id_user;
    private $codigoPostal;
    private $estado;
    private $municipio;
    private $colonia;
    private $noExterior;
    private $noInterior;
    private $entreCalles;
    private $referencias;
    private $teleContacto;
    private $calle;
    private $idEstado;
    private $idMunicipio;

    function __construct() {
        $this->db = Connect::conectar();
    }

    function getCalle() {
        return $this->calle;
    }

    function setCalle($calle) {
        $this->calle = $calle;
    }

    function getIdEstado() {
        return $this->idEstado;
    }

    function getIdMunicipio() {
        return $this->idMunicipio;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setIdMunicipio($idMunicipio) {
        $this->idMunicipio = $idMunicipio;
    }

    function getId() {
        return $this->id;
    }

    function getIduser() {
        return $this->id_user;
    }

    function getCodigoPostal() {
        return $this->codigoPostal;
    }

    function getEstado() {
        return $this->estado;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getColonia() {
        return $this->colonia;
    }

    function getNoExterior() {
        return $this->noExterior;
    }

    function getNoInterior() {
        return $this->noInterior;
    }

    function getEntreCalles() {
        return $this->entreCalles;
    }

    function getReferencias() {
        return $this->referencias;
    }

    function getTeleContacto() {
        return $this->teleContacto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIduser($id_user) {
        $this->id_user = $id_user;
    }

    function setCodigoPostal($codigoPostal) {
        $this->codigoPostal = $codigoPostal;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    function setColonia($colonia) {
        $this->colonia = $colonia;
    }

    function setNoExterior($noExterior) {
        $this->noExterior = $noExterior;
    }

    function setNoInterior($noInterior) {
        $this->noInterior = $noInterior;
    }

    function setEntreCalles($entreCalles) {
        $this->entreCalles = $entreCalles;
    }

    function setReferencias($referencias) {
        $this->referencias = $referencias;
    }

    function setTeleContacto($teleContacto) {
        $this->teleContacto = $teleContacto;
    }

    public function getAll() {
        $query = "SELECT * FROM direccionesuser where id_user=" . $this->getIduser();
        $direcciones = $this->db->query($query);
        return $direcciones;
    }

    public function updateAddress() {
        $query = "UPDATE  direccionesuser set codigoPostal='" . $this->getCodigoPostal()
                . "', estado= '" . $this->getEstado() . "', municipio='" . $this->getMunicipio() . "',colonia='" . $this->getColonia() . "',calle='" . $this->getCalle() .
                "',noExterior='" . $this->getNoExterior() . "',noInterior='" . $this->getNoInterior() . "',entreCalles='" . $this->getEntreCalles() . "',referencias='" . $this->getReferencias() . "',teleContacto='" . $this->getTeleContacto() . "',idEstado='" 
                . $this->getIdEstado() . "',idMunicipio='" . $this->getIdMunicipio() . "' where id=".$this->getId(). "";
        $direcciones = $this->db->query($query);
        $estado = $this->db->affected_rows;
       


        $datos = array(
            'idNuevaDireccion' => $this->getId(),
            "estado" => $estado
        );
        return $datos;
    }

    public function guardarDireccion() {
        $query = "INSERT INTO direccionesuser values(null," . $this->getIduser() . ",'" . $this->getCodigoPostal()
                . "','" . $this->getEstado() . "','" . $this->getMunicipio() . "','" . $this->getColonia() . "','" . $this->getCalle() .
                "','" . $this->getNoExterior() . "','" . $this->getNoInterior() . "','" . $this->getEntreCalles() . "','" . $this->getReferencias() . "','" . $this->getTeleContacto() . "','" . "','" . $this->getIdEstado() . "','" . $this->getIdMunicipio() . "')";
        $direcciones = $this->db->query($query);
        $estado = $this->db->affected_rows;
        $query = " SELECT MAX(id) as 'id' from direccionesuser";
        $direcciones = $this->db->query($query);

        while ($direccion = $direcciones->fetch_object()) {
            $idNuevaDireccion = $direccion->id;
        }


        $datos = array(
            'idNuevaDireccion' => $idNuevaDireccion,
            "estado" => $estado
        );
        return $datos;
    }

    public function eliminarDireccion() {
        $query = "DELETE  FROM direccionesuser where id=" . $this->getId();
        $direcciones = $this->db->query($query);
        return $this->db->affected_rows;
    }

}
