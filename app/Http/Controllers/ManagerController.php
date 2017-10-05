<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager;
use Validator;
use App\Position;


class ManagerController extends Controller
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
        $managers = Manager::paginate(4);

        return view('site.managers.index', ['managers' => $managers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $positions = Position::find([1,2,3,4,5]);
        $positionAll = Position::all();

        if ($positionAll->isEmpty()){
            return redirect('positions/create')->with('error', 'Ошибка, в таблице должностей нет ни одной записи!');
        }
        return view('site.managers.create',['positions' => $positions]);
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
            'position' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $manager = new Manager;
            $manager->name = $request->name;
            $manager->surname = $request->surname;
            $manager->position_id = $request->position;
            $manager->save();

            return redirect()->back()->with('status', 'Новый руководитель создан!');
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
        $managers = Manager::find([$id]);
        if($managers->isEmpty()){
            return redirect('managers')->with('error', 'Руководитель не найден!');
        }
        return view('site.managers.show',['managers' => $managers]);
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
        $manager = Manager::find($id);
        if(empty($manager)){
            return redirect('managers')->with('error', 'Руководитель не найден!');
        }
        $positions = Position::find([1,2,3,4,5]);

        return view('site.managers.edit',['manager' => $manager, 'positions' => $positions]);
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
            'position' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $manager = Manager::find($id);
            $manager->name = $request->name;
            $manager->surname = $request->surname;
            $manager->position_id = $request->position;
            $manager->save();

            return redirect()->back()->with('status', 'Руководитель был обновлен!');
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
        $manager = Manager::findOrFail($id);
        $name = $manager->name.' '.$manager->surname;
        $manager->delete();

        return redirect('managers')->with('status', 'Руководитель '.$name.' был удален!');
    }
}
