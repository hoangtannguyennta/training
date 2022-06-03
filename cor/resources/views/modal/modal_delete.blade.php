<div class="modal-delete">
    <div class="modal-delete-content">
        <h2>{{ __('Delete') }}</h2>
        <form action="" class="form-modal-delete" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
            <button class="button modal-pubs-delete" type="submit"><i class="fa fa-trash-o"></i></button>
            <span class="modal-close button">&times;</span>
        </form>
    </div>
</div>

