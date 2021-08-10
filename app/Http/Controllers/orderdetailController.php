<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\order;
use App\models\orderkind;
use App\models\orderdetail;
use App\article;
use App\models\pattern;
use App\models\patterndetail;
use App\models\exchange;
use App\models\pricetype;
use Auth;
class orderdetailController extends Controller
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
        $orderdetail=orderdetail::create($request->all());
        return redirect(route('orderdetail.edit',$request->order_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetail=orderdetail::with('order')->where('id',$id)->first();
        return $id.'siparişin.detay olmalı.';    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=order::where('id',$id)->with('orderdetail','company','authorized')->first();
        return view('order.orderdetail.index',compact('order'));
    }

    public function orderdetailedit($id)
    {
        $orderdetail=orderdetail::with('order')->find($id);
        $orderkind=orderkind::get();
        $exchange=exchange::get();
        $pricetype=pricetype::get();
        return view('order.orderdetail.edit',compact('orderdetail','orderkind','exchange','pricetype'));
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
        orderdetail::find($id)->update($request->all());
        return redirect(route('orderdetail.edit',$request->order_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        orderdetail::find($id)->delete();
        return back();
    }

    public function create2 ($id)
    {
        $order=order::where('id',$id)->with('company')->first();
        $orderkind=orderkind::get();
        $exchange=exchange::get();
        $pricetype=pricetype::get();
        return view('order.orderdetail.create',compact('order','orderkind','exchange','pricetype'));
    }
    public function newdetail($id)
    {
        $id= explode('&',$id); $order_id=$id[1];
        $order=order::where('id',$order_id)->with('company')->first();
        $article=pattern::where('design_name',$id[0])->first();
        $orderkind=orderkind::get();
        $exchange=exchange::get();
        $pricetype=pricetype::get();
        if (empty($article))
        {
            $article=article::where('no',$id[0])->first();
        }
        return view('order.orderdetail.create',compact('article','order','orderkind','exchange','pricetype'));
        
    }
}
