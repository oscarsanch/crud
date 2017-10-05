<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Employee;
use App\Manager;
use App\Position;

class EmployeeController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::paginate(4);

        return view('site.employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $positions = Position::all();
        $managers = Manager::all();
        if ($positions->isEmpty()){
            return redirect('positions/create')->with('error', 'Ошибка, в таблице должностей нет ни одной записи!');
        }
        elseif ($managers->isEmpty()){
            return redirect('managers/create')->with('error', 'Ошибка, в таблице руководителей нет ни одной записи!');
        }

        return view('site.employees.create', ['managers' => $managers, 'positions' => $positions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'required' => "Поле :attribute обязательно к заполнению"
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'position' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->surname = $request->surname;
            $employee->position_id = $request->position;

            if (empty($request->manager_id)){
                $employee->makeRoot()->save();

                return redirect()->back()->with('status', 'Новый главный руководитель создан!');
            }

            $employee->manager_id = $request->manager_id;
            $manager_name = $employee->manager->name;
            $manager_surname = $employee->manager->surname;
            $manager_position_id = $employee->manager->position_id;

            $parent = Employee::where([
                                        ['name', $manager_name],
                                        ['surname', $manager_surname],
                                        ['position_id', $manager_position_id]
                                    ])->first();
            if(!empty($parent)) {
                $employee->appendToNode($parent)->save();
                return redirect()->back()->with('status', 'Новый сотрудник создан!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employees = Employee::find([$id]);
        if($employees->isEmpty()){
            return redirect('employees')->with('error', 'Сотрудник не найден!');
        }
        return view('site.employees.show',['employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee = Employee::find($id);
        if(empty($employee)){
            return redirect('employee')->with('error', 'Сотрудник не найден!');
        }
        $positions = Position::all();
        $managers = Manager::all();

        return view('site.employees.edit',['employee' => $employee, 'managers' => $managers, 'positions' => $positions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $messages = [
            'required' => "Поле :attribute обязательно к заполнению"
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'position' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $employee = Employee::findOrFail($id);
            $employee->name = $request->name;
            $employee->surname = $request->surname;
            $employee->position_id = $request->position;

            if (empty($request->manager_id)){
                $employee->makeRoot()->save();

                return redirect()->back()->with('status', 'Главный руководитель обновлен!');
            }

            $employee->manager_id = $request->manager_id;
            $manager_name = $employee->manager->name;
            $manager_surname = $employee->manager->surname;
            $manager_position_id = $employee->manager->position_id;

            $parent = Employee::where([
                ['name', $manager_name],
                ['surname', $manager_surname],
                ['position_id', $manager_position_id]
            ])->first();
            if(!empty($parent)) {
                $employee->appendToNode($parent)->save();
                return redirect()->back()->with('status', 'Сотрудник был обновлен!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Employee::findOrFail($id);
        $name = $employee->name.' '.$employee->surname;
        $employee->delete();

        return redirect('employees')->with('status', 'Сотрудник '.$name.' был удален!');

    }
}
