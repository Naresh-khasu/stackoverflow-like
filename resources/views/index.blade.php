@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$heading}}</h1>

        </div>

        <div class="row">
            @foreach ($top_questions as $question)
            <div class="col-lg-12">

                <div class="card mb-4 py-3 border-left-primary">
                    <div class="card-body">
                        <h5><a href="{{route('questionDetail',['id'=>$question->id,'slug' => $question->slug])}}">{{$question->title}}</a></h5>
                        @foreach ($question->questionHasTags as $tag)
                        <span class="badge badge-info">#{{$tag->title}}</span>
                        @endforeach
                        asked <em>{{$question->created_at->diffForHumans()}}</em> by <strong>{{$question->user->name}}</strong>
                    </div>
                </div>
            </div>
            @endforeach


        </div>





    </div>
    <!-- /.container-fluid -->



@endsection
