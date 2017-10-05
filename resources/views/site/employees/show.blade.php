@extends('site.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="well table table-bordered">
                    <thead>
                        <tr class="success">
                            <th class="col-xs-1">Поля</th>
                            <th>Значения</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($employees))
                        @foreach($employees as $employee)
                            <tr>
                                <td class="text-right"><label class="label label-default">id:</label></td>
                                <td class="info">{{ $employee->id }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">name:</label></td>
                                <td class="info">{{ $employee->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">surname:</label></td>
                                <td class="info">{{ $employee->surname }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">position:</label></td>
                                <td class="info">{{ $employee->position->position_name }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">manager:</label></td>
                                @if(empty($employee->manager->name))
                                    <td class="info"> Самый главный</td>
                                @else
                                    <td class="info">{{ $employee->manager->name.' '.$employee->manager->surname.' ('.$employee->manager->position->position_name.')' }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection