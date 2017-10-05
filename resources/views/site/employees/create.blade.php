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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['route' => 'employees.store', 'class'=>'well bs-component form-horizontal']) !!}
                    <fieldset>
                        <legend>Создание данных Employee</legend>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Enter Name" name="name"  value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSurname1" class="col-lg-2 control-label">Surname</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputSurname" placeholder="Enter Surname" name="surname"  value="{{ old('surname') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Select" class="col-lg-2 control-label">Position</label>
                            <div class="col-lg-10">
                                <select name="position" class="form-control" id="Select">
                                    <option></option>
                                    @if(isset($positions))
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->position_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Select" class="col-lg-2 control-label">Manager</label>
                            <div class="col-lg-10">
                                <select name="manager_id" class="form-control" id="Select">
                                    <option></option>
                                    @if(isset($managers))
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->surname.' '.$manager->name.' ('.$manager->position->position_name.')' }}</option>
                                        @endforeach
                                    @endif
                                </select>
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