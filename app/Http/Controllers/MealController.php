<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use DB;

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

        $image = new Image;

        $meal = new Meal;
        $meal->name = $request->name;
        $meal->Price = $request->Price;
        $meal->Photo = $request->Photo;
        $meal->Ingredients = $request->Ingredients;
        $meal->category_id = $request->category_id;
        $meal->IdRestaurant = $request->IdRestaurant;

        if ($request->hasFile('image')) {

            $originalImage = $request->file('image');
            
            // Resize the image
            $resizedImage = Image::make($originalImage);
            $resizedImage->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            //$path = public_path('images/meal/' . $meal->id);
            //$resizedImage->save($path);
            $resizedImage->stream();

            Storage::disk('local')->put('public/images/meal/' . $meal->id, $resizedImage, 'public');
            //$path = $originalImage->storeAs(public_path().'/images/meal/', $meal->id);
        }

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

    public function search(Request $request)
    {
        $name = $request->get('name');

        if(isset($name)){

            $users = DB::table('meals')->where('name','like',$name)->paginate(6);
            return $users;
        }
        else
        {
            return('No meals have this name');
        }
    }
}