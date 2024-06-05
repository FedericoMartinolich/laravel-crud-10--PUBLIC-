@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">Student List</div>
                <div class="card-body">

                    <form action="{{ route('students.filter') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Year and group</span>
                            </div>
                            <select name="academic_year" id="academic_year" class="form-control">
                                <option value="All" {{ session('academic_year', 'All') == 'All' ? 'selected' : '' }}>All</option>
                                <option value="1" {{ session('academic_year', 'All') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ session('academic_year', 'All') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ session('academic_year', 'All') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ session('academic_year', 'All') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ session('academic_year', 'All') == '5' ? 'selected' : '' }}>5</option>
                            </select>
                            <select name="group" id="group" class="form-control">
                                <option value="All" {{ session('group', 'All') == 'All' ? 'selected' : '' }}>All</option>
                                <option value="A" {{ session('group', 'All') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ session('group', 'All') == 'B' ? 'selected' : '' }}>B</option>
                            </select>
                            <button type="submit" class="btn btn-secondary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                    </form>                                                                             

                    <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2"><i
                            class="bi bi-plus-circle"></i> Add New Student</a>

                    <a href="{{ route('assist.menu') }}" class="btn btn-success btn-sm my-2"><i
                        class="bi bi-plus-circle"></i> Add Assist</a>

                    <a href="{{ route('logCrud.show') }}" class="btn btn-success btn-sm my-2"><i
                        class="bi bi-plus-circle"></i> View logCrud</a>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S#</th>
                                <th scope="col">ID</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Name</th>
                                <th scope="col">Academic year</th>
                                <th scope="col">Group</th>
                                <th scope="col">Assists</th>
                                <th scope="col">Birth</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->dni }}</td>
                                    <td>{{ $student->surname }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->academic_year }}</td>
                                    <td>{{ $student->group }}</td>
                                    <td>
                                        @if ($student->assists->count() == 0)
                                            The student has not attended
                                        @else
                                            {{ $student->assists->count() }}
                                        @endif
                                    </td>
                                    <td>
                                        {{-- @dd(date('m-d', strtotime($student->birth))) --}}
                                        @if (date('m-d', strtotime($student->birth)) == now()->format('m-d'))
                                            {{ date('d-m-y', strtotime($student->birth)) }} 🥳
                                        @else
                                            {{ date('d-m-y', strtotime($student->birth))  }}
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('assist.show', $student->id) }}"
                                            class="btn btn-success btn-sm"><i class="bi bi-journal-text"></i> Assists</a>

                                        <a href="{{ route('students.show', $student->id) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Do you want to delete this student?');"><i
                                                    class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No student Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $students->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection