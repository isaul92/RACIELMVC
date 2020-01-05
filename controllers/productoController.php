<?php

require_once 'models/productoModelo.php';

class productoController {

    public function index() {
        $producto = new productoModelo();
        $productos = $producto->getRandom(6);

        require_once 'views/productoViews/productosDestacados.php';
    }

//busca productos por id
    public function getById($id) {

        $producto = new productoModelo();
        $productos = $producto->setId($id);
        $productos = $producto->getAllByid();
        $id = "   <div class='col-12 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>   ";
        if ($productos) {


            while ($product = $productos->fetch_object()) {

                $id .= "   <div class='card col-lg-3 col-sm-6 m-1'>"
                        . " <div class='card-header fondoBlanco d-flex'>"
                        . "<div class='container-avatar '>"
                        . "   <img class='img-fluid ' style='width: 80px;height: 80px;' src='" . base_url . "uploads/images/$product->imagen'>"
                        . "   </div>"
                        . "<a href='" . base_url . "producto/ver&id=$product->id' > <label>$product->nombre</label> </a>"
                        . " </div>"
                        . "      <div class='card-body fondoBlanco'>"
                        . "        <div class=' row d-flex  flex-wrap '>"
                        . "       <div class='col-12 fondoBlanco'>"
                        . "         <label>   Producto ID: <?= $product->id; ?> </label>"
                        . "   <p>  Categoria: <?= $product->nombreCategoria; ?> </p>"
                        . "   <p>Descripcion :</p>"
                        . "  <p> $product->descripcion</p>"
                        . "  </div>"
                        . "  <div class='col-6  fondoBlanco'>Precio: $product->precio</div>"
                        . " <div class='col-6  fondoBlanco'>Stock: $product->stock</div>"
                        . " </div>"
                        . " </div>"
                        . " <div class='card-footer fondoBlanco'>"
                        . "  <td>   <a href='" . base_url . "producto/eliminar&id=$product->id' style='color:black;' class='btn m-1 btn-outline-danger'>Eliminar </a>"
                        . "     <a href='" . base_url . "producto/editar&id=$product->id' style='color:black;' class='btn btn-outline-warning m-1' >Editar</a>"
                        . "  </td>"
                        . "   </div>"
                        . "   </div>";
            }
            $id .= "</div>";
        } else {
            $id .= "<p>No hay coincidencia</p> ";
        }
        return $id;
    }

//busca productos por nombre
    public function getByDescripcion($id) {

        $producto = new productoModelo();
        $productos = $producto->setDescripcion($id);
        $productos = $producto->getAllByDescrip();
        $id = "   <div class='col-12 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>   ";
        if ($productos) {


            while ($product = $productos->fetch_object()) {

                $id .= "   <div class='card col-lg-3 col-sm-6 m-1'>"
                        . " <div class='card-header fondoBlanco d-flex'>"
                        . "<div class='container-avatar '>"
                        . "   <img class='img-fluid ' style='width: 80px;height: 80px;' src='" . base_url . "uploads/images/$product->imagen'>"
                        . "   </div>"
                        . "<a href='" . base_url . "producto/ver&id=$product->id' > <label>$product->nombre</label> </a>"
                        . " </div>"
                        . "      <div class='card-body fondoBlanco'>"
                        . "        <div class=' row d-flex  flex-wrap '>"
                        . "       <div class='col-12 fondoBlanco'>"
                        . "         <label>   Producto ID: <?= $product->id; ?> </label>"
                        . "   <p>  Categoria: <?= $product->nombreCategoria; ?> </p>"
                        . "   <p>Descripcion :</p>"
                        . "  <p> $product->descripcion</p>"
                        . "  </div>"
                        . "  <div class='col-6  fondoBlanco'>Precio: $product->precio</div>"
                        . " <div class='col-6  fondoBlanco'>Stock: $product->stock</div>"
                        . " </div>"
                        . " </div>"
                        . " <div class='card-footer fondoBlanco'>"
                        . "  <td>   <a href='" . base_url . "producto/eliminar&id=$product->id' style='color:black;' class='btn m-1 btn-outline-danger'>Eliminar </a>"
                        . "     <a href='" . base_url . "producto/editar&id=$product->id' style='color:black;' class='btn btn-outline-warning m-1' >Editar</a>"
                        . "  </td>"
                        . "   </div>"
                        . "   </div>";
            }
            $id .= "</div>";
        } else {
            $id .= "<p>No hay coincidencia</p> ";
        }
        return $id;
    }

//busca productos por nombre
    public function getByNombre($id) {

        $producto = new productoModelo();
        $productos = $producto->setNombre($id);
        $productos = $producto->getAllByName();
        $id = "   <div class='col-12 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>   ";
        if ($productos) {


            while ($product = $productos->fetch_object()) {


                $id .= "   <div class='card col-lg-3 col-sm-6 m-1'>"
                        . " <div class='card-header fondoBlanco d-flex'>"
                        . "<div class='container-avatar '>"
                        . "   <img class='img-fluid ' style='width: 80px;height: 80px;' src='" . base_url . "uploads/images/$product->imagen'>"
                        . "   </div>"
                        . "<a href='" . base_url . "producto/ver&id=$product->id' > <label>$product->nombre</label> </a>"
                        . " </div>"
                        . "      <div class='card-body fondoBlanco'>"
                        . "        <div class=' row d-flex  flex-wrap '>"
                        . "       <div class='col-12 fondoBlanco'>"
                        . "         <label>   Producto ID: <?= $product->id; ?> </label>"
                        . "   <p>  Categoria: <?= $product->nombreCategoria; ?> </p>"
                        . "   <p>Descripcion :</p>"
                        . "  <p> $product->descripcion</p>"
                        . "  </div>"
                        . "  <div class='col-6  fondoBlanco'>Precio: $product->precio</div>"
                        . " <div class='col-6  fondoBlanco'>Stock: $product->stock</div>"
                        . " </div>"
                        . " </div>"
                        . " <div class='card-footer fondoBlanco'>"
                        . "  <td>   <a href='" . base_url . "producto/eliminar&id=$product->id' style='color:black;' class='btn m-1 btn-outline-danger'>Eliminar </a>"
                        . "     <a href='" . base_url . "producto/editar&id=$product->id' style='color:black;' class='btn btn-outline-warning m-1' >Editar</a>"
                        . "  </td>"
                        . "   </div>"
                        . "   </div>";
            }
            $id .= "</div>";
        } else {
            $id .= "<p>No hay coincidencia</p> ";
        }
        return $id;
    }
    public function verTodos() {
        $producto = new productoModelo();
        $productos = $producto->getAll();
        $numeroElementos = $productos->num_rows;
        $numeroDeElementosPagina = 4;
        //hacer paginacion
        $pagination = new Zebra_Pagination();
        $empiezaAqui = utilidades::paginacion($pagination, $numeroElementos, $numeroDeElementosPagina);
        $productos = $producto->obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina);
        require_once 'views/productoViews/verTodosProductos.php';
    }

    public function gestion() {
        utilidades::isAdmin();
        $producto = new productoModelo();
        $productos = $producto->getAll();
        require_once 'views/productoViews/productoGestion.php';
    }

    public function crear() {
        utilidades::isAdmin();

        require_once 'views/productoViews/productoCrearVista.php';
    }

    public function save() {
        utilidades::isAdmin();
        if (isset($_POST)) {
            $producto = new productoModelo();
            $dimensiones = isset($_POST["dimensiones"]) ? $_POST["dimensiones"] : false;
            $precioConDescuento = isset($_POST["precioConDescuento"]) ? $_POST["precioConDescuento"] : false;
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $categoria_id = isset($_POST["categoria_id"]) ? $_POST["categoria_id"] : false;
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
            $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
            $imagen = isset($_POST["imagen"]) ? $_POST["imagen"] : false;

            if ($nombre && $descripcion && $categoria_id && $precio && $stock) {

                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria_id);

                $producto->setPrecio($precio);
                $producto->setStock($stock);

                $producto->setStock($stock);
                $producto->setDimensiones($dimensiones);
                $producto->setPrecionConDescuento($precioConDescuento);

                $archivo = $_FILES["imagen"];
                $filename = $archivo["name"];
                $mimetype = $archivo["type"];
                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                    if (!is_dir("uploads/images")) {
                        mkdir("uploads/images", 0777, true);
                    }
                    move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                    $producto->setImagen($filename);
                }
                $save = $producto->save();
               echo $save;
             
                if ($save) {
                    $_SESSION["modificado"] = "complete";
                } else {
                    $_SESSION["modificado"] = "failed";
                }
            } else {

                $_SESSION["producto"] = "failed";
            }
        }
        //header("Location:" . base_url . "producto/gestion");
              echo"<script language='javascript'>window.location='".base_url .  "producto/gestion"."'</script>;";
    }

    public function editarProducto() {
        utilidades::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
            $categoria_id = isset($_POST["categoria_id"]) ? $_POST["categoria_id"] : false;
            $precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
            $stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
            $dimensiones = isset($_POST["dimensiones"]) ? $_POST["dimensiones"] : false;
            $precioConDescuento = isset($_POST["precioConDescuento"]) ? $_POST["precioConDescuento"] : false;
            if ($nombre && $descripcion && $categoria_id && $precio && $stock) {
                $producto = new productoModelo();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria_id);
                $producto->setId($_GET["id"]);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setDimensiones($dimensiones);
                $producto->setPrecionConDescuento($precioConDescuento);

                $saveImages = true;




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


                        $producto->setImagen($filename);

                        if (!isset($_POST["images2"])) {
                            $result = $producto->guardarImagenSecundaria();
                        } else {
                            if (isset($_POST["id2"])) {

                                $producto->setIdImagenP($_POST["id2"]);
                                $saveImages = $producto->editarImagenSecundaria();
                            }
                            unlink("uploads/images/" . $_POST["images2"]);
                        }
                    }
                } else {

                    $producto->setImagen($_POST["images2"]);
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
                        $producto->setImagen($filename);
                        $producto->setImagen($filename);

                        if (!isset($_POST["images3"])) {
                            $result = $producto->guardarImagenSecundaria();
                        } else {
                            if (isset($_POST["id3"])) {
                                echo "cambiando" . $_POST["id3"];
                                $producto->setIdImagenP($_POST["id3"]);
                                $saveImages = $producto->editarImagenSecundaria();
                            }
                            unlink("uploads/images/" . $_POST["images3"]);
                        }
                    }
                } else {

                    $producto->setImagen($_POST["images3"]);
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
                    $producto->setImagen($filename);
                    $producto->setImagen($filename);

                    if (!isset($_POST["images4"])) {
                        $result = $producto->guardarImagenSecundaria();
                    } else {
                        if (isset($_POST["id4"])) {

                            $producto->setIdImagenP($_POST["id4"]);
                            $saveImages = $producto->editarImagenSecundaria();
                        }
                        unlink("uploads/images/" . $_POST["images4"]);
                    }
                }
            } else {

                $producto->setImagen($_POST["images4"]);
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
                    $producto->setImagen($filename);
                    unlink("uploads/images/" . $_POST["images"]);
                }
            } else {

                $producto->setImagen($_POST["images"]);
            }

            $save = $producto->editar();
echo $save;
            if ($save ) {
                $_SESSION["modificado"] = "complete";
            } else {
                $_SESSION["modificado"] = "failed";
            }
        }
        header("Location:" . base_url . "producto/editar&id={$_GET["id"]}");
        
              echo"<script language='javascript'>window.location='".base_url . "producto/editar&id={$_GET["id"]}"."'</script>;";
    }

    public function editar() {
        utilidades::isAdmin();
        $editar = true;
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setId($_GET["id"]);
            $pro = $producto->getOne();
            $grupoImages = $producto->getGroupImages();
            $grupoImages2 = $grupoImages;


            require_once 'views/productoViews/productoCrearVista.php';
        } else {
            header("Location:" . base_url . "producto/gestion");
             echo"<script language='javascript'>window.location='".base_url . "producto/gestion"."'</script>;";
        }
    }

    public function eliminar() {
        utilidades::isAdmin();
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setId($_GET["id"]);
            $delete = $producto->delete();
            if ($delete) {
                $_SESSION["delete"] = "complete";
            } else {
                $_SESSION["delete"] = "failed";
            }
        } else {
            $_SESSION["delete"] = "failed";
        }
        header("Location:" . base_url . "producto/gestion");
           echo"<script language='javascript'>window.location='".base_url . "producto/gestion"."'</script>;";
    }

    public function eliminarImagenProduct() {
        utilidades::isAdmin();
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setIdImagenP($_GET["idPImagen"]);
            $result = $producto->deleteImageGroup();


            unlink("uploads/images/" . $_GET["images"]);
        }
        header("Location:" . base_url . "producto/editar&id={$_GET["id"]}");
           echo"<script language='javascript'>window.location='".base_url ."producto/editar&id={$_GET["id"]}"."'</script>;";
    }

    public function ver() {
        //  utilidades::isLogger();
        $editar = true;
        if (isset($_GET["id"])) {
            $producto = new productoModelo();
            $producto->setId($_GET["id"]);
            $pro = $producto->getOne();
            $imagenesGrupo = $producto->getGroupImages();
        }
        require_once 'views/productoViews/verProducto.php';
    }

}
