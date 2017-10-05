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

            <h2>Все должности нашей компании</h2>
                <a href="{{ route('positions.create') }}" class="btn btn-success">Создать новую должность</a>
            <hr>
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Position</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($positions))
                    @foreach($positions as $position)
                        <tr>
                            <td>{{ $position->id }}</td>
                            <td>{{ $position->position_name }}</td>
                            <td>
                                {!! Form::open(['route' => ['positions.destroy', $position->id]]) !!}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('positions.show',[$position->id]) }}" class="btn btn-primary btn-sm" title="View" aria-label="View">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                                <a href="{{ route('positions.edit',[$position->id]) }}" class="btn btn-primary btn-sm"  title="Update" aria-label="Update">
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

            {{ $positions->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
