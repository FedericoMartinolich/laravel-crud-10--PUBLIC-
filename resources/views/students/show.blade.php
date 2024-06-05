@extends('students.layouts')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Student Information</h5>
                <div>
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm me-2">
                        &larr; Back
                    </a>
                    <form action="{{ route('students.downloadPDF', $student->id) }}" method="get" class="d-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-file-earmark-pdf"></i> Download PDF
                        </button>
                    </form>
                    <a href="{{ route('students.downloadExcel', $student->id) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-file-earmark-excel"></i> Download Excel
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">DNI</th>
                            <td>{{ $student->dni }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Surname</th>
                            <td>{{ $student->surname }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ID</th>
                            <td>{{ $student->id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Birth</th>
                            <td>{{ date("d-m-y", strtotime($student->birth)) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Assists</th>
                            <td>{{ $student->assists->count() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Condition</th>
                            <td>{{ $condition }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <form action="{{ route('assist.store', $student->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $student->id }}">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-journal-text"></i> Add Assist
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
