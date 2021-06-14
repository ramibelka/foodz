<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;

class MealController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index' , 'show']);
    }

    public function index(){
        $meals = Meal::all();
        return response(json_encode($meals));
    }

    public function show($id) {
        $meal= Meal::findOrFail($id);
        return response(json_encode($meal));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'Price' => 'required',
        ]);

        $meal = new Meal;
        $meal->name = $request->name;
        $meal->Price = $request->Price;
        $meal->Photo = $request->Photo;
        $meal->Ingredients = $request->Ingredients;
        $meal->save();
        return response('Data stored successfully', 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'Price' => 'required',
        ]);
        
        $meal = Meal::find($id);
        $meal->name =  $request->get('name');
        $meal->Price = $request->get('Price');
        $meal->Photo = $request->get('Photo');
        $meal->Ingredients = $request->get('Ingredients');
        $meal->save();
        return ('Data updated successfully');
    }

    public function destroy($id) {
        $meal = Meal::findOrFail($id);
        $meal->delete();
        return ('Data deleted successfully deleted!');
    }
}