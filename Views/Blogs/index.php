<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-large"></i> Blogs</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" onclick="frmBlogs()"><i class="fa fa-plus"></i></button>
<div class="tile">
    <div class="tile-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped mt-4" id="tblBlogs">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Descripcion</th>
                        <th>Fecha<br>Creacion</th>
                        <th>Etiqueta</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="addeditBlogs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Blogs</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmBlogs" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-none">
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                <input id="titulo" class="form-control" type="text" name="titulo" required placeholder="Titulo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <!--<input id="descripcion" class="form-control" type="text" name="descripcion" required placeholder="Descripcion">-->
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input id="imagen" class="form-control" type="file" name="imagen" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="etiqueta">Etiqueta</label>
                                <input id="etiqueta" class="form-control" type="text" name="etiqueta" required placeholder="Etiqueta">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarBlogs(event)" id="btnAccion">Registrar</button>
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