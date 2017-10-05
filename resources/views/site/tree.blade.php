@foreach($employees as $employee)
    <li class="list-group-item">
        {{ $employee->name.' '.$employee->surname.' ('.$employee->position->position_name.')' }}
        @if($employee->hasChildren())
            <ul>
                @include('site.tree',['employees'=>$employee->children])
            </ul>
        @endif
    </li>
@endforeach