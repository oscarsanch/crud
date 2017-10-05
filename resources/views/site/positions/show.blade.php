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
                    @if(isset($position))
                            <tr>
                                <td class="text-right"><label class="label label-default">id:</label></td>
                                <td class="info">{{ $position->id }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">position_name:</label></td>
                                <td class="info">{{ $position->position_name }}</td>
                            </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection