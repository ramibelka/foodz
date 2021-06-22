<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'is_admin'])->except(['index' , 'show']);
    }
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$restos = Restaurant::where('address','Constantine')->get();
        $restos = Restaurant::all();
        return json_encode($restos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'Address' => 'required',
        ]);

        $resto = new Restaurant;
        $resto->name = $request->input('name');
        $resto->Address = $request->input('Address');

        if ($request->hasFile('image')) {

            $originalImage = $request->file('image');
            
            // Resize the image
            $resizedImage = Image::make($originalImage);
            $resizedImage->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->stream();

            Storage::disk('local')->put('public/images/restaurant/' . $resto->id, $resizedImage, 'public');
        }

        $resto->save();
        if ($resto){
            return response('Data stored successfully', 200);
        }
        else
        {
            return ('data is not stored properly');
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
        $restaurant = Restaurant::where('id', $id)->first();
        return response(json_encode($restaurant));
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
        $validated = $request->validate([
            'name' => 'required',
            'Address' => 'required',
        ]);
        
        $resto = Restaurant::find($id);
        $resto->name =  $request->get('name');
        $resto->Address = $request->get('Address');
        $resto->Photo = $request->get('Photo');
        $resto->save();
        return ('Data updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resto = Restaurant::findOrFail($id);
        $resto->delete();
        return ('Data deleted successfully');
    }
}