
<?php
if (isset($pro)) :
    ?>
<?php
if ($pro->status=="AC") :
    ?>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-5 col-xs-6 text-center mt-4 ">
            <div class="col-10  mt-2">
            <img class="img-fluid rounded sombra " src="<?= base_url ?>/uploads/images/<?= $pro->imagen ?>">
            <hr>
</div>
            
                 <?php $first=1;    if (!empty($imagenesGrupo)): ?>
            <div class="col-12  mt-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner d-flex align-content-center">
                        
                  
<?php while($img= $imagenesGrupo->fetch_object()): ?>      
       <div class="carousel-item <?php if ($first==1){ echo "active"; } $first++;   ?>">
       <img class=" sombra img-fluid" src="<?= base_url ?>/uploads/images/<?= $img->nombreImagen ?>">
    </div>
      
      <?php endwhile; ?>
                     
                        
                        
                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
             <?php endif; ?>  
        </div>





        <div class="col-md-6  col-xs-12 p-4 border m-4">
            <h2 class="mb-3 display-4 "><?= $pro->nombre ?></h2>
            <hr>

            <h1 class="precioCard my-4"><?= empty($pro->precionConDescuento) ? "" : "$" . $número_formato_inglés = number_format($pro->precionConDescuento); ?></h1>

            <h1 class="precioCard my-4"><?=
                empty($pro->precionConDescuento) ? "$" . $número_formato_inglés = number_format($pro->precio) :
                        "<small><strike class='text-muted'> $" .
                        $número_formato_inglés = number_format($pro->precio) . " </strike><small>"
                ?></h1>
            <?php if ($pro->stock < 1) : ?>
                <h4><a href="#" class="badge badge-danger mb-4">No disponible</a></h4>
    <?php else : ?>
                <a href="<?= base_url ?>carrito/add&id=<?= $pro->id ?>" class="btn btn-warning  mb-4">AGREGAR AL CARRO</a>
            
    <?php endif; ?>
            <h4>Descripcion</h4>
            <p class="lead mb-4"><?= $pro->descripcion ?></p>
            <h4>Dimensiones</h4>
            <p class="lead mb-4"><?= $pro->dimensiones ?></p>
        
        <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your share button code -->
  <div class="fb-share-button" 
    data-href="http://racielarquitectos.mx/" 
    data-layout="button_count">
  </div>
        </div>
        
        
    </div>
<?php else: ?>
    <h1>No existe el producto</h1>
<?php endif; ?>
<?php else : ?>
    <h1>No existe el producto</h1>
<?php endif; ?>
