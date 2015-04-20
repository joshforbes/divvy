<div class="add-task-modal modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal__header">
                <div class="modal__title">Add Task</div>
                <button class="modal__close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal__body">

                <div class="add-task-modal-wrapper">

                    @include('tasks.partials.add-form')

                </div>

            </div>
        </div>
    </div>
</div>