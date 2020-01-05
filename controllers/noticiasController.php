<?php

require_once 'models/noticiasModelo.php';
require_once 'models/productoModelo.php';
require_once 'models/obrasArquitectoModel.php';
require_once 'models/comentariosNoticiasModel.php';
require_once 'models/imagenesGrupoModel.php';

class noticiasController {

    public function index() {
        $obras = new obrasArquitectoModel();
        $obras = $obras->getRandoms(6);
        $productos = new productoModelo();
        $productos = $productos->getRandom(6);
        $comentarios = new comentariosNoticiasModel();
     
        $noticias = new noticiasModelo();
        $noticiass = $noticias->obtenerNoticias();
        $numeroElementos = $noticiass->num_rows;

        $numeroDeElementosPagina = 4;
        //hacer paginacion
        $pagination = new Zebra_Pagination();
        $empiezaAqui = utilidades::paginacion($pagination, $numeroElementos, $numeroDeElementosPagina);
        $noticias = $noticias->obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina);

        require_once 'views/noticiasViews/noticiasView.php';
    }

    public function getById($id, $idUser) {
        $noticia = new noticiasModelo();
        $noticia->setId($id);
        $noticias = $noticia->getById();

        if ($noticias->num_rows > 0) {


            $id = "<div class='row  grupoDeCards'>"
                    . " <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>";
            while ($noticia = $noticias->fetch_object()) {
                //  $fecha=  FormatTime::imprimirTiempo($noticia->created_at);
                $idComent = $noticia->id;
                $comments = utilidades::getComments($noticia->id);
                $id .= " <div class='card col-lg-3 col-sm-6 m-1'>"
                        . " <div class='card-header fondoBlanco '>"
                        . "  <div class='d-flex justify-content-end'>"
                        . "<a href='noticias/eliminar&id={$noticia->id}' class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>"
                        . " <a class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>"
                        . " <strong> <label>Titulo : <label>" . $noticia->nombre . "  </label> </label></strong>"
                        . "<label>Autor  : <label>" . $noticia->autor . " </label> </label>"
                        . " </div>"
                        . "  <div class='card-body'>"
                        . "  <div class='container-avatar '>"
                        . " <img class='img-fluid ' style='width: 80px;height: 80px;' src='" . base_url . "uploads/images/$noticia->nombreImagen'>"
                        . "</div>"
                        . " <div class='description mt-4'>"
                        . "  <span class='date m-2 p-2'>"
                        . " <strong> Creado el " . $noticia->created_at . " </strong>"
                        . " </span>"
                        . "<br>"
                        . "<strong><span class='date m-2 p-2'>" . FormatTime::imprimirTiempo($noticia->created_at) . " </span></strong>"
                        . "<p class='p-3 text-justify '>$noticia->texto</p>"
                        . " </div>"
                        . "<div class = 'comments  '>"
                        . "<button   onclick='javascript:oculta(" . '"' . "item" . $noticia->id . '"' . ")'"
                        . " class = 'btn btn-sm btn-outline-warning mb-2  m-2 btn-comments' >Comentarios(" . utilidades::countCommentsNews($noticia->id) . ") </button>"
                        . "<div class='invisible' id='item" . $idComent . "' style='display: none;'>"
                        . " <form id='comentarios" . $idComent . "'>"
                        . "<input type='hidden' id='id_user' name='id_user' value='" . $idUser . "'>"
                        . "<input type='hidden' name='id_noticia' id='id_noticia' value='" . $idUser . "'>"
                        . "<input type='hidden' name='elemento' id='elemento' value='" . $idUser . "'>"
                        . " <input type='hidden' name='elemento' id='elemento' value='comentarios" . $idUser . "'>"
                        . "<input type='hidden' name='noticiaid' id='noticia" . $noticia->id . "'  value='comentarios" . $idComent . "'>"
                        . "<p>"
                        . "<textarea  onchange='validar(event)'  required='required' class='form-control' id='comentario" . $idComent . "' name='comentario' ></textarea>"
                        . "<span class='invalid-feedback' role='alert'>"
                        . "   <strong>¡No ha escrito nada!</strong>"
                        . "</span>"
                        . "  </p>  "
                        . "<button  class='btn btn-outline-success submitComent ' id='botonGuardar' name='comentarios" . $idComent . "' type='submit' >Comentar</button>"
                        . "</form>"
                        . "<div class=' comentarios" . $idComent . "'>  </div>";
                while ($comment = $comments->fetch_object()) {
                    $id .= "<div class='comments m-0 p-0 row  detailcomment divComentarioEliminar" . $comment->id . "'> "
                            . "<div class='col-12 d-flex justify-content-between '> "
                            . "  <p><small>" . $comment->nombre . " | " . FormatTime::imprimirTiempo($comment->created_at) . "</small></p>"
                            . " <form class='idComment" . $comment->id . "'>"
                            . "<input type='hidden' name='idComentario' value='" . $comment->id . "'>"
                            . "<button type='submit' class='btn btn-sm btn-outline-danger eliminarCommentario' name='" . $comment->id . "'>Eliminar</button></form>"
                            . "</div>"
                            . " <div class='col-12 '> "
                            . "   <p style='background:white!important;'>" . $comment->content . "</p>  "
                            . "  </div>"
                            . "</div>"
                            . "<hr>"
                            . "";
                }
                $id .= "<div class='clearfix'></div>"
                        . " </div>"
                        . "</div>"
                        . " </div>"
                        . "</div>";
            }
            $id .= "   </div> "
                    . " </div> ";
        } else {
            $id = "<div id='divError'><p>No hay coincidencia</p> </div>";
        }
        return $id;
    }

    public function getByName($inputNoticia, $idUser) {
        $noticia = new noticiasModelo();
        $noticia->setNombre($inputNoticia);
        $noticias = $noticia->getByName();

        if ($noticias->num_rows > 0) {


            $id = "<div class='row  grupoDeCards'>"
                    . " <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>";
            while ($noticia = $noticias->fetch_object()) {
                //  $fecha=  FormatTime::imprimirTiempo($noticia->created_at);
                $idComent = $noticia->id;
                $comments = utilidades::getComments($noticia->id);
                $id .= " <div class='card col-lg-3 col-sm-6 m-1'>"
                        . " <div class='card-header fondoBlanco '>"
                        . "  <div class='d-flex justify-content-end'>"
                      . "<a href='noticias/eliminar&id={$noticia->id}' class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>"
                        . " <a class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>"
                        . " <strong> <label>Titulo : <label>" . $noticia->nombre . "  </label> </label></strong>"
                        . "<label>Autor  : <label>" . $noticia->autor . " </label> </label>"
                        . " </div>"
                        . "  <div class='card-body'>"
                        . "  <div class='container-avatar '>"
                        . " <img class='img-fluid ' style='width: 80px;height: 80px;' src='" . base_url . "uploads/images/$noticia->nombreImagen'>"
                        . "</div>"
                        . " <div class='description mt-4'>"
                        . "  <span class='date m-2 p-2'>"
                        . " <strong> Creado el " . $noticia->created_at . " </strong>"
                        . " </span>"
                        . "<br>"
                        . "<strong><span class='date m-2 p-2'>" . FormatTime::imprimirTiempo($noticia->created_at) . " </span></strong>"
                        . "<p class='p-3 text-justify '>$noticia->texto</p>"
                        . " </div>"
                        . "<div class = 'comments  '>"
                        . "<button   onclick='javascript:oculta(" . '"' . "item" . $noticia->id . '"' . ")'"
                        . " class = 'btn btn-sm btn-outline-warning mb-2  m-2 btn-comments' >Comentarios(" . utilidades::countCommentsNews($noticia->id) . ") </button>"
                        . "<div class='invisible' id='item" . $idComent . "' style='display: none;'>"
                        . " <form id='comentarios" . $idComent . "'>"
                        . "<input type='hidden' id='id_user' name='id_user' value='" . $idUser . "'>"
                        . "<input type='hidden' name='id_noticia' id='id_noticia' value='" . $idUser . "'>"
                        . "<input type='hidden' name='elemento' id='elemento' value='" . $idUser . "'>"
                        . " <input type='hidden' name='elemento' id='elemento' value='comentarios" . $idUser . "'>"
                        . "<input type='hidden' name='noticiaid' id='noticia" . $noticia->id . "'  value='comentarios" . $idComent . "'>"
                        . "<p>"
                        . "<textarea  onchange='validar(event)'  required='required' class='form-control' id='comentario" . $idComent . "' name='comentario' ></textarea>"
                        . "<span class='invalid-feedback' role='alert'>"
                        . "   <strong>¡No ha escrito nada!</strong>"
                        . "</span>"
                        . "  </p>  "
                        . "<button  class='btn btn-outline-success submitComent ' id='botonGuardar' name='comentarios" . $idComent . "' type='submit' >Comentar</button>"
                        . "</form>"
                        . "<div class=' comentarios" . $idComent . "'>  </div>";
                while ($comment = $comments->fetch_object()) {
                    $id .= "<div class='comments m-0 p-0 row  detailcomment divComentarioEliminar" . $comment->id . "'> "
                            . "<div class='col-12 d-flex justify-content-between '> "
                            . "  <p><small>" . $comment->nombre . " | " . FormatTime::imprimirTiempo($comment->created_at) . "</small></p>"
                            . " <form class='idComment" . $comment->id . "'>"
                            . "<input type='hidden' name='idComentario' value='" . $comment->id . "'>"
                            . "<button type='submit' class='btn btn-sm btn-outline-danger eliminarCommentario' name='" . $comment->id . "'>Eliminar</button></form>"
                            . "</div>"
                            . " <div class='col-12 '> "
                            . "   <p style='background:white!important;'>" . $comment->content . "</p>  "
                            . "  </div>"
                            . "</div>"
                            . "<hr>"
                            . "";
                }
                $id .= "<div class='clearfix'></div>"
                        . " </div>"
                        . "</div>"
                        . " </div>"
                        . "</div>";
            }
            $id .= "   </div> "
                    . " </div> ";
        } else {
            $id = "<div id='divError'><p>No hay coincidencia</p> </div>";
        }
        return $id;
    }

    public function getByDate($inputNoticia, $idUser) {

        $noticia = new noticiasModelo();
        $inputNoticia = str_replace("/", "-", $inputNoticia);


        $noticia->setFecha($inputNoticia);
        $noticias = $noticia->getByDate();

        if ($noticias->num_rows > 0) {


            $id = "<div class='row  grupoDeCards'>"
                    . " <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>";
            while ($noticia = $noticias->fetch_object()) {
                //  $fecha=  FormatTime::imprimirTiempo($noticia->created_at);
                $idComent = $noticia->id;
                $comments = utilidades::getComments($noticia->id);
                $id .= " <div class='card col-lg-3 col-sm-6 m-1'>"
                        . " <div class='card-header fondoBlanco '>"
                        . "  <div class='d-flex justify-content-end'>"
                      . "<a href='noticias/eliminar&id={$noticia->id}' class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>"
                        . " <a class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>"
                        . " <strong> <label>Titulo : <label>" . $noticia->nombre . "  </label> </label></strong>"
                        . "<label>Autor  : <label>" . $noticia->autor . " </label> </label>"
                        . " </div>"
                        . "  <div class='card-body'>"
                        . "  <div class='container-avatar '>"
                        . " <img class='img-fluid ' style='width: 80px;height: 80px;' src='" . base_url . "uploads/images/$noticia->nombreImagen'>"
                        . "</div>"
                        . " <div class='description mt-4'>"
                        . "  <span class='date m-2 p-2'>"
                        . " <strong> Creado el " . $noticia->created_at . " </strong>"
                        . " </span>"
                        . "<br>"
                        . "<strong><span class='date m-2 p-2'>" . FormatTime::imprimirTiempo($noticia->created_at) . " </span></strong>"
                        . "<p class='p-3 text-justify '>$noticia->texto</p>"
                        . " </div>"
                        . "<div class = 'comments  '>"
                        . "<button   onclick='javascript:oculta(" . '"' . "item" . $noticia->id . '"' . ")'"
                        . " class = 'btn btn-sm btn-outline-warning mb-2  m-2 btn-comments' >Comentarios(" . utilidades::countCommentsNews($noticia->id) . ") </button>"
                        . "<div class='invisible' id='item" . $idComent . "' style='display: none;'>"
                        . " <form id='comentarios" . $idComent . "'>"
                        . "<input type='hidden' id='id_user' name='id_user' value='" . $idUser . "'>"
                        . "<input type='hidden' name='id_noticia' id='id_noticia' value='" . $idUser . "'>"
                        . "<input type='hidden' name='elemento' id='elemento' value='" . $idUser . "'>"
                        . " <input type='hidden' name='elemento' id='elemento' value='comentarios" . $idUser . "'>"
                        . "<input type='hidden' name='noticiaid' id='noticia" . $noticia->id . "'  value='comentarios" . $idComent . "'>"
                        . "<p>"
                        . "<textarea  onchange='validar(event)'  required='required' class='form-control' id='comentario" . $idComent . "' name='comentario' ></textarea>"
                        . "<span class='invalid-feedback' role='alert'>"
                        . "   <strong>¡No ha escrito nada!</strong>"
                        . "</span>"
                        . "  </p>  "
                        . "<button  class='btn btn-outline-success submitComent ' id='botonGuardar' name='comentarios" . $idComent . "' type='submit' >Comentar</button>"
                        . "</form>"
                        . "<div class=' comentarios" . $idComent . "'>  </div>";
                while ($comment = $comments->fetch_object()) {
                    $id .= "<div class='comments m-0 p-0 row  detailcomment divComentarioEliminar" . $comment->id . "'> "
                            . "<div class='col-12 d-flex justify-content-between '> "
                            . "  <p><small>" . $comment->nombre . " | " . FormatTime::imprimirTiempo($comment->created_at) . "</small></p>"
                            . " <form class='idComment" . $comment->id . "'>"
                            . "<input type='hidden' name='idComentario' value='" . $comment->id . "'>"
                            . "<button type='submit' class='btn btn-sm btn-outline-danger eliminarCommentario' name='" . $comment->id . "'>Eliminar</button></form>"
                            . "</div>"
                            . " <div class='col-12 '> "
                            . "   <p style='background:white!important;'>" . $comment->content . "</p>  "
                            . "  </div>"
                            . "</div>"
                            . "<hr>"
                            . "";
                }
                $id .= "<div class='clearfix'></div>"
                        . " </div>"
                        . "</div>"
                        . " </div>"
                        . "</div>";
            }
            $id .= "   </div> "
                    . " </div> ";
        } else {
            $id = "<div id='divError'><p>No hay coincidencia</p> </div>";
        }
        return $id;
    }

    public function editar() {
        utilidades::isAdmin();
        $editar = true;
        if (isset($_GET["id"])) {
            $noticia = new noticiasModelo();
            $noticia->setId($_GET["id"]);
            $pro = $noticia->getOne();



            require_once 'views/noticiasViews/crearNoticia.php';
        } else {
            header("Location:" . base_url . "producto/gestion");
              echo"<script language='javascript'>window.location='".base_url . "producto/gestion"."'</script>;";
        }
    }

    public function crearNoticia() {
        utilidades::isAdmin();



        require_once 'views/noticiasViews/crearNoticia.php';
    }

    public function save() {
        utilidades::isAdmin();
        if (isset($_POST)) {
            $noticias = new noticiasModelo();
            $imagenesGrupo = new imagenesGrupoModel();

            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $texto = isset($_POST["texto"]) ? $_POST["texto"] : false;
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : false;

            if ($nombre && $texto && $user_id) {

                $noticias->setNombre($nombre);
                $noticias->setTexto($texto);
                $noticias->setId_autor($user_id);
                $idNoticia = $noticias->save();


                $archivo = $_FILES["imagen"];
                $filename = $archivo["name"];
                $mimetype = $archivo["type"];
                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir("uploads/images")) {
                        mkdir("uploads/images", 0777, true);
                    }
                    move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                    $imagenesGrupo->setNombreImagen($filename);
                    $imagenesGrupo->setId_noticia($idNoticia);
                    $save = $imagenesGrupo->save();
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
        header("Location:" . base_url . "?controller=noticias&action=Gestion");
            header("Location:" . base_url . "producto/gestion");
              echo"<script language='javascript'>window.location='".base_url . "?controller=noticias&action=Gestion"."'</script>;";
    }

    public function editarNoticia() {


        utilidades::isAdmin();


        if (isset($_POST)) {
            $noticias = new noticiasModelo();
            $imagenesGrupo = new imagenesGrupoModel();

            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $texto = isset($_POST["texto"]) ? $_POST["texto"] : false;
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : false;
            $idImagen = isset($_POST["id"]) ? $_POST["id"] : false;
                   $idNoticia = isset($_POST["id_noticia"]) ? $_POST["id_noticia"] : false;
            if ($nombre && $texto && $user_id && $idImagen && $idNoticia) {
                $noticias->setId($idNoticia);
                $noticias->setNombre($nombre);
                $noticias->setTexto($texto);
                $noticias->setId_autor($user_id);


                if ($_FILES['imagen']['name'] != null) {
                    $archivo = $_FILES["imagen"];
                    $filename = $archivo["name"];
                    $mimetype = $archivo["type"];
                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir("uploads/images")) {
                            
                        }
                        move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                        $imagenesGrupo->setNombreImagen($filename);
                         $imagenesGrupo->setId_noticia($idNoticia);
                        $imagenesGrupo->editNoticia();
                        unlink("uploads/images/" . $_POST["images"]);
                    }
                } else {

                    $imagenesGrupo->setNombreImagen($_POST["images"]);
                     $imagenesGrupo->editNoticia();
                }

                $save = $noticias->editNew();
             
                if ($save) {
                    $_SESSION["modificado"] = "complete";
                } else {
                    $_SESSION["modificado"] = "failed";
                }
            }
            header("Location:" . base_url . "noticias/editar&id={$idNoticia}");
              echo"<script language='javascript'>window.location='".base_url .  "noticias/editar&id={$idNoticia}"."'</script>";
        }
    }

    public function eliminar(){
         utilidades::isAdmin();
        if (isset($_GET["id"])) {
            $noticias = new noticiasModelo();
            $noticias->setId($_GET["id"]);
            $delete = $noticias->delete();
            if ($delete) {
                $_SESSION["delete"] = "complete";
            } else {
                $_SESSION["delete"] = "failed";
            }
        } else {
            $_SESSION["delete"] = "failed";
        }
        header("Location:" . base_url . "noticias/gestion");
            echo"<script language='javascript'>window.location='".base_url . "noticias/gestion"."'</script>";
        
    }
    
    
    public function Gestion() {

        utilidades::isAdmin();

        $comentarios = new comentariosNoticiasModel();
        $noticias = new noticiasModelo();
        $noticiass = $noticias->obtenerNoticias();
        $numeroElementos = $noticiass->num_rows;

        $numeroDeElementosPagina = 10;
        //hacer paginacion
        $pagination = new Zebra_Pagination();
        $empiezaAqui = utilidades::paginacion($pagination, $numeroElementos, $numeroDeElementosPagina);
        $noticias = $noticias->obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina);





        require_once 'views/noticiasViews/noticiasGestion.php';
    }

    public function verNoticia() {
        if (isset($_GET['id'])) {
            $noticia = new noticiasModelo();
            $id = $_GET['id'];
            $noticia = $noticia->getNoticia($id);
            require_once 'views/noticiasViews/noticiaView.php';
        } else {
            echo "<h1>No existe la noticia</h1> ";
        }
    }

}
