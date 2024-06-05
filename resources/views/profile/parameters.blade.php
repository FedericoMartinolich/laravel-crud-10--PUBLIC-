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
                        Edit parameters
                    </div>
                    <div class="float-end">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('parameters.update', $parameter->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="classes" class="col-md-4 col-form-label text-md-end text-start">Classes</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('classes') is-invalid @enderror"
                                    id="classes" name="classes" value="{{ $parameter->classes }}" required>
                                @if ($errors->has('classes'))
                                    <span class="text-danger">{{ $errors->first('classes') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="promotion" class="col-md-4 col-form-label text-md-end text-start">Promotion</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('promotion') is-invalid @enderror"
                                    id="promotion" name="promotion" value="{{ $parameter->promotion }}" required>
                                @if ($errors->has('promotion'))
                                    <span class="text-danger">{{ $errors->first('promotion') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="regular" class="col-md-4 col-form-label text-md-end text-start">Regular</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('regular') is-invalid @enderror"
                                    id="regular" name="regular" value="{{ $parameter->regular }}" required>
                                @if ($errors->has('regular'))
                                    <span class="text-danger">{{ $errors->first('regular') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="free" class="col-md-4 col-form-label text-md-end text-start">Free</label>
                            <div class="col-md-6">
                                <input type="text" step="0.01"
                                    class="form-control @error('free') is-invalid @enderror" id="free" name="free"
                                    value="{{ $parameter->free }}" required>
                                @if ($errors->has('free'))
                                    <span class="text-danger">{{ $errors->first('free') }}</span>
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
