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

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <h2>Менеджеры нашей компании</h2>
                    <a href="{{ route('managers.create') }}" class="btn btn-success">Создать нового руководителя</a>
                <hr>
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Position</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if (isset($managers))
                        @foreach($managers as $manager)
                            <tr>
                                <td>{{ $manager->id }}</td>
                                <td>{{ $manager->name }}</td>
                                <td>{{ $manager->surname }}</td>
                                <td>{{ $manager->position->position_name }}</td>
                                <td>
                                    {!! Form::open(['route' => ['managers.destroy', $manager->id]]) !!}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('managers.show',[$manager->id]) }}" class="btn btn-primary btn-sm" title="View" aria-label="View">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <a href="{{ route('managers.edit',[$manager->id]) }}" class="btn btn-primary btn-sm"  title="Update" aria-label="Update">
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

                {{ $managers->links() }}
                @endif

              </div>
        </div>
    </div>
@endsection
