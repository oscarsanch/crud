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
                    @if(isset($managers))
                        @foreach($managers as $manager)
                            <tr>
                                <td class="text-right"><label class="label label-default">id:</label></td>
                                <td class="info">{{ $manager->id }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">name:</label></td>
                                <td class="info">{{ $manager->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">surname:</label></td>
                                <td class="info">{{ $manager->surname }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><label class="label label-default">position:</label></td>
                                <td class="info">{{ $manager->position->position_name }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection