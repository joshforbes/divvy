<div class="comments">
    @foreach($comments as $comment)

        @include('comments.partials.comment')
        @include('comments.partials.edit-comment-modal')

    @endforeach
</div>

