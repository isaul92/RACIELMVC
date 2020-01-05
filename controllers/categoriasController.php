<?php

require_once 'models/productoModelo.php';
require_once 'models/categoriasModelo.php';

class categoriasController {

    public function index() {
        utilidades::isAdmin();
        $categoria = new categoriasModelo();
        $categorias = $categoria->getAll();
        require_once 'views/categoriasViews/categoriaVista.php';
    }

    public function crear() {
        utilidades::isAdmin();
        require_once 'views/categoriasViews/crearCategoriaView.php';
    }

    //              <>
    public function save() {
        utilidades::isAdmin();
        if ($_POST && isset($_POST["nombre"])) {
            $categoria = new categoriasModelo();
            $categoria->setNombre($_POST["nombre"]);
            $sql = $categoria->save();
        }
    echo"<script language='javascript'>window.location='".base_url . "categorias/index"."'</script>;";
    }

    public function update() {
        utilidades::isAdmin();
        if ($_POST && isset($_POST["nombre"]) && isset($_POST["idCategoria"])) {
            $categoria = new categoriasModelo();
            $categoria->setNombre($_POST["nombre"]);
            $categoria->setId($_POST["idCategoria"]);
            $sql = $categoria->update();
         
           
        }else{
            echo "no llego nada";
        }
                  header("Status: 301 Moved Permanently");
             header("Location:" . base_url . "categorias/index");
               echo"<script language='javascript'>window.location='".base_url . "categorias/index"."'</script>;";
    }

    public function ver() {
        if (isset($_GET["id"])) {
            //CONSEGUIR CATEGORIA
  $categorias = new categoriasModelo();
            $categoria = $categorias->getOne($_GET["id"]);
            //CONSEGUIR PRODUCTO
            $producto = new productoModelo();
            $producto->setCategoria_id($_GET["id"]);
            $productos = $producto->getAllCategory();
            $numeroElementos = $productos->num_rows;
            $numeroDeElementosPagina = 4;
            //hacer paginacion
            $pagination = new Zebra_Pagination();
            $empiezaAqui = utilidades::paginacion($pagination, $numeroElementos, $numeroDeElementosPagina);
            $productos = $producto->obtenerPaginacion($empiezaAqui, $numeroDeElementosPagina);
        }


        require_once 'views/categoriasViews/verCategoria.php';
    }

}

?>