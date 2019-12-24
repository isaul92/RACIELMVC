<div class="container p-2 ">
    <h1  class="display-4 text-center mb-3">Categorias</h1>
    <hr>



    <table class="table  text-center table-striped table-responsive table-hover d-flex justify-content-center">
        <a href="#" class="btnCategoriaCrear btn btn-outline-warning p-2 m-2"> Crear categoria</a>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>CANTIDAD DE PRODUCTOS</th>
            <th></th>
            <th></th>
        </tr>
        <?php while ($cat = $categorias->fetch_object()): ?>
            <tr>
                <td> <?= $cat->id; ?></td>
                <td> <?= $cat->nombre; ?></td>
                <td> <?= $cat->numeroP; ?></td>
                <td > <a href="#" name="<?= $cat->id; ?>" id="<?= $cat->nombre; ?>" class="editarCategoria btn btn-outline-warning">Editar</a></td>

            </tr>
        <?php endwhile; ?>
    </table>

    <div style="display:none;" class="mt-3 invisible divCrearCategoria">
        <h1 id="tituloCategorias" class="d-flex justify-content-center">Crear Categorias</h1>
        <form id="formCategoria" class="d-flex justify-content-center" action="<?= base_url ?>categoria/save" method="POST">
            <input   class="form-control" id="inputCategoria"  type="text" name="nombre" onchange="validar(event)"  required placeholder="Ingrese nombre de la categoria">
            <input type="hidden" name="idCategoria" id="idCategoria" value="" >
            <input type="submit"   id="btnCrearCat"  class="btnGuardarCategoria btn btn-outline-warning" value="Guardar" disabled>
               </form >
            <a href="#" class="btnCategoriaCrear btn btn-outline-danger p-2 m-2" > Cancelar</a>
     
    </div>
</div>

