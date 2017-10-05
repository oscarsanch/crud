@extends('site.layouts.app')
@section('content')
<div class="container" style="background-color: #FFFFFF; border-radius: 15px;">
    <div class="row">

            @if($employees)
                <ul class="list-group">
                    @include('site.tree',['employees' => $employees])
                </ul>
            @endif

    </div>
</div>
@endsection
