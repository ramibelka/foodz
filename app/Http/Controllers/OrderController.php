<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return response(json_encode($orders));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* ta3 chikh
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'string|required',
            'password' => 'string|required',
        ]);

        if($request->header('Content-type')=='application/json'){
            $email = $request['email'];
            $password =$request['password']; 
        }else{
            $email = $request->input('email');
            $password = $request->input('password');
        }
        
        DB::table('users')->insert(
            ['email' => $email,
            'password' => $password]
        );
        return response('Data stored successfully', 200);
    }
    */
    public function store(Request $request)
    {
        $request->validate([
            'Payment_Method'=>'required',
            'Position'=>'required'
        ]);

        $order = new Order;
        $order->state = $request->get('state');
        $order->Delivery_Address = $request->get('Delivery_Address');
        $order->Payment_Method = $request->get('Payment_Method');
        $order->Position = $request->get('Position');
        $order->save();
        return ('Data stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* ta3 chikh
    public function show(Order $order)
    {
        $order = Order::where('id', $order->id)
            ->with(
                [
                    'date', 'state', 'delivery address', 'payment method', 'position'
                ]
            )->first();
        return response(json_encode($order));
    }
    */

    public function show($id) {
        $order= Order::findOrFail($id);
        return response(json_encode($order));
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
        $request->validate([
            'Payment_Method'=>'required',
            'Position'=>'required'
        ]);

        $order = Order::find($id);
        $order->state = $request->get('state');
        $order->Delivery_Address = $request->get('Delivery_Address');
        $order->Payment_Method = $request->get('Payment_Method');
        $order->Position = $request->get('Position');
        $order->save();
        return ('Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect('api/orders')->with('success', 'Order deleted!');
    }

}