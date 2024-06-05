@extends('students.layouts')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>logCrud Information</h5>
                <div>
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm me-2">
                        &larr; Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                @foreach ($logsCrud as $logCrud)
                <table class="table table-bordered">
                    <tbody>
                    
                        <tr>
                            <th scope="row">User ID</th>
                            <td>{{ $logCrud->user_id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Action</th>
                            <td>{{ $logCrud->action }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ip</th>
                            <td>{{ $logCrud->ip }}</td>
                        </tr>
                        <tr>
                            <th scope="row">browser</th>
                            <td>{{ $logCrud->browser }}</td>
                        </tr>
                        <tr>
                            <th scope="row">date</th>
                            <td>{{ date("d-m-y", strtotime($logCrud->date)) }}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
