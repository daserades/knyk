<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\article;
use App\models\order;
use App\models\pattern;
use App\models\patterndetail;
use App\models\cost;
use App\models\exchange;
use Yajra\Datatables\Datatables;
use Auth;

class costController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exchange=exchange::get();
        return view('order.cost.evencolor',compact('exchange'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exchange=exchange::get();
        return view('order.cost.yarncolor',compact('exchange'));
    }

    public function yarncolor($id, $fid)
    {
        $order_id = $id;
        $company_id = $fid;
        $exchange=exchange::get();
        return view('order.cost.yarncolor',compact('exchange','order_id','company_id'));
    }
    public function evencolor($id, $fid)
    {
        $order_id = $id;
        $company_id = $fid;
        $exchange=exchange::get();
        return view('order.cost.evencolor',compact('exchange','order_id','company_id'));
    }

    public function article(Request $request)
    {
        // $article=article::select('no')->get();
        // return $article;
        $search = $request->search;

      if($search == ''){
         $employees = article::select('id','no')->limit(20)->get();
      }else{
         $employees = article::select('id','no')->where('no', 'like', '%' .$search . '%')->limit(20)->get();
      }

      $response = array();
      foreach($employees as $employee){
         $response[] = array("value"=>$employee->id,"label"=>$employee->no);
      }

      return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request['taren'] = str_replace([',',','], ['.','.'], $request->taren);
        $request['users_id'] = Auth::id();
        cost::create($request->all());
        return redirect(route('orderdetail.newdetail',$request->article.'&'.$request->order_id))->with('success','Kayıt Başarılı..');
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
        //
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

    public function data($id)
    {
        $article=article::with('caglik')->where('id',$id)->first();
        return $article;
    }

}
