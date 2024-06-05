@extends('students.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Assist Information
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="assist" class="col-md-4 col-form-label text-md-end text-start"><strong>assist:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <table>
                                <thead>
                                    <th>Condition</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{{ $condition }}</p>
                                        </td>
                                    </tr>
                                </tbody> 
                                <thead>
                                    <th>Date of assists</th>
                                </thead>
                                <tbody>
                                    @foreach ($assists as $assist)
                                        <tr>
                                            <td>
                                                <p>{{ $assist->assist }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                               
                            </table>
                        </div>
                    </div>

            </div>
        </div>
    </div>    
</div>
    
@endsection