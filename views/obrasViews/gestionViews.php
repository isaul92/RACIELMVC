
<div class="container">
    <h1 class="display-4">Gestion de Obras Arquitectonicas</h1>
    <hr>

    <div class="d-flex">


        <form id="buscarObra" method="POST">
            <div class="radiogp btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <label class="btn btn-outline-warning active" id="idObra">
                    <input type="radio" name="options" value="idBuscarObra" id="idBuscarObra" autocomplete="off" checked> ID
                </label>
                <label class="btn btn-outline-warning" id="nombreBuscar">
                    <input type="radio" name="options" value="nombreBuscarObra" id="nombreBuscarObra" autocomplete="off"> Nombre
                </label>
                <label class="btn btn-outline-warning" id="fechaBuscar">
                    <input type="radio" name="options" value="fechaBuscarObra" id="fechaBuscarObra" autocomplete="off"> Fecha
                </label>
            </div>
            <input style="display:none" class="form-control" type="text" id="datepicker" placeholder="Fecha">
            <input    type="hidden" name="idUser" id="idUser" value="<?= $_SESSION["identity"]->id ?>">
            <div class="d-flex ">
                <div class="col-8">
                    <input class="form-control "   type="text" name="buscadorObraInput" id="inputBuscarObraId" placeholder="Buscar una obra">
                </div>
                <div class="col-4">

                    <input type="submit" class="btn btn-outline-success" value="Buscar">
                </div>

            </div>
        </form>
        <div class="col-4">

  <a href="<?= base_url ?>obrasArquitecto/gestion"  class="mb-4 btn btn-outline-success"> Mostrar todos </a>
            <a href="<?= base_url ?>obrasArquitecto/crear" class="mb-4 btn btn-outline-success">Crear Obra</a>
        </div>
        <div>

        </div>

    </div>

    <div class="" id="buscadorObras">

    </div>

    <div class='row  grupoDeCards'>

        <div class='col-12  mb-4 d-flex justify-content-center flex-wrap sombra' id='grupoDeCards'>
            <?php while ($obr = $obras->fetch_object()): ?> 
                <div class='card col-lg-3 col-sm-6 m-1'>
                    <div class='card-header fondoBlanco '>
                        <div class='d-flex justify-content-end'>
                            <a href="<?= base_url ?>obrasArquitecto/eliminar&id=<?= $obr->id; ?>" class='btn btn-outline-danger m-1 justify-content-end'>Eliminar</a>
                            <a href="<?= base_url ?>obrasArquitecto/editar&id=<?= $obr->id; ?>" class='btn btn-outline-warning m-1 justify-content-end'>Editar</a></div>
                        <strong> <label>Titulo : <label><?= $obr->nombre; ?> </label> </label></strong>
                    </div>
                    <div class='card-body'>

                        <div class='container-avatar mt-1 '>
                            <img class='img-fluid ' style='width: 80px;height: 80px;' src='<?= base_url ?>uploads/images/<?= $obr->imagen ?>'>
                        </div>
                        <div class='description mt-4'>
                            <span class='date m-2 p-2'>
                                <strong> Creado el <?= $obr->fecha ?></strong>
                            </span>
                            <br>
                          <strong><span class='date m-2 p-2'><?=FormatTime::imprimirTiempo($obr->fecha)?></span></strong>
                            <p class='p-3 text-justify '><?= $obr->descripcion ?></p>                        
                        </div>



                    </div> 
                </div>
            <?php endwhile; ?>
            <?php $pagination->render(); ?>
        </div>  