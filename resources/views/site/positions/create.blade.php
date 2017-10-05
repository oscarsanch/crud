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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['route' => 'positions.store', 'class'=>'well bs-component form-horizontal']) !!}
                    <fieldset>
                        <legend>Создание данных Positions</legend>
                        <div class="form-group">
                            <label for="inputPosition" class="col-lg-2 control-label">Position</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputPosition" placeholder="Enter Position" name="position"  value="{{ old('position') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">Execute</button>
                            </div>
                        </div>
                    </fieldset>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection