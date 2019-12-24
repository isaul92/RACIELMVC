<?php

require_once 'models/direccionesUserModel.php';

class direccionesUserController {

    public function getMyAdresses($id) {
        $misDirecciones = new direccionesUserModel();
        $misDirecciones->setIduser($id);

        $misDirecciones = $misDirecciones->getAll();
        return $misDirecciones;
    }

    public function saveAdress($id, $cdPostal, $valorEstado, $valorMunicipio, $colonia, $calle, $noExterior, $noInterior, $entreCalles, $referencias, $teleContacto, $idUser, $idMunicipio, $idEstado) {
        $direccion = new direccionesUserModel();



        $direccion->setIduser($idUser);
        $direccion->setCodigoPostal($cdPostal);
        $direccion->setEstado($valorEstado);
        $direccion->setMunicipio($valorMunicipio);
        $direccion->setColonia($colonia);
        $direccion->setCalle($calle);
        $direccion->setNoExterior($noExterior);
        $direccion->setNoInterior($noInterior);
        $direccion->setEntreCalles($entreCalles);
        $direccion->setReferencias($referencias);
        $direccion->setTeleContacto($teleContacto);
        $direccion->setIdEstado($idEstado);
        $direccion->setIdMunicipio($idMunicipio);
        if ($id != "") {
            $direccion->setId($id);
            $direccion = $direccion->updateAddress();
            return $direccion;
        } else {
            $direccion = $direccion->guardarDireccion();
            return $direccion;
        }
    }

    public function eliminarDireccion($id) {
        $direcciones = new direccionesUserModel();
        $direcciones->setId($id);
        $direcciones = $direcciones->eliminarDireccion();

        return $direcciones;
        //Se ejecuta lo que quiero en la funcion 2                 
    }

}
