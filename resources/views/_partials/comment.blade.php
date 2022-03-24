<div class="card-footer card-comments">
    @foreach ($comments as $comment)
        <div class="card-comment">

            <div class="comment-text">
                <span class="username">
                    <em>{{ $comment->user->name }}</em>
                    <span class="text-muted float-right">{{ $comment->created_at->diffForHumans() }}</span>
                </span>
                <div>
                    <span>{!! $comment->comment !!}</span>
                    @auth
                        @if (\Auth::id() == $comment->user_id)
                            <span class="text-muted float-right"><a href=""
                                    onclick="event.preventDefault(); editForm({{ $comment->id }})"> Edit
                                    Comment</a></span>
                        @endif
                    @endauth
                </div>

            </div>
            <form action="#" method="post" id="edit-form-{{ $comment->id }}" style="display: none;">
                <div class="img-push">
                    <label for="comment"> Edit Your Answer</label>
                    <textarea name="description" cols="30"class="form-control form-control-user"
                        id="edit-comment-{{ $comment->id }}">{!! $comment->comment !!}</textarea>
                    <button class="btn btn-primary mt-2" id="editComment-{{ $comment->id }}"
                        onclick="event.preventDefault(); updateComment({{ $comment->id }})">Update Comment</button>
                </div>
            </form>

        </div>
        <hr>
    @endforeach


</div>

