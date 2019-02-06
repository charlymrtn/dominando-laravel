<!-- Modal -->
<div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagModalTitle">Agregar etiqueta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('etiquetas.attach',isset($mensaje) ? $mensaje->id : $usuario->id)}}" method="post">
                @csrf
                <input type="hidden" name="model" id="model" value="{{isset($mensaje)?'mensajes':'users'}}">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="InputSelect1">Nota</label>
                        <select name="tag" id="tag" class="form-control">
                            <option value="" disabled>selecciona una etiqueta</option>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Etiqueta</button>
                </div>
            </form>

        </div>
    </div>
</div>
