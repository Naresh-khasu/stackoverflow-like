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
                                    {{ $comment->user->name }}
                                    <span
                                        class="text-muted float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                </span>
                                <p>{!! $comment->comment !!}</p>
                            </div>

                        </div>
                    @endforeach


                </div>

                <div class="card-footer">
                    <form action="#" method="post">
                        <div class="img-push">
                            <input type="text" class="form-control form-control-sm" placeholder="You can add your comment"
                                id="comment">
                            <button class="btn btn-primary mt-2" id="postComment">Add Comment</button>
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
                comment = $('#comment').val();
                question_id = "{{ $question->id }}";
                axios.post("{{ route('postComment') }}", {
                        'comment': comment,
                        'question_id': question_id,
                        _token: "{{ csrf_token() }}",
                    })
                    .then(function(response) {


                        $('#commentlist').html(response.data);
                    })
                    .catch(function(error) {
                        // toastr.error('error!', 'Error Occour')
                    });
            });
        });

        function comments(products) {
                document.getElementById("itemId").innerHTML = '<option value="">--Select an item--</option>' +
                products.reduce((tmp, x) =>
                        `${tmp}<option value='${x.id}'>${x.product_name}</option>`, '');
            }
    </script>
@endpush
