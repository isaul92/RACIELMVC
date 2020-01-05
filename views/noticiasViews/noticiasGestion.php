<div class="container">

    <h1 class="text-center display-4">Noticas Gestion</h1>
    <hr>

    <div class="d-flex"> 
        
        <form id="buscarNoticias" method="POST">
        <div class="radiogp btn-group btn-group-toggle mb-2" data-toggle="buttons">
            <label class="btn btn-outline-warning active" id="idNoticia">
                <input type="radio" name="options" value="idBuscarNoticia" id="idBuscarNoticia" autocomplete="off" checked> ID
            </label>
            <label class="btn btn-outline-warning" id="nombreBuscar">
                <input type="radio" name="options" value="nombreBuscarNoticia" id="nombreBuscarNoticia" autocomplete="off"> Nombre
            </label>
            <label class="btn btn-outline-warning" id="fechaBuscar">
                <input type="radio" name="options" value="fechaBuscarProducto" id="fechaBuscarNoticia" autocomplete="off"> Fecha
            </label>
        </div>
        <input style="display:none" class="form-control" type="text" id="datepicker" placeholder="Fecha">
        <input    type="hidden" name="idUser" id="idUser" value="<?=$_SESSION["identity"]->id ?>">
        <input class="form-control mb-4"   type="text" name="buscadorNoticasInput" id="inputBuscarNoticiaId" placeholder="Buscar una noticia">
        <input type="submit" class="btn btn-outline-success" value="Buscar">
    </form>
        <div>
            <a href="<?= base_url ?>noticias/gestion"  class="mb-4 btn btn-outline-success"> Mostrar todos </a>
             <a href="<?= base_url ?>noticias/crearNoticia"  class="mb-4 btn btn-outline-success">Crear noticia</a>
        </div>
       
    </div>
    
   
    
     <div class="" id="buscadorNoticias">

    </div>
    <div class='row  grupoDeCards'>

        <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>
            <?php while ($noticia = $noticias->fetch_object()): ?> 
                <div class='card col-lg-3 col-sm-6 m-1'>
                    <div class='card-header fondoBlanco '>
                        <div class='d-flex justify-content-end'>
                            <a href="noticias/eliminar&id=<?= $noticia->id; ?>" class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>
                            <a href="noticias/editar&id=<?= $noticia->id; ?>" class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>

                        <strong> <label>Titulo : <label><?= $noticia->nombre; ?> </label> </label></strong>
                        <label>Autor  : <label><?= $noticia->autor; ?> </label> </label>

                    </div>
                    <div class='card-body'>

                        <div class='container-avatar '>
                            <img class='img-fluid ' style='width: 80px;height: 80px;' src='<?= base_url ?>uploads/images/<?= $noticia->nombreImagen ?>'>
                        </div>
                        <div class='description mt-4'>
                            <span class='date m-2 p-2'>
                                <strong> Creado el <?= $noticia->created_at ?></strong>
                            </span>
                            <br>
                            <strong><span class='date m-2 p-2'><?= FormatTime::imprimirTiempo($noticia->created_at) ?></span></strong>
                            <p class='p-3 text-justify '><?= $noticia->texto ?></p>                        
                        </div>



                        <div class = 'comments  '>
                            <?php $id = $noticia->id ?>
                            <button   onclick='javascript:oculta("item<?= $noticia->id ?>")'
                                      class = 'btn btn-sm btn-outline-warning mb-2  m-2 btn-comments' >Comentarios(<?= utilidades::countCommentsNews($noticia->id) ?>) </button>
                            <div class='invisible' id='item<?= $id ?>' style='display: none;'>
                                <?php if (isset($_SESSION['admin'])): ?>



                                    <form id='comentarios<?= $id ?>'>
                                        <input type='hidden' id='id_user' name='id_user' value='<?= $_SESSION['identity']->id ?>'>
                                        <input type='hidden' name='id_noticia' id='id_noticia' value='<?= $id ?>'>
                                        <input type='hidden' name='elemento' id='elemento' value='<?= $id ?>'>
                                        <input type='hidden' name='elemento' id='elemento' value='comentarios<?= $id ?>'>
                                        <input type='hidden' name='noticiaid' id='noticia<?php $id = $noticia->id ?>'  value='comentarios<?= $id ?>'>
                                        <p>
                                            <textarea  onchange='validar(event)'  required='required' class='form-control' id='comentario<?= $id ?>' name='comentario' ></textarea>
                                            <span class='invalid-feedback' role='alert'>
                                                <strong>¡No ha escrito nada!</strong>
                                            </span>
                                        </p>  
                                        <button  class='btn btn-outline-success submitComent ' id='botonGuardar' name='comentarios<?= $id ?>' type='submit' >Comentar</button>
                                    <?php else: ?>            
                                        <p>Identificate para comentar</p>
                                    <?php endif; ?>
                                </form>



                                <?php $comments = utilidades::getComments($noticia->id) ?>

                                <div class=' comentarios<?= $id ?>'>  </div>



                                <?php while ($comment = $comments->fetch_object()): ?> 

                                    <div class='comments m-0 p-0 row  detailcomment divComentarioEliminar<?= $comment->id; ?>'> 
                                        <div class='col-12 d-flex justify-content-between '> 

                                            <p><small><?= $comment->nombre; ?> | <?= FormatTime::imprimirTiempo($comment->created_at); ?></small></p>
                                            <?php if (isset($_SESSION['identity']->id)): ?>
                                                <?php if ($comment->id_user == $_SESSION['identity']->id): ?> 

                                                    <form class='idComment<?= $comment->id; ?>'>
                                                        <input type='hidden' name='idComentario' value='<?= $comment->id; ?>'>
                                                        <button type='submit' class='btn btn-sm btn-outline-danger eliminarCommentario' name='<?= $comment->id; ?>'>Eliminar</button></form>
                                                <?php endif; ?>
                                                <?php endif; ?>  </div>

                                        <div class='col-12 '> 
                                            <p style='background:white!important;'><?= $comment->content; ?></p>  
                                        </div>   

                                    </div> 
                                    <hr>

                                <?php endwhile; ?>
                                <div class='clearfix'></div>



                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
              <?php $pagination->render(); ?>
        </div>  
  
    </div>  
    





</div>