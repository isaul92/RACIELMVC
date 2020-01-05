<div class=" row  d-flex p-lg-4 mt-lg-4 justify-content-around">

    <div class=" col-lg-6 col-sm-12 d-flex justify-content-around">
        <div class=" col-lg-9 col-sm-12 col-md-10 ">
            <h2 class="mb-4 text-center">Novedades</h2>
            <?php while ($noticia = $noticias->fetch_object()): ?> 
                <div class="card pub_image">
                    <div class="card-body">
                        <div class="image-container mb-2 mt-0">
                            <img src="<?= base_url ?>uploads/images/<?= $noticia->nombreImagen ?>" alt="" class=" sombra card-image-top img-fluid ">
                        </div>

                        <div class="description mt-4">
                            <span class="date m-2 p-2"><?= FormatTime::imprimirTiempo($noticia->created_at) ?>
                            </span>
                            <p class="p-3 text-justify "><?= $noticia->texto ?></p>                        
                        </div>



                        <div class = "comments  ">
                            <?php $id = $noticia->id ?>
                            <button   onclick="javascript:oculta('item<?= $noticia->id ?>')"
                                      class = "btn btn-sm btn-outline-warning mb-2 btn-comments" >Comentarios(<?= utilidades::countCommentsNews($noticia->id ) ?>) </button>
                            <div class="invisible" id="item<?= $id ?>" style="display: none;">
                                <?php if (isset($_SESSION["identity"]->id)): ?>



                                    <form id="comentarios<?= $id ?>">
                                        <input type="hidden" id="id_user" name="id_user" value="<?= $_SESSION["identity"]->id ?>">
                                        <input type="hidden" name="id_noticia" id="id_noticia" value="<?= $id ?>">
                                        <input type="hidden" name="elemento" id="elemento" value="<?= $id ?>">
                                        <input type="hidden" name="elemento" id="elemento" value="comentarios<?= $id ?>">
                                        <input type="hidden" name="noticiaid" id="noticia<?php $id = $noticia->id ?>"  value="comentarios<?= $id ?>">
                                        <p>
                                            <textarea  onchange="validar(event)"  required="required" class="form-control" id="comentario<?= $id ?>" name="comentario" ></textarea>
                                            <span class='invalid-feedback' role='alert'>
                                                <strong>¡No ha escrito nada!</strong>
                                            </span>
                                        </p>  
                                        <button  class="btn btn-outline-success submitComent " id="botonGuardar" name="comentarios<?= $id ?>" type="submit" >Comentar</button>
                                    <?php else: ?>            
                                        <p>Identificate para comentar</p>
                                    <?php endif; ?>
                                </form>



                                <?php $comments = utilidades::getComments($noticia->id) ?>

                                <div class=" comentarios<?= $id ?>">  </div>



                                <?php while ($comment = $comments->fetch_object()): ?> 

                                    <div class="comments m-0 p-0 row  detailcomment divComentarioEliminar<?= $comment->id; ?>"> 
                                        <div class="col-12 d-flex justify-content-between "> 

                                            <p><small><?= $comment->nombre; ?> | <?= FormatTime::imprimirTiempo($comment->created_at); ?></small></p>
                                            <?php if (isset($_SESSION["identity"]->id)): ?>
                                                <?php if ($comment->id_user == $_SESSION["identity"]->id): ?> 

                                                    <form class="idComment<?= $comment->id; ?>">
                                                        <input type="hidden" name="idComentario" value="<?= $comment->id; ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger eliminarCommentario" name="<?= $comment->id; ?>">Eliminar</button></form>
                                                <?php endif; ?>
                                                <?php endif; ?>  </div>

                                        <div class="col-12 "> 
                                            <p style="background:white!important;"><?= $comment->content; ?></p>  
                                        </div>   

                                    </div> 
                                <hr>

                                <?php endwhile; ?>
                                <div class='cleafix'></div>



                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php $pagination->render(); ?>
        </div>
    </div>


    <div class=" col-lg-6 col-sm-12  ">
        <h2 class=" mb-4 text-center">Nuestros trabajos</h2>
        <div class="card-columns">
            <?php while ($pro = $productos->fetch_object()): ?>


                <div class="card card-index m-2 border-1  ">
                    <?php if ($pro->imagen != null): ?>
                        <a  class="" href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>"> <img  src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="" class="sombra card-image-top img-fluid">
                        <?php else: ?>

                        <?php endif; ?>
                        </div>
                    <?php endwhile; ?>


                    <?php while ($obra = $obras->fetch_object()): ?>
                        <div class="card card-index m-2 border-1  ">
                            <?php if ($obra->imagen != null): ?>
                                <a  class="" href="<?= base_url ?>obrasArquitecto/ver&id=<?= $obra->id ?>"><img class="sombra card-image-top img-fluid" src="<?= base_url ?>uploads/images/<?= $obra->imagen ?>" alt="" class="avatar"/></a>
                                <?php else: ?>

                            <?php endif; ?>
                        </div>



                    <?php endwhile; ?>
            </div>   
        </div>




    </div>


