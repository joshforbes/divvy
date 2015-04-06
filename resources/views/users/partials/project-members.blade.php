<div class="members">
    <div class="members__header">
        <div class="members__title">Project Members</div>
    </div>
    <button class="members__settings-button"><i class="fa fa-gear"></i></button>

    <div class="members__settings-overlay hide">
        <button class="members__settings-close"><i class="fa fa-times"></i></button>
        <div class="members__settings">
            <button class="members__setting" data-toggle="modal" data-target=".members-edit">
                <i class="fa fa-file-o"></i>Edit Members
            </button>
        </div>
    </div>

    @include('users.partials.project-members-edit')

    <div class="members__body-wrapper">
        @include('users.partials.project-members-body')
    </div>

</div>