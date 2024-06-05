@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit student
                    </div>
                    <div class="float-end">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="dni" class="col-md-4 col-form-label text-md-end text-start">dni</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                    id="dni" name="dni" value="{{ $student->dni }}" required>
                                @if ($errors->has('dni'))
                                    <span class="text-danger">{{ $errors->first('dni') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $student->name }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-end text-start">surname</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                    id="surname" name="surname" value="{{ $student->surname }}" required>
                                @if ($errors->has('surname'))
                                    <span class="text-danger">{{ $errors->first('surname') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="group" class="col-md-4 col-form-label text-md-end text-start">Group</label>
                            <div class="col-md-6">
                                <select class="form-control @error('group') is-invalid @enderror" id="group" name="group" required>
                                    <option value="A" {{ $student->group == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $student->group == 'B' ? 'selected' : '' }}>B</option>
                                </select>
                                @if ($errors->has('group'))
                                    <span class="text-danger">{{ $errors->first('group') }}</span>
                                @endif
                            </div>
                        </div>   

                        <div class="mb-3 row">
                            <label for="academic_year" class="col-md-4 col-form-label text-md-end text-start">Academic Year</label>
                            <div class="col-md-6">
                                <select class="form-control @error('academic_year') is-invalid @enderror" id="academic_year" name="academic_year" required>
                                    <option value="1" {{ $student->academic_year == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $student->academic_year == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $student->academic_year == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $student->academic_year == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $student->academic_year == 5 ? 'selected' : '' }}>5</option>
                                </select>
                                @if ($errors->has('academic_year'))
                                    <span class="text-danger">{{ $errors->first('academic_year') }}</span>
                                @endif
                            </div>
                        </div>                        

                        <div class="mb-3 row">
                            <label for="birth" class="col-md-4 col-form-label text-md-end text-start">Birth</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('birth') is-invalid @enderror" id="birth" name="birth" value="{{ old('birth', $student->birth) }}" required>
                                @if ($errors->has('birth'))
                                    <span class="text-danger">{{ $errors->first('birth') }}</span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
