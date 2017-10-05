@extends('site.layouts.app')
@section('content')
<div class="container">
    <div class="bs-docs-section">
        <div class="row">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <h2>Все сотрудники нашей компании</h2>
                <a href="{{ route('employees.create') }}" class="btn btn-success">Создать нового сотрудника</a>
            <hr>
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Position</th>
                    <th>Manager</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($employees))
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->surname }}</td>
                            <td>{{ $employee->position->position_name }}</td>
                            @if(empty($employee->manager->name))
                                <td> Самый главный</td>
                            @else
                            <td>{{ $employee->manager->name.' '.$employee->manager->surname.' ('.$employee->manager->position->position_name.')' }}</td>
                            @endif
                            <td>
                                {!! Form::open(['route' => ['employees.destroy', $employee->id]]) !!}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('employees.show',[$employee->id]) }}" class="btn btn-primary btn-sm" title="View" aria-label="View">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                                <a href="{{ route('employees.edit',[$employee->id]) }}" class="btn btn-primary btn-sm"  title="Update" aria-label="Update">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <button class="btn btn-danger btn-sm" id='delete' onclick="return confirmDelete();" title="Delete" aria-label="Delete">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                                {!! Form::close() !!}
                                <script>
                                    function confirmDelete() {
                                        if (confirm("Вы подтверждаете удаление?")) {
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row">

            {{ $employees->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
