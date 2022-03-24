@extends('layouts.app')
@section('title', 'Questions')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Add Question</h1>
                                <a href="{{ route('question.index') }}"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                        class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                            </div>
                            @if ($question->id)
                                <form class="user" method="POST" action="{{ route('question.update',$question->id) }}">
                                    @method('PUT')
                                @else
                                    <form class="user" method="POST" action="{{ route('question.store') }}">
                            @endif
                            @csrf
                            <div class="form-group row">
                                <label for="question" class="col-md-12 text-center">Your Question</label>
                                <div class="col-sm-12 mb-3 mb-sm-0">

                                    <textarea name="question" id="" cols="30" rows="10"
                                        class="form-control form-control-user summernote">{{ $question->question }}</textarea>
                                </div>
                                @error('question')
                                    <span class="text-danger" for="question">{{ $message }}</span>
                                @enderror
                            </div>


                            <button class="btn btn-primary btn-user btn-block" type="submit">Submit Question</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush
