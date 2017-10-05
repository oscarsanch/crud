@extends('site.layouts.app')
@section('content')
<div class="container" style="background-color: #FFFFFF; border-radius: 15px;">
    <div class="row">
        <div class="text-center">
            <h1>Application Owl</h1>
            <h4>Тестовое приложение для освоения навыков по созданию RESTful прииложения</h4>
            <br>
            <p>В качестве дополнения была применена Nested sets технология.<br>
                С помощью которой осуществляется сохранение и вывод информации о компании.
            </p>
            <a href="{{ route('about') }}" class="btn btn-success">Узнать больше</a>
        </div>
    </div>
</div>
@endsection
