<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class TreeOfEmployeesController extends Controller
{
    //
    public function show(){

        //$employees = Employee::all();

        $employees = Employee::get()->toTree();

        //dd($employees);


        return view('site.tree_of_employees', ['employees' => $employees]);
    }
}
