<!-- Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalTitle">Agregar nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('notas.store',isset($mensaje) ? $mensaje->id : $usuario->id)}}" method="post">
                @csrf
                <input type="hidden" name="model" id="model" value="{{isset($mensaje)?'mensajes':'users'}}">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nota</label>
                        <input type="text" class="form-control" id="exampleInputText" name="body" aria-describedby="textHelp" placeholder="Agrega una nota">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Nota</button>
                </div>
            </form>

        </div>
    </div>
</div>
