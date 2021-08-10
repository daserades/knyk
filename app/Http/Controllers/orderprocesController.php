<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\order;
use App\models\orderproces;
use App\models\exchange;
use App\models\colortype;
use App\models\finishproces;
use App\models\costtype;
use App\models\costprices;
use App\models\explanation;
use Auth;

class orderprocesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['users_id']=Auth::id();
        $orderproces=orderproces::where('order_id',$request->order_id)->first();
        if(isset($request->liza)) $request['liza']=1;else$request['liza']=0; if(isset($request->sardon)) $request['sardon']=1;else $request['sardon']=0; if(isset($request->gofre)) $request['gofre']=1;else $request['gofre']=0; if(isset($request->partwash)) $request['partwash']=1;else $request['partwash']=0; if(isset($request->lycra)) $request['lycra']=1; else $request['lycra']=0;
        
        if(empty($orderproces))
        {
            orderproces::create($request->all());     
        }
        elseif(isset($orderproces))
        {
            $orderproces->update($request->all());
        }

        if(isset($request->number))
        {
            foreach ($request->number as $key => $value) 
            {
               $costprices=costprices::where([['order_id',$request->order_id],['costtype_id',$key]])->first();
               if(empty($costprices))
               {
                   costprices::create([
                        'order_id'=>$request->order_id,
                        'costtype_id'=>$key,
                        'amount'=>$value,
                        'exchange_id'=>$request->exchange_id[$key],
                        'users_id'=>Auth::id(),
                   ]);     
               }
               elseif(isset($costprices))
               {
                $costprices->update([
                    'costtype_id'=>$key,
                    'amount'=>$value,
                    'exchange_id'=>$request->exchange_id[$key],
                    'users_id'=>Auth::id(),
                ]);
               }
            }
        } 
        if(isset($request->type) || isset($request->text))
      {

        for($i=0; $i < count($request->type); $i++)
        {
            explanation::create(['order_id'=>$request->order_id,
             'type'=>$request->type[$i],
             'place'=>$i,
             'text'=>$request->text[$i],
             'users_id'=>Auth()->id()
         ]);
        }
    }  
        return redirect(route('order.index')); 
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exchange=exchange::get();
        $colortype=colortype::get();
        $costtype=costtype::get();
        $finishproces=finishproces::get();
        $order=order::where('id',$id)->with('orderdetail','orderproces.colortype','orderproces.finishproces','costprices.exchange')->first();
        return view('order.orderproces.index',compact('order','colortype','exchange','finishproces','costtype'));
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
    }
}
