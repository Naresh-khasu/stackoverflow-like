@extends('layouts.app')
@section('title', 'Questions')
@push('styles')
    <link href="{{ asset('startbootstrap/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Question List</h1>
                    <a href="{{ route('question.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-plus fa-sm text-white-50"></i> Add New Question</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Asked Date</th>
                                <th>View Count</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Question</th>
                                <th>Asked Date</th>
                                <th>Active Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{!! $question->question !!}</td>
                                    <td>{{ $question->created_at->diffForHumans() }}</td>
                                    <td>{{ $question->view_count }}</td>
                                    <td><a href="{{route('question.edit',$question->id)}}">edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('startbootstrap/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
