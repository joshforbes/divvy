<div class="edit-subtask-modal modal fade" id="{{$subtask->id . "-subtask-modal"}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal__header">
                <div class="modal__title">Edit Subtask</div>
                <button class="modal__close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal__body">

                <div class="task-modal-wrapper">

                    @include('subtasks.partials.edit-form')

                </div>

            </div>
        </div>
    </div>
</div>