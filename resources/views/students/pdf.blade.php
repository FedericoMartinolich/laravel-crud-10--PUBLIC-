<!DOCTYPE html>
<html>
<head>
    <title>Student Information PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Student Information</h1>
    <table>
        <tr>
            <th>DNI:</th>
            <td>{{ $student->dni }}</td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>Surname:</th>
            <td>{{ $student->surname }}</td>
        </tr>
        {{-- <tr>
            <th>ID:</th>
            <td>{{ $student->id }}</td>
        </tr>
        <tr>
            <th>Birth:</th>
            <td>{{ date("d-m-y", strtotime($student->birth)) }}</td>
        </tr> --}}
        <tr>
            <th>Assists:</th>
            <td>{{ $student->assists->count() }}</td>
        </tr>
        <tr>
            <th>Condition:</th>
            <td>{{ $condition }}</td>
        </tr>
    </table>
</body>
</html>
