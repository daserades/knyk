<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\order;
use App\models\company;
use App\models\authorized;
use App\models\adress;
use App\models\language;
use App\models\contractitem;
use App\models\orderitem;
use App\models\explanation;
use App\models\cost;
use Yajra\Datatables\Datatables;
use TCG\Voyager\Facades\Voyager;
use Auth;


class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'orders')->firstOrFail();
        return view('order.index',compact('dataType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company=company::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'companys')->firstOrFail();
        $language=language::get();
        return view('order.create',compact('company','language','dataType'));
    }

    public function authorized($id)
    {
        $authorized=authorized::where('company_id',$id)->get();
        return $authorized;
    }

    public function adress($id)
    {
        $adress=adress::where('company_id',$id)->get();
        return $adress;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no=order::where('no','like', '%' . date('Y').date('m').date('d') . '%')->orderby('id','desc')->pluck('no')->first();
        if($no)   
        {
          $no++;
        }

      else $no= date('Y').date('m').date('d').'001';

      $request['no']=$no; $request['users_id']=auth::id();
      $order=order::create($request->all());
      if(isset($request->type) || isset($request->text))
      {

        for($i=0; $i < count($request->type); $i++)
        {
            explanation::create(['order_id'=>$order->id,
             'type'=>$request->type[$i],
             'place'=>$i,
             'text'=>$request->text[$i],
             'users_id'=>Auth()->id()
         ]);
        }
    }

    $contractitem=contractitem::get();
    return view('order.contractitem',compact('order','contractitem'));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order= order::with('company','language','authorized','explanation')->find($id);
        $company=company::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'companys')->firstOrFail();
        $language=language::get();
        $authorized=authorized::where('company_id',$order->company_id)->get();
        return view('order.edit',compact('order','company','language','authorized','dataType'));
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
        // return $request;
      // unset($request['_token']);
        $order=order::where('id',$id)->update([
            'date'=>$request->date,
            'company_id'=>$request->company_id,
            'authorized_id'=>$request->authorized_id,
            'language_id'=>$request->language_id
        ]);

        if(isset($request->type) || isset($request->text))
      {

        for($i=0; $i < count($request->type); $i++)
        {
            if(explanation::where([['order_id',$id],['place',$i]])->first())
             {   
             explanation::where([['order_id',$id],['place',$i]])->update([ 
             'type'=>$request->type[$i],
             'text'=>$request->text[$i],
             'users_id'=>Auth()->id()
             ]);
            }
            else
            {
             explanation::create([
            'order_id'=>$id,
            'type'=>$request->type[$i],
            'place'=>$i,
            'text'=>$request->text[$i],
            'users_id'=>Auth()->id()    
                ]);
            }
        }
    }


        return redirect('order')->with('success','Başarılı...');
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

    public function js()
    {
        $order=order::with('company','authorized')->orderbydesc('id')->get();
        return Datatables::of($order)
        ->addColumn('action', function ($order) {
            $a= '<table><tr>
            <td><a href="'.route('showorder',$order->id).'" class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
            <td><a href="'.route('orderdetail.edit',$order->id).'" class="btn btn-sm btn-success"><i class="voyager-plus" title="Sipariş Detayı"></i> Detay</a></td>
            <td><a href="contractitemedit/'.$order->id.'" class="btn btn-sm btn-dark pull-right" title="Sözleşme Maddeleri"><i class="voyager-lightbulb"></i> Sözleşme M.</a></td>
            <td><a href="orderproces/'.$order->id.'/edit" class="btn btn-sm btn-info pull-right" title="İşletme Formu"><i class="voyager-window-list"></i> İşletme Formu</a></td>
            <td><a href="costcalculation/'.$order->id.'" class="btn btn-sm btn-dark pull-right" title="Maliyet Hesabı"><i class="voyager-lightbulb"></i> Maliyet Hesabı</a></td>
            <td><a href="order/'.$order->id.'/edit" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
            <td class="sil"><div class="delete-form">
            <form action="order/'.$order->id.'" method="POST">  
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-sm btn-danger pull-right delete" title="Sil"><i class="voyager-trash"></i> Sil</button>
            </form>
            </div></td></tr></table>';
            return $a;
        })
        ->removeColumn('password')
        ->make(true);
    }

    public function contractitem(Request $request)
    {
        for($i=0; $i < count($request->item); $i++)
        {
            orderitem::create([
               'order_id'=>$request->order_id,
               'contractitem_id'=>$request->item[$i],
               'users_id'=>auth()->id(),
           ]);
        }
        $order = order::with('company','authorized')->find($request->order_id);
        $maliyet = cost::where('order_id',$request->order_id)->get();
        return redirect('costcalculation/'.$request->order_id)->with(compact('order','maliyet'));
    }

    public function explanationdelete($id)
    {
        explanation::find($id)->delete();
        return back()->with('success','Silindi...');
    }

    public function costcalculation($id){
        $order = order::with('company','authorized','cost.ordertype')->find($id);
        return view('order.costcalculation',compact('order'));
    }

    public function contractitemedit($id)
    {
        $order = order::with('orderitem')->where('id',$id)->first();
        $contractitem=contractitem::get();
        return view('order.contractitemedit',compact('order','contractitem'));
    }
    public function contractitemupdate(Request $request)
    {
        orderitem::where('order_id',$request->order_id)->delete();
            for($i=0; $i < count($request->item); $i++)
            {
                orderitem::create([
                   'order_id'=>$request->order_id,
                   'contractitem_id'=>$request->item[$i],
                   'users_id'=>auth()->id(),
               ]);
            }
            return view('order.index');
    }
    public function showorder($id){

           $order = order::where('id',$id)->with('orderitem.contractitem','orderdetail')->first();
        if($order->language_id == 1)
        {
            return view('order.tr',compact('order'));
        }
        elseif($order->language_id == 2)
        {    
        return view('order.en',compact('order'));
        }

    }

}
