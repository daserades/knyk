<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;    
use Auth;
use App\models\yarntwist;
use App\models\yarntwistdetail;
use App\models\yarn;
use App\models\yarnstore;
use App\models\order;
use App\models\company;

class yarntwistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('yarntwist.index');
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
        return view('yarntwist.create',compact('company','order'));
    }

    public function yarntwistdetail($id)
    {
        $yarntwist=yarntwist::find($id);
        /*$yarnstore=yarnstore::with(['yarntwistdetail'=>function($q) use ($id)
            {
              $q->where('yarntwist_id','!=',$id);     
            }])->get();
          $yarnstore= yarnstore::whereHas('yarntwistdetail',function($query){
            $query->whereNull('id');
        })->get();
        return $yarnstore; */
            $yarnstore=yarnstore::with('yarntype','boyacins','unit')->leftjoin('yarntwistdetails','yarntwistdetails.yarnstore_id','=','yarnstores.id')
                                    ->select('yarnstores.*')
                                    ->wherenull('yarntwistdetails.yarntwist_id')
                                    ->orwhere('yarntwistdetails.yarntwist_id','!=',$id)
                                    ->get();
                                    //return $yarnstore;
        $yarntwistdetail=yarntwistdetail::where('yarntwist_id',$id)->get();
        return view('yarntwist.create2',compact('yarntwist','yarnstore','yarntwistdetail'));
    }
/*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $no = yarntwist::where('no','like',date('Ymd').'%')->select('no')->orderBy('no','desc')->first();
      if($no)
      {
        $getno = mb_substr($no->no,-3,null,'utf8');$getno=$getno+1;
        $sno=str_pad($getno,3,"0",STR_PAD_LEFT);
        $request['no']= date('Ymd').$sno;
      }
      else $request['no']= date('Ymd').'001';
            $request['users_id']=Auth::id();
        $yarntwist = yarntwist::create($request->all());
        return redirect('yarntwist/yarntwistdetail/'.$yarntwist['id']);
    }

    public function yarntwistdetailpost(Request $request)
    {
        $yarnstore=yarnstore::find($request->get('yarnstore_id'));
        $request['yarndetail_id']=$yarnstore->yarndetail_id; 
        $request['iplikno']=$yarnstore->iplikno;
        $request['ne']=$yarnstore->ne;
        $request['yarntype_id']=$yarnstore->yarntype_id;
        $request['renkno']=$yarnstore->renkno;
        $request['renknosim']=$yarnstore->renknosim;
        $request['users_id']=Auth::id();
        yarntwistdetail::create($request->all());
        return back()->withInput()->with('success','Ekleme Başarılı..');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $yarntwist=yarntwist::with('yarntwistdetail')->find($id);
        return view('yarntwist.show',compact('yarntwist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  $yarntwist=yarntwist::find($id);
      $order= order::get();
      $company= company::get();
      return view('yarntwist.edit', compact('yarntwist','company','order'));
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
     $yarntwist = yarntwist::find($id);
     $yarntwist ->order_id= $request->get('order_id');
     $yarntwist ->name= $request->get('name');
     $yarntwist ->company_id= $request->get('company_id');
     $yarntwist ->aciklama= $request->get('aciklama');
     $yarntwist ->users_id= Auth::id();
     $yarntwist -> save();
     return redirect('/yarntwist/yarntwist')->with('success','Güncellendi');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yarntwist = yarntwist::find($id);
     $yarntwist -> delete();
     return redirect('/yarntwist/yarntwist')->with('success','Hareket Silindi');
    }
    public function destroy2($id)
    {
        $yarntwistdetail = yarntwistdetail::find($id);
     $yarntwistdetail -> delete();
     return back()->with('success','Hareket Silindi');
    }
    public function js()
    {
        $yarntwist = yarntwist::with('company','order','yarn')->orderbydesc('id')->get();
        return Datatables::of($yarntwist)
    ->addColumn('action', function ($yarntwist) {
      $table= '<table><tr>';
      /*if($yarntwist->yarn['id'] == null) 
      { */    
            $table .='<td><a href="yarntwist/'.$yarntwist->id.'" title="Detay" target="blank" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
            if(!auth()->user()->hasRole('konfeksiyon plan')){$table .='<td><a href="'.route('yarntwistdetail',$yarntwist->id).'" title="Talimat Giriş" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
            $table .='<td><a href="yarntwist/'.$yarntwist->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>';
            $table .='<td class="sil"><div class="delete-form">
            <form action="yarntwist/'.$yarntwist->id.'" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" style="color:red" title="Sil"><i class="far fa-trash-alt"></i></button>
            </form></div></td>';}
        //}else $table .= '<td>Talimat Gerçekleşti</td>';
      $table .='</tr></table>';

      return $table;
    })
    ->removeColumn('password')
    ->make(true);
    }
}
