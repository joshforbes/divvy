<div class="members-edit__add-container">
    {!! Form::open(['data-remote', 'route' => ['project.addUser', $project->id]]) !!}
    <div class="input-group">
        <select name="user" class="members-edit__list" id="usersList" data-placeholder="Add a User to Project">
            <option></option>
            @foreach ( $users as $email => $username )
                <option value="{{$email}}">{{$username}}</option>
            @endforeach
        </select>
        {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
    </div>
    {!! Form::close() !!}
</div>

<div class="members-edit__body">
    @foreach($project->users as $user)
        <div class="members-edit__member">
            <span class="members-edit__member-avatar">
                <a href="{{ route('activity.showProject', [$project->id, $user->username]) }}">
                    {!! $user->profile->present()->avatarHtml('40px') !!}
                </a>
            </span>
            <span class="members-edit__member-name">{{ $user->username }}</span>
            {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['project.removeUser', $project->id, $user->id]]) !!}
            <button class="members-edit__member-delete"><i class="fa fa-trash"></i></button>
            {!! Form::close() !!}
        </div>
    @endforeach
</div>
