<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;    
use App\models\yarnpaint;
use App\models\yarnpaintdetail;
use App\models\yarnstore;
use App\models\yarn;
use App\models\order;
use App\models\company;
use App\models\exchange;
use Auth;

class yarnpaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('yarnpaint.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company=company::get();
        $order=order::get();
        return view('yarnpaint.create',compact('company','order'));
    }

    public function create2($id)
    {
       $yarnpaint=yarnpaint::find($id);
        $yarnpaintdetail=yarnpaintdetail::with('exchange')->where('yarnpaint_id',$id)->get();
        $order=order::whereId($yarnpaint->order_id)->first();
        $exchange=exchange::get();
        return view('yarnpaint.create2',compact('order','yarnpaint','yarnpaintdetail','exchange'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $no = yarnpaint::where('no','like','Y'.date('Ymd').'%')->select('no')->orderBy('no','desc')->first();
      if($no)
      {
        $getno = mb_substr($no->no,-3,null,'utf8');$getno=$getno+1;
        $sno=str_pad($getno,3,"0",STR_PAD_LEFT);
        $no= 'Y'.date('Ymd').$sno;
      }
      else $no= 'Y'.date('Ymd').'001';
        $yarnpaint =  new yarnpaint([
            'no' => $no,
            'company_id' => $request->get('company_id'),
            'order_id' => $request->get('order_id'),
            'explanation' => $request->get('explanation'),
            'users_id' => Auth::id()
        ]);
        $yarnpaint->save();
        return redirect('yarnpaint/create2/'.$yarnpaint['id']);
    }

    public function store2(Request $request)
    {
       $yarnpaintdetail= yarnpaintdetail::Where([['yarnpaint_id',$request->yarnpaint_id],['orderdetail_id',$request->orderdetail_id]])->first();
        if (empty($yarnpaintdetail))
        yarnpaintdetail::create($request->all());
        else 
        yarnpaintdetail::Where([['yarnpaint_id',$request->yarnpaint_id],['orderdetail_id',$request->orderdetail_id]])->update($request->all());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $yarnpaint=yarnpaint::where('id',$id)->with('order','company','yarnpaintdetail.orderdetailwarp','yarnpaintdetail.orderdetailweft')->first();
        return view('yarnpaint.show',compact('yarnpaint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  $yarnpaint=yarnpaint::find($id);
      $company= company::get();
      $order= order::get();
      return view('yarnpaint.edit', compact('yarnpaint','order','company'));
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
     $yarnpaint = yarnpaint::find($id);
     $yarnpaint ->company_id= $request->get('company_id');
     $yarnpaint ->order_id= $request->get('order_id');
     $yarnpaint ->explanation= $request->get('explanation');
     $yarnpaint ->users_id= Auth::id();
     $yarnpaint -> save();
     return redirect('/yarnpaint/yarnpaint')->with('success','Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yarnpaint = yarnpaint::find($id);
     $yarnpaint -> delete();
     return redirect('/yarnpaint/yarnpaint')->with('success','Hareket Silindi');
    }
    public function destroy2($id)
    {
        $yarnpaintdetail = yarnpaintdetail::find($id);
     $yarnpaintdetail -> delete();
     return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $yarnpaint = yarnpaint::with('company','order')->orderByDesc('id')->get();
        return Datatables::of($yarnpaint)
    ->addColumn('action', function ($yarnpaint) {
      $table= '<table><tr>';
            $table .='<td><a href="yarnpaint/'.$yarnpaint->id.'" title="Detay" target="_blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
            $table .='<td><a href="'.route('boyacreate2',$yarnpaint->id).'" title="Talimat Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
            $table .='<td><a href="yarnpaint/'.$yarnpaint->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
            $table .='<td class="sil"><div class="delete-form">
            <form action="yarnpaint/'.$yarnpaint->id.'" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" style="color:red" title="Sil"><i class="far fa-trash-alt"></i></button>
            </form></div></td>';
      $table .='</tr></table>';

      return $table;
    })
    ->removeColumn('password')
    ->make(true);
    }
    public function report()
    {
        $yarnpaint=yarnpaint::with('yarnpaintdetail.yarndetail')->get();
        return $yarnpaint;
    }
}
