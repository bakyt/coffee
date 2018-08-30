<?php

namespace App\Http\Controllers;

use App\Category;
use App\Floor;
use App\Food;
use App\Table;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function getCategories(){
        return response()->json(Category::all()->toArray());
    }
    public function getFoods(){
        return response()->json(Food::all()->toArray());

    }
    public function getTables(){
        return response()->json(Table::all()->toArray());

    }
    public function getFloors(){
        return response()->json(Floor::all()->toArray());

    }
    public function getUsers(){
        $users = [];
        foreach (User::all()->where('role_id', 2) as $value) array_push($users, $value);
        return response()->json($users);
    }
}
