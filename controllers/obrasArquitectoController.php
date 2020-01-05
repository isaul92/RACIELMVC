<?php

require_once 'models/obrasArquitectoModel.php';

class obrasArquitectoController {

    public function crear() {
        utilidades::isAdmin();

        require_once './views/ObrasViews/crearView.php';
    }

    public function editar() {
        utilidades::isAdmin();
        $editar = true;
        if (isset($_GET["id"])) {
            $obra = new obrasArquitectoModel();
            $obra->setId($_GET["id"]);
            $pro = $obra->getOne();
            $grupoImages = $obra->getGroupImages();
            $grupoImages2 = $grupoImages;



            require_once './views/ObrasViews/crearView.php';
        } else {
            header("Location:" . base_url . "obrasArquitecto/gestion");
              echo"<script language='javascript'>window.location='".base_url . "obrasArquitecto/editar&id={$_GET["id"]}"."'</script>;";
        }
    }
    public function index(){
        echo "jeje";
    }
    
    public function eliminar(){
    utilidades::isAdmin();
        if (isset($_GET["id"])) {
            
            $obra = new obrasArquitectoModel();
            $obra->setId($_GET["id"]);
            $delete = $obra->delete();
    
            if ($delete) {
                $_SESSION["delete"] = "complete";
            } else {
                $_SESSION["delete"] = "failed";
            }
        } else {
            $_SESSION["delete"] = "failed";
        }
        header("Location:" . base_url . "obrasArquitecto/gestion");
         echo"<script language='javascript'>window.location='".base_url . "obrasArquitecto/gestion"."'</script>;";
    }

    public function editarObra() {
        utilidades::isAdmin();

        if (isset($_POST)) {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $id = isset($_POST["id_obra"]) ? $_POST["id_obra"] : false;
            if ($nombre && $descripcion && $id) {
                $obra = new obrasArquitectoModel();
                $obra->setId($id);
                $obra->setDescripcion($descripcion);
                $obra->setNombre($nombre);

                /*                 * *IMAGENES SECUNDARIAS*** */
                if ($_FILES['imagen2']['name'] != null) {
                    $archivo = $_FILES["imagen2"];
                    $filename = $archivo["name"];
                    $mimetype = $archivo["type"];
                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir("uploads/images")) {
                            mkdir("uploads/images", 0777, true);
                        }
                        move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);


                        $obra->setImagenPrincipal($filename);

                        if (!isset($_POST["images2"])) {
                            $result = $obra->guardarImagenSecundaria();
                        } else {
                            if (isset($_POST["id2"])) {

                                $obra->setIdImagenP($_POST["id2"]);
                                $saveImages = $obra->editarImagenSecundaria();
                            }
                            unlink("uploads/images/" . $_POST["images2"]);
                        }
                    }
                } else {

                    $obra->setImagenPrincipal($_POST["images2"]);
                }

                if ($_FILES['imagen3']['name'] != null) {
                    $archivo = $_FILES["imagen3"];
                    $filename = $archivo["name"];
                    $mimetype = $archivo["type"];
                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir("uploads/images")) {
                            mkdir("uploads/images", 0777, true);
                        }
                        move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                        $obra->setImagenPrincipal($filename);

                        if (!isset($_POST["images3"])) {
                            $result = $obra->guardarImagenSecundaria();
                        } else {
                            if (isset($_POST["id3"])) {
                                echo "cambiando" . $_POST["id3"];
                                $obra->setIdImagenP($_POST["id3"]);
                                $saveImages = $obra->editarImagenSecundaria();
                            }
                            unlink("uploads/images/" . $_POST["images3"]);
                        }
                    }
                } else {

                    $obra->setImagenPrincipal($_POST["images3"]);
                }
            }

            if ($_FILES['imagen4']['name'] != null) {
                $archivo = $_FILES["imagen4"];
                $filename = $archivo["name"];
                $mimetype = $archivo["type"];
                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir("uploads/images")) {
                        mkdir("uploads/images", 0777, true);
                    }
                    move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                    $obra->setImagenPrincipal($filename);

                    if (!isset($_POST["images4"])) {
                        $result = $obra->guardarImagenSecundaria();
                    } else {
                        if (isset($_POST["id4"])) {

                            $obra->setIdImagenP($_POST["id4"]);
                            $saveImages = $obra->editarImagenSecundaria();
                        }
                        unlink("uploads/images/" . $_POST["images4"]);
                    }
                }
            } else {

                $obra->setImagenPrincipal($_POST["images4"]);
            }


            /*             * **************************************** */

            if ($_FILES['imagen']['name'] != null) {
                $archivo = $_FILES["imagen"];
                $filename = $archivo["name"];
                $mimetype = $archivo["type"];
                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir("uploads/images")) {
                        
                    }
                    move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                    $obra->setImagenPrincipal($filename);
                    unlink("uploads/images/" . $_POST["images"]);
                }
            } else {

                $obra->setImagenPrincipal($_POST["images"]);
            }

            $save = $obra->editar();


            if ($save) {
                $_SESSION["modificado"] = "complete";
            } else {
                $_SESSION["modificado"] = "failed";
            }
        }
        header("Location:" . base_url . "obrasArquitecto/editar&id={$_GET["id"]}");
         echo"<script language='javascript'>window.location='".base_url . "obrasArquitecto/editar&id={$_GET["id"]}"."'</script>;";
    }

    public function gestion() {
        utilidades::isAdmin();
        $obra = new obrasArquitectoModel();
        $obras = $obra->obtenerObras();
        $numeroElementos = $obras->num_rows;

        $numeroDeElementosPagina = 4;
        //hacer paginacion
        $pagination = new Zebra_Pagination();
        $empiezaAqui = utilidades::paginacion($pagination, $numeroElementos, $numeroDeElementosPagina);
        $obra = $obra->obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina);



        require_once './views/ObrasViews/gestionViews.php';
    }
    
     public function getByDate($inputNoticia, $idUser) {
         
        $obra = new obrasArquitectoModel();
        $inputNoticia = str_replace("/", "-", $inputNoticia);
         $obra->setFecha($inputNoticia);
        $obras= $obra->getByDate();
            if ($obras->num_rows > 0) {
                $id = "   <div class='row  grupoDeCards'>"
                . "    <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'> ";
                
            while ($obr = $obras->fetch_object()) {

                $id .= "    <div class='card col-lg-3 col-sm-6 m-1'>"
                        . "   <div class='card-header fondoBlanco '>"
                        . "                        <div class='d-flex justify-content-end'>"
                        . "   <a class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>"
                        . " <a href='".base_url."obrasArquitecto/editar&id={$obr->id}' class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>"
                        . "  <strong> <label>Titulo : <label>{$obr->nombre} </label> </label></strong>"
                        . " </div>"
                        . "  <div class='card-body'>"
                        . "<div class='container-avatar mt-1 '>"
                        . "<img class='img-fluid ' style='width: 80px;height: 80px;' src='".base_url."uploads/images/".$obr->imagen."'>"
                        . "</div>"
                        . "<div class='description mt-4'>"
                        . " <span class='date m-2 p-2'>"
                        . " <strong> Creado el {$obr->fecha}</strong>"
                        . " </span>"
                        . " <br>"
                        . "<strong><span class='date m-2 p-2'>".FormatTime::imprimirTiempo($obr->fecha)."</span></strong>"
                        . "<p class='p-3 text-justify '>{$obr->descripcion}</p>       "
                        . " </div>"
                        . " </div>"
                        . "</div>";
            }
            $id .= "</div>";
        } else {
            $id .= "<p>No hay coincidencia</p> ";
        }
        return $id;
    }
    
    
    public function save(){
        utilidades::isAdmin();
        
        
         utilidades::isAdmin();
        if (isset($_POST)) {
            $obra = new obrasArquitectoModel();

            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : false;

            if ($nombre && $descripcion && $user_id) {

                $obra->setNombre($nombre);
                $obra->setDescripcion($descripcion);
                $obra->setId_usuario($user_id);
         


                $archivo = $_FILES["imagen"];
                $filename = $archivo["name"];
                $mimetype = $archivo["type"];
                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir("uploads/images")) {
                        mkdir("uploads/images", 0777, true);
                    }
                    move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                    $obra->setImagenPrincipal($filename);
                  
                          $idObra = $obra->save();
                }
                if ($save) {

                    $_SESSION["producto"] = "complete";
                } else {

                    $_SESSION["producto"] = "failed";
                }
            } else {

                $_SESSION["producto"] = "failed";
            }
        }
        header("Location:" . base_url . "?controller=obrasArquitecto&action=Gestion");
         echo"<script language='javascript'>window.location='".base_url .  "?controller=obrasArquitecto&action=Gestion"."'</script>;";
        
    }
    
    
    
//busca productos por nombre
    public function getByDescripcion($id) {
         $obra = new obrasArquitectoModel();
      $obra->setDescripcion($id);
        $obras = $obra->getAllByDescrip();;
        $id = "   <div class='row  grupoDeCards'>"
                . "    <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'> ";
        if ($obras) {


            while ($obr = $obras->fetch_object()) {

                $id .= "    <div class='card col-lg-3 col-sm-6 m-1'>"
                        . "   <div class='card-header fondoBlanco '>"
                        . "                        <div class='d-flex justify-content-end'>"
                        . "   <a class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>"
                        . " <a href='".base_url."obrasArquitecto/editar&id={$obr->id}' class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>"
                        . "  <strong> <label>Titulo : <label>{$obr->nombre} </label> </label></strong>"
                        . " </div>"
                        . "  <div class='card-body'>"
                        . "<div class='container-avatar mt-1 '>"
                        . "<img class='img-fluid ' style='width: 80px;height: 80px;' src='".base_url."uploads/images/".$obr->imagen."'>"
                        . "</div>"
                        . "<div class='description mt-4'>"
                        . " <span class='date m-2 p-2'>"
                        . " <strong> Creado el {$obr->fecha}</strong>"
                        . " </span>"
                        . " <br>"
                        . "<strong><span class='date m-2 p-2'>".FormatTime::imprimirTiempo($obr->fecha)."</span></strong>"
                        . "<p class='p-3 text-justify '>{$obr->descripcion}</p>       "
                        . " </div>"
                        . " </div>"
                        . "</div>";
            }
            $id .= "</div>";
        } else {
            $id .= "<p>No hay coincidencia</p> ";
        }
        return $id;
    }
    
    
    
    //busca productos por id
    public function getById($id) {

        $obra = new obrasArquitectoModel();
      $obra->setId($id);
        $obras = $obra->getAllByid();
        $id = "   <div class='row  grupoDeCards'>"
                . "    <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'> ";
        if ($obras) {


            while ($obr = $obras->fetch_object()) {

                $id .= "    <div class='card col-lg-3 col-sm-6 m-1'>"
                        . "   <div class='card-header fondoBlanco '>"
                        . "                        <div class='d-flex justify-content-end'>"
                        . "   <a class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>"
                        . " <a href='".base_url."obrasArquitecto/editar&id={$obr->id}' class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>"
                        . "  <strong> <label>Titulo : <label>{$obr->nombre} </label> </label></strong>"
                        . " </div>"
                        . "  <div class='card-body'>"
                        . "<div class='container-avatar mt-1 '>"
                        . "<img class='img-fluid ' style='width: 80px;height: 80px;' src='".base_url."uploads/images/".$obr->imagen."'>"
                        . "</div>"
                        . "<div class='description mt-4'>"
                        . " <span class='date m-2 p-2'>"
                        . " <strong> Creado el {$obr->fecha}</strong>"
                        . " </span>"
                        . " <br>"
                        . "<strong><span class='date m-2 p-2'>".FormatTime::imprimirTiempo($obr->fecha)."</span></strong>"
                        . "<p class='p-3 text-justify '>{$obr->descripcion}</p>       "
                        . " </div>"
                        . " </div>"
                        . "</div>";
            }
            $id .= "</div>";
        } else {
            $id .= "<p>No hay coincidencia</p> ";
        }
        return $id;
    }

    public function ver() {

        $editar = true;
        if (isset($_GET["id"])) {
            $obra = new obrasArquitectoModel();
            $obra->setId($_GET["id"]);
            $ob = $obra->getOne();
            $imagenesGrupo = $obra->getGroupImages();
        }
        require_once './views/ObrasViews/verObraView.php';
    }

}
