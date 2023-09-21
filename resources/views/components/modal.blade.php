<div class="modal fade" id="modal" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger ">
                <h1 class="modal-title fs-5 text-white" id="ModalLabel">
                    {{ $title }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left m-3">
                {{ $body }}
                ¿Estás seguro de que deseas eliminar el elemento con ID: {{ $id }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="form" data-bs-target="#{{ $form }}" id="confirmarBorrar"
                    onclick="event.preventDefault(); document.getElementById('{{ $form }}').submit();">
                    {{ $button }}
                </button>
                <form id="{{ $form }}" action="{{ $route }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>
