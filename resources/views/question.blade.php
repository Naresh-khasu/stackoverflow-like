@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="container-fluid">

        <div class="col-md-12">

            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <span class="username"><em>{{ @$question->user->name }}</em></span>
                        <span class="description">Asked - <em>{{ $question->created_at->diffForHumans() }}</em></span>
                    </div>



                </div>

                <div class="card-body">

                    <h5><strong>{{ @$question->title }}</strong></h5>
                    <p>{!! $question->description !!}</p>

                    @foreach ($question->questionHasTags as $tag)
                        <span class="badge badge-info">#{{ $tag->title }}</span>
                    @endforeach
                    <span class="float-right text-muted">{{ $question->view_count }} views -
                        {{ $comments->count() }} comments</span>
                </div>

                <div class="card-footer card-comments" id="commentlist">
                    @foreach ($comments as $comment)
                        <div class="card-comment">

                            <div class="comment-text">
                                <span class="username">
                                    <em>{{ $comment->user->name }}</em>
                                    <span
                                        class="text-muted float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                </span>
                                <div>
                                    @auth
                                    <a href="" onclick="event.preventDefault(); upvote({{$comment->id}})"><i class="fas fa-arrow-up" ></i></a>
                                    @endauth
                                    <span class="badge badge-info">{{$comment->up_vote}} <em>upvotes</em></span>

                                    <span>{!! $comment->comment !!}</span>
                                    @auth
                                        @if (\Auth::id() == $comment->user_id)
                                            <span class="text-muted float-right"><a href="" onclick="event.preventDefault(); editForm({{$comment->id}})"> Edit
                                                    Comment</a></span>
                                        @endif
                                    @endauth
                                </div>

                            </div>
                            <form action="#" method="post" id="edit-form-{{$comment->id}}" style="display: none;">
                                <div class="img-push">
                                    <label for="comment"> Edit Your Answer</label>
                                    <textarea name="description" cols="30" class="form-control form-control-user"
                                        id="edit-comment-{{$comment->id}}" ></textarea>
                                    <button class="btn btn-primary mt-2" id="editComment-{{$comment->id}}" onclick="event.preventDefault(); updateComment({{$comment->id}})">Update Comment</button>
                                </div>
                            </form>

                        </div>
                        <hr>
                    @endforeach


                </div>

                <div class="card-footer">
                    <form action="#" method="post" id="comment-form">
                        <div class="img-push">
                            <label for="comment"> Submit Your Answer</label>
                            <textarea name="description" cols="30" rows="10" class="form-control form-control-user summernote"
                                id="comment"></textarea>
                            <button class="btn btn-primary mt-2" id="postComment"
                                {{ \Auth::check() ? '' : 'disabled' }}>Add
                                Comment</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on("click", "#postComment", function(e) {
                e.preventDefault()
                comment = $('textarea#comment').val();
                question_id = "{{ $question->id }}";
                if (!comment) {
                    toastr.error('Comment cannot be empty')
                    return null;
                }
                axios.post("{{ route('postComment') }}", {
                        'comment': comment,
                        'question_id': question_id,
                        _token: "{{ csrf_token() }}",
                    })
                    .then(function(response) {

                        $('#comment-form').trigger("reset");
                        $('#commentlist').html(response.data);
                    })
                    .catch(function(error) {
                        console.log(error.message);
                    });
            });
        });
    </script>
    <script>
        function editForm(id) {
            console.log("edit-form-"+id);
            var x = document.getElementById("edit-form-"+id);

            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    <script>
         function updateComment(id) {
             console.log(id);
                comment = $('textarea#edit-comment-'+id).val();
                console.log(comment);
                question_id = "{{ $question->id }}";
                if (!comment) {
                    toastr.error('Comment cannot be empty')
                    return null;
                }
                axios.post("{{ route('updateComment') }}", {
                        'comment': comment,
                        'question_id': question_id,
                        'comment_id': id,
                        _token: "{{ csrf_token() }}",
                    })
                    .then(function(response) {

                        $('#edit-form'+id).trigger("reset");
                        $('#commentlist').html(response.data);
                    })
                    .catch(function(error) {
                        console.log(error.message);
                    });
        };
    </script>
     <script>
        function upvote(id) {
            console.log(id);

               axios.post("{{ route('upvote') }}", {
                       'comment_id': id,
                       'question_id': "{{ $question->id }}",
                       _token: "{{ csrf_token() }}",
                   })
                   .then(function(response) {

                       $('#commentlist').html(response.data);
                   })
                   .catch(function(error) {
                       console.log(error.message);
                   });
       };
   </script>
@endpush
