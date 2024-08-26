<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-comments"></i> Testimonios</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" onclick="frmTestimonios()"><i class="fa fa-plus"></i></button>
<div class="tile">
    <div class="tile-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped mt-4" id="tblTestimonios">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Cargo<br>Entidad</th>
                        <th>Fecha<br>Creacion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="addeditTestimonios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Testimonios</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmTestimonios">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-none">
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombres Completos</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" required placeholder="Nombres Completos">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="detalle">Detalle Testimonio</label>
                                <!--<input id="detalle" class="form-control" type="text" name="detalle" required placeholder="Detalle Testimonio">-->
                                <textarea class="form-control" id="detalle" name="detalle" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cargo_entidad">Cargo / Entidad</label>
                                <input id="cargo_entidad" class="form-control" type="text" name="cargo_entidad" required placeholder="Cargo / Entidad">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarTestimonios(event)" id="btnAccion">Registrar</button>
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