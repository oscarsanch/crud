<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $positions = Position::paginate(4);

        return view('site.positions.index', ['positions' => $positions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('site.positions.create');
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
            'required' => "Поле :attribute обязательно к заполнению",
            'unique' => "Такая должность уже существует"
        ];

        $validator = Validator::make($request->all(), [
            'position' => 'required|unique:positions,position_name|max:100'
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $position = new Position;
            $position->position_name = $request->position;

            $position->save();

            return redirect()->back()->with('status', 'Новая должность создана!');
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
        $position = Position::find($id);
        if(empty($position)){
            return redirect('position')->with('error', 'Должность не найдена!');
        }
        return view('site.positions.show',['position' => $position]);
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
        $position = Position::find($id);
        if(empty($position)){
            return redirect('position')->with('error', 'Должность не найдена!');
        }

        return view('site.positions.edit',['position' => $position]);
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
            'position' => 'required|unique:positions,position_name|max:100'
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $position = Position::find($id);
            $position->position_name = $request->position;
            $position->save();

            return redirect()->back()->with('status', 'Должность была обновлена!');
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
        $position = Position::findOrFail($id);
        $name = $position->position_name;
        $position->delete();

        return redirect('positions')->with('status', 'Должность '.$name.' была удалена!');
    }
}
