@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Achievements</h1>

        </div>

        <div class="row">
            @foreach ($achievements as $achievement)
           
            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card mb-4 py-3 border-left-primary">
                    <div class="card-body">
                        <span><i class="fas fa-check"></i> {{$achievement->title}}</span>
                        <span class="float-right"> {{$achievement->created_at->diffForhumans()}}</span>
                    </div>
                </div>
            </div>
            @endforeach


        </div>





    </div>
    <!-- /.container-fluid -->



@endsection
