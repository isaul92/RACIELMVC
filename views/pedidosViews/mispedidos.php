<div class="container">
    <div class="row">
        <div class="col-12 m-4 p-2 ">
            <?php if (!isset($gestion)): ?>
                <h1 class="display-4 text-center mb-3">Mis pedidos</h1>



            <?php else: ?>
                <h1 class="display-4 text-center mb-3">Gestionar pedidos</h1>



            <?php endif; ?>
            <hr>
          
            <table class="table  table-striped table-responsive table-hover d-flex justify-content-center">
                <tr>
                    <th>No Pedido</th>
                    <th>Coste</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
                <?php while ($ped = $pedidos->fetch_object()): ?>
                    <tr>
                        <td><a href="<?= base_url ?>pedidos/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a> </td>
                        <td><a href="<?= base_url ?>pedidos/detalle&id=<?= $ped->id ?>"><?= $ped->coste ?></a></td>
                        <td><a href="<?= base_url ?>pedidos/detalle&id=<?= $ped->id ?>"><?= $ped->fecha ?></a></td> 
                        <td><a href="<?= base_url ?>pedidos/detalle&id=<?= $ped->id ?>"><?= utilidades::showStatus($ped->estado) ?></td> 
                    </tr>


                <?php endwhile; ?>
            </table>
        </div></div></div>