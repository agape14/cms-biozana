<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-puzzle-piece"></i> Cantidades</h1>
    </div>
</div>
<!--<button class="btn btn-primary mb-2" onclick="frmContadores()"><i class="fa fa-plus"></i></button>-->
<div class="tile">
    <div class="tile-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped mt-4" id="tblCantidades">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Botellas<br>Vendidas</th>
                        <th>Clientes<br>Satisfechos</th>
                        <th>Fecha<br>Actualizacion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="editarCantidades" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Cantidades</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmContadores">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-none">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="botellas_1litro">Botellas vendidas</label>
                                <input id="botellas_1litro" class="form-control" type="text" name="botellas_1litro" required placeholder="botellas 1litro">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="clientes_satisfechos">Clientes Satisfechos</label>
                                <input id="clientes_satisfechos" class="form-control" type="text" name="clientes_satisfechos" required placeholder="clientes satisfechos">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarCantidades(event)" id="btnAccion">Registrar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Atras</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>