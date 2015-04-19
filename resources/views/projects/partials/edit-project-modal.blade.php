<div class="edit-task-modal modal fade" id="{{$project->id . "-modal"}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal__header">
                <div class="modal__title">Edit Project</div>
                <button class="modal__close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal__body">

                <div class="task-modal-wrapper">

                    @include('projects.partials.edit-form')

                </div>

            </div>
        </div>
    </div>
</div>