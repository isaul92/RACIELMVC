
<?php

require_once 'models/comentariosNoticiasModel.php';

class comentariosNoticiasController {

    public function mostrarComentariosxNoticia($id) {
        $comentarios = new comentariosNoticiasModel();
        $numeroDeComentarios = $comentarios->obtenerNumeroDeComentatios($id);
        $comentarios = $comentarios->obtenerComentatiosNoticia($id);

        return $comentarios;
    }

    public function guardarComentario($comentario, $id_user, $id_noticia) {
  if (empty($comentarios)) {
         
            $comentarios = new comentariosNoticiasModel();
            $comentarios->setId_user($id_user);
            $comentarios->setId_noticia($id_noticia);
            $comentarios->setContent($comentario);
            $comentarios = $comentarios->guardarComentario();
 return $comentarios;
       
        }
       
    }

    public function deleteComment($id) {
      
        if (isset($id)) {
          
            $comentarios = new comentariosNoticiasModel();
            $comentarios->setId($id);
           $comentarios= $comentarios->eliminarComentario();
           return $comentarios;
        }
       // header("Location:" . base_url);
    }

    public function showError() {
        echo "<h1>La pagina no existe</h1>";
    }

}
