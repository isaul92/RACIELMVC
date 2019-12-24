<?php

require_once 'models/noticiasModelo.php';
require_once 'models/productoModelo.php';
require_once 'models/obrasArquitectoModel.php';
require_once 'models/comentariosNoticiasModel.php';


class noticiasController {

    public function index() {
        $obras = new obrasArquitectoModel();
        $obras = $obras->getRandoms(6);
        $productos = new productoModelo();
        $productos = $productos->getRandom(6);
       $comentarios=new comentariosNoticiasModel();
                        $noticias = new noticiasModelo();
        //$noticias = $noticias->obtenerNoticias();
        $numeroElementos = $productos->num_rows;
        $numeroDeElementosPagina = 4;
        //hacer paginacion
        $pagination = new Zebra_Pagination();
        $empiezaAqui = utilidades::paginacion($pagination, $numeroElementos, $numeroDeElementosPagina);
        $noticias = $noticias->obtenerPaginacionTodos($empiezaAqui, $numeroDeElementosPagina);

        require_once 'views/noticiasViews/noticiasView.php';
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
