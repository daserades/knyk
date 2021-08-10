<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\yarn;
use App\models\yarndetail;
use App\models\yarnstore;
use App\models\yarntwist;
use App\models\yarntwistdetail;
use App\models\yarnpaint;
use Yajra\Datatables\Datatables;    
use App\models\movementkind;
use App\models\order;
use App\models\company;
use App\models\companytype;
use App\models\yarntype;
use App\models\colortype;
use App\models\unit;
use App\models\exchange;
use TCG\Voyager\Facades\Voyager;
use Auth;
use DB;
use QrCode;

class yarnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'yarns')->firstOrFail();
    $yarn= yarn::with('yarndetail.yarntype')
    ->leftjoin('companys as f','f.id','=','yarns.company_id')
    ->leftjoin('orders as o','o.id','=','yarns.order_id')
    ->leftjoin('companytypes as ft','ft.id','=','yarns.companytype_id')
    ->leftjoin('movementkinds as h','h.id','=','yarns.movementkind_id')
    ->select('yarns.id','f.name as company','h.id as movementkind_id','h.name as movementkind','o.no as order','ft.name as companytype','yarns.dispatchno','yarns.invoiceno','yarns.logindate','yarns.outdate','yarns.explanation')
    ->orderBy('id','DESC')->paginate(15); 
    return view('yarn.index',compact('yarn','dataType'));
    }

    public function yarnsearch(Request $request)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'yarns')->firstOrFail();
      $yarnbrand=$request->yarnbrand;$yarntype=$request->yarntype;$color=$request->color;$yarnno=$request->yarnno;$ne=$request->ne;
    $yarn=new yarn; 
    $yarn = $yarn->with(['yarndetail.yarntype']);
    if(isset($request->yarnbrand)) $yarn = $yarn->whereHas('yarndetail', function($q) use ($yarnbrand) {
    $q->where('yarnbrand','like','%'.$yarnbrand.'%');
       });
    if(isset($request->yarntype)) $yarn = $yarn->whereHas('yarndetail.yarntype', function($q) use ($yarntype) {
    $q->where('name','like','%'.$yarntype.'%');
       });
    if(isset($request->color)) $yarn = $yarn->whereHas('yarndetail', function($q) use ($color) {
    $q->where('color','like','%'.$color.'%');
       });
    if(isset($request->yarnno)) $yarn = $yarn->whereHas('yarndetail', function($q) use ($yarnno) {
    $q->where('yarnno','like','%'.$yarnno.'%');
       });
    if(isset($request->ne)) $yarn = $yarn->whereHas('yarndetail', function($q) use ($ne) {
    $q->where('ne','like','%'.$ne.'%');
       });
    $yarn = $yarn->leftjoin('companys as f','f.id','=','yarns.company_id')
    ->leftjoin('orders as o','o.id','=','yarns.order_id')
    ->leftjoin('companytypes as ft','ft.id','=','yarns.companytype_id')
    ->leftjoin('movementkinds as h','h.id','=','yarns.movementkind_id');
    if(isset($request->order))$yarn = $yarn->where('o.no','like','%'.$request->order.'%');
    if(isset($request->company))$yarn = $yarn->where('f.name','like','%'.$request->company.'%');
    if(isset($request->movementkind))$yarn = $yarn->where('h.name','like','%'.$request->movementkind.'%');
    if(isset($request->companytype))$yarn = $yarn->where('ft.name','like','%'.$request->companytype.'%');
    if(isset($request->dispatchno))$yarn = $yarn->where('dispatchno','like','%'.$request->dispatchno.'%');
    if(isset($request->explanation))$yarn = $yarn->where('yarns.explanation','like','%'.$request->explanation.'%');
    if(isset($request->logindate))$yarn = $yarn->where('yarns.logindate','like','%'.$request->logindate.'%');
    if(isset($request->outdate))$yarn = $yarn->where('yarns.outdate','like','%'.$request->outdate.'%');
    $yarn = $yarn->select('yarns.id','h.id as movementkind_id','f.name as company','h.name as movementkind','o.no as order','ft.name as companytype','yarns.dispatchno','yarns.invoiceno','yarns.logindate','yarns.outdate','yarns.explanation')
    ->orderBy('id','DESC')->paginate(50); 
    return view('yarn.index')->with(compact('yarn','dataType'));
    }

    /**     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $movementkind= movementkind::get();
      $yarntwist= yarntwist::get();
      $yarnpaint= yarnpaint::get();
      $order= order::orderBy('no')->get();
      $companytype= companytype::get();
      $company= company::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'yarns')->firstOrFail();
      $exchange= exchange::get();
      return view('yarn.create', compact('company','companytype','yarnpaint','yarntwist','movementkind','order','exchange','dataType'));
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
        $yarn = yarn::create($request->all());

       if ($request->get('movementkind_id')==2){
              return redirect('yarn/yarnout/'.$yarn['id'])->with(compact('yarn'));
            }
            elseif($request->get('movementkind_id')==1)
            {
              return redirect('yarn/yarnlogin/'.$yarn['id'])->with(compact('yarn'));
            }
    }

     public function yarnlogin($id)
     {
      $yarn=yarn::with('yarndetail','yarndetail.colortype','yarndetail.yarntype','yarndetail.unit')->find($id);
      $unit= unit::get();
      $yarntype= yarntype::get();
      $colortype= colortype::get(); 
      $yarntwist=yarntwist::with('yarntwistdetail.yarndetail')->where('id',$yarn->yarntwist_id)->get();
    //return $yarntwist;
        return view('yarn.yarnlogin',compact('yarn','yarntwist','unit','yarntype','colortype'));
     }

     public function yarnlogindetail(Request $request)
     {
    $yarn = yarn::find($request->yarn_id);
    $request['users_id']=Auth::id(); $request['price']=$yarn->price;
    $request['exchange_id']=$yarn->exchange_id; $request['dispatchno']=$yarn->dispatchno;
    $request['invoiceno']=$yarn->invoiceno; $request['explanation']=$yarn->explanation;
    $request['company_id']=$yarn->company_id; $request['order_id']=$yarn->order_id;

    $yarndetail_id = yarndetail::Where([['place',$request->place],['yarn_id',$request->yarn_id]])->first();
        if (isset($yarndetail_id))
        {
         $yarnstore=yarnstore::where('barcode',$yarndetail_id['barcode'])->first();   
         $yarndetail_id->update($request->all());
          $yarnstore->update($request->all());          
          return $yarndetail_id;
        }
        else{
                  $yarnstorenew =yarnstore::create($request->all());
                  $yarndetail=yarndetail::create($request->all());
                  $asd = yarnstore::where('barcode','like','KYNK'.date('Ymd').$yarnstorenew['id'].'%')->select('barcode')->first();
                   if($asd) 
                    {
                    return $asd;
                    }
                  else
                    {
                     $barcode =  'KYNK'.date('Ymd').$yarnstorenew['id']; 
                     yarnstore::where('id',$yarnstorenew['id'])->update(['barcode'=>$barcode]);
                     yarndetail::where('id',$yarndetail['id'])->update(['barcode'=>$barcode]);
                    }
                   return  $yarndetail;
           }
     }

    
    public function yarnout($id)
    {
      $yarn=yarn::where('id',$id)->first();
      $yarndetail=yarndetail::where('yarn_id',$id)->get();
       $yarntwist=yarntwist::with('yarntwistdetail')->where('id',$yarn->yarntwist_id)->get();
       return view('yarn.yarnout')->with(compact('yarn','yarntwist','yarndetail'));
    }

     public function yarnoutdetail(Request $request)
    {
      $yarnstore=yarnstore::where('barcode',$request->get('barcode'))->first();
      $yarn=yarn::with('yarndetail')->where('id',$request->get('yarn_id'))->first();
      
        if($yarnstore)
            {
                   $yarndetailbarcode= yarndetail::where('barcode',$yarnstore['barcode'])->where('movementkind_id',2)->first();
                     
                     if($yarndetailbarcode)
                     { return back();}
                   else
                     {
                          if($yarn->companytype_id == 6)
                         {
                          // $yarntwist=yarntwist::where('id',$yarn->yarntwist_id)->with('yarntwistdetail')->first();
                          $yarntwistdetail=yarntwistdetail::where('yarntwist_id',$yarn->yarntwist_id)
                          ->where([['yarnno',$yarnstore->yarnno],['ne',$yarnstore->ne],['yarntype_id',$yarnstore->yarntype_id],['colorno',$yarnstore->colorno]])
                          ->first();
                          $kg=yarndetail::where('yarn_id',$request->yarn_id)
                          ->where([['yarnno',$yarnstore->yarnno],['ne',$yarnstore->ne],['yarntype_id',$yarnstore->yarntype_id],['colorno',$yarnstore->colorno]])
                          ->get();
                          $depo= yarnstore::leftjoin('yarntype','yarntype.id','=','yarnstores.yarntype_id')
                        ->leftjoin('colortype','colortype.id','=','yarnstores.colortype_id')
                        ->leftjoin('units','units.id','=','yarnstores.unit_id')
                        ->select(
                                  'yarnbrand',
                                  'lotno', 
                                  DB::raw('SUM(amount) as amount'),
                                  DB::raw('SUM(amountgross) as amountgross'),
                                  'units.name as unit',
                                  'colortype.name as colortype',
                                  'yarntype.name as yarntype',
                                  'yarnno',
                                  'ne',
                                  'color',
                                  'colorno',
                                  'colorsim',
                                  'colornosim',
                                  'dispatchno'
                                )
                          ->where([['yarnstores.yarnno',$yarnstore->yarnno],['ne',$yarnstore->ne],['yarntype.id',$yarnstore->yarntype_id],['colorno',$yarnstore->colorno]])
                          ->groupBy('yarnno','ne','yarntype','lotno','colorno','colorsim')->get();

                          // return $kg;
                          if($yarntwistdetail->maxamount > $kg->sum('amount'))
                            return redirect('yarn/yarnout/'.$request->yarn_id)->with('error','Max. amountdan Fazla Sevk Yapılamaz !!');
                           //$yarntwistdetail->maxamount;
                              // $yarndetail->cozgu_id = $yarn->cozgu_id;
                              // $yarndetail->yarndetail_id = $yarndetail->id;
                              // $cozgudetail=cozgudetail::create($yarndetail->toArray());
                          }

                      $yarndetail= new yarndetail([
                            'yarn_id'=>$request->get('yarn_id'),
                            'place'=>$yarnstore['place'],
                            'movementkind_id'=>2,
                            'barcode'=>$yarnstore['barcode'],
                            'yarnbrand'=>$yarnstore['yarnbrand'],
                            'yarntype_id'=>$yarnstore['yarntype_id'],
                            'colortype_id'=>$yarnstore['colortype_id'],
                            'yarnno'=>$yarnstore['yarnno'],
                            'ne'=>$yarnstore['ne'],
                            'color'=>$yarnstore['color'],
                            'colorno'=>$yarnstore['colorno'],
                            'lotno'=>$yarnstore['lotno'],
                            'amount'=>$yarnstore['amount'],
                            'amountgross'=>$yarnstore['amountgross'],
                            'unit_id'=>$yarnstore['unit_id'],
                            'users_id'=>Auth::id()
                          ]);
                        $yarndetail->save();
                  $a=yarnstore::where('barcode',$request->get('barcode'))->first();
                  $a->delete();
                  // if($yarn->companytype_id == 2)
                  //    {
                  //         $yarndetail->cozgu_id = $yarn->cozgu_id;
                  //         $yarndetail->yarndetail_id = $yarndetail->id;
                  //         $cozgudetail=cozgudetail::create($yarndetail->toArray());
                  //     }
                  $yarndetail=yarndetail::where('yarn_id',$yarn['id'])->get();
                  $yarntwist=yarntwist::with('yarntwistdetail')->where('id',$yarn->yarntwist_id)->get();
                   return redirect('yarn/yarnout/'.$request->get('yarn_id'))->with(compact('yarn','yarntwist','yarndetail'))->with('success','Barkod Ekleme Başarılı');
                 }
            }
          else {
                  $yarndetail=yarndetail::where('yarn_id',$yarn['id'])->get();
             return redirect('yarn/yarnout/'.$request->get('yarn_id'))->with(compact('yarn','yarndetail'));

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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'yarns')->firstOrFail();
      $yarn=yarn::with('yarndetail')->find($id);
      return view('yarn.show',compact('yarn','dataType'));
    }
    public function show2($id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'yarns')->firstOrFail();
      $yarn=yarn::with('yarndetail')->find($id);
      return view('yarn.show2',compact('yarn','dataType'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $yarn=yarn::find($id);
      $movementkind= movementkind::get();
      $order= order::orderBy('no')->get();
      $companytype= companytype::get();
      $company= company::get();
      $exchange= exchange::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'yarns')->firstOrFail();
      return view('yarn.edit', compact('dataType','yarn','company','companytype','movementkind','order','exchange'));
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
         $yarn = yarn::find($id);
         $yarn->update($request->all());
        return redirect('/yarn/yarn')->with('success','Güncellendi');
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
    
    public function cuvalbol(Request $request)
    {
     $yarndetail=yarndetail::where('barcode',$request->get('barcode'))->where('movementkind_id',1)->first();
     if ($yarndetail)
     {$yarn=yarn::where('id',$yarndetail['yarn_id'])->first();
     $cikanlar=yarndetail::where('barcode','like','B'.$request->get('barcode').'%')->where('movementkind_id',2)->sum('amount');
          $amount= $yarndetail['amount'] - $request->get('val')-($cikanlar);
          $amountgross= $yarndetail['amountgross'] - $request->get('val')-($cikanlar);
          yarnstore::insert([
                         'yarn_id'=>$yarn['id'],
                         'place'=>$yarndetail['place'],
                         'barcode'=>$yarndetail['barcode'],
                         'company_id'=>$yarn['company_id'],
                         'order_id'=>$yarn['order_id'],
                         'yarntype_id'=>$yarndetail['yarntype_id'],
                         'colortype_id'=>$yarndetail['colortype_id'],
                         'yarnbrand'=>$yarndetail['yarnbrand'],
                         'yarnno'=>$yarndetail['yarnno'],
                         'ne'=>$yarndetail['ne'],
                         'color'=>$yarndetail['color'],
                         'colorno'=>$yarndetail['colorno'],
                         'lotno'=>$yarndetail['lotno'],
                         'amount'=> $amount,
                         'amountgross'=>$amountgross,
                         'unit_id'=>$yarndetail['unit_id'],
                         'price'=>$yarn['price'],
                         'exchange_id'=>$yarn['exchange_id'],
                         'dispatchno'=>$yarn['dispatchno'],
                         'invoiceno'=>$yarn['invoiceno'],
                         'explanation'=>$yarn['explanation'],
                         'created_at'=>$yarndetail['created_at'],
                         'updated_at'=>$yarndetail['updated_at'],
                         'users_id'=>Auth::id()
             ]);
          $barcodenew= 'B'.$yarndetail['barcode'];
             //$yarndetailcikis=yarndetail::where('barcode',$request->get('barcode'))->where('movementkind_id',2)->decrement('amount',$amount,['barcode'=>$barcodenew]);
             $yarndetailcikis=yarndetail::where('barcode',$request->get('barcode'))->where('movementkind_id',2)->update([
               'amount'=> $request->get('val'),
               'amountgross'=> $request->get('val'),
               'barcode'=> $barcodenew
             ]);
        return $yarndetailcikis;
           }
   else return 'hatalı işlem...';

      }
    public function yarndetaildestroy($id)
     {
   $yarndetail=yarndetail::where('id',$id)->first();
   if ( strpos($yarndetail->barcode,'B') === FALSE)
   {
    $yarndetailOLD=yarndetail::where('barcode',$yarndetail['barcode'])->where('movementkind_id','1')->first();
    $yarn=yarn::where('id',$yarndetail['yarn_id'])->first();
    $yarnout=yarndetail::where('barcode',$yarndetailOLD['barcode'])->where('movementkind_id','2')->get();
    if (count($yarnout) <= 1)
    {
     yarnstore::insert([
       'company_id'=>$yarn['company_id'],
       'order_id'=>$yarn['order_id'],
       'yarn_id'=>$yarndetailOLD['yarn_id'],
       'barcode'=>$yarndetailOLD['barcode'],
       'place'=>$yarndetailOLD['place'],
       'yarnbrand'=>$yarndetailOLD['yarnbrand'],
       'yarntype_id'=>$yarndetailOLD['yarntype_id'],
       'colortype_id'=>$yarndetailOLD['colortype_id'],
       'yarnno'=>$yarndetailOLD['yarnno'],
       'ne'=>$yarndetailOLD['ne'],
       'color'=>$yarndetailOLD['color'],
       'colorno'=>$yarndetailOLD['colorno'],
       'lotno'=>$yarndetailOLD['lotno'],
       'amount'=>$yarndetail['amount'],
       'amountgross'=>$yarndetail['amountgross'],
       'unit_id'=>$yarndetailOLD['unit_id'],
       'price'=>$yarn['price'],
       'exchange_id'=>$yarn['exchange_id'],
       'dispatchno'=>$yarn['dispatchno'],
       'invoiceno'=>$yarn['invoiceno'],
       'created_at'=>$yarndetailOLD['created_at'],
       'updated_at'=>$yarndetailOLD['updated_at'],
       'explanation'=>$yarn['explanation'],
       'users_id'=>Auth::id()
     ]);
   } 
   $yarndetail->delete();
 }
 else {
  $barcode = explode ("B",$yarndetail->barcode);
  $yarnstore = yarnstore::where('barcode',$barcode[1])->update(['amount'=> \DB::raw( 'amount +'.$yarndetail->amount ),'amountgross'=> \DB::raw( 'amountgross +'.$yarndetail->amount )]);
  $yarndetail->delete();
}
return back()->with('success','Barkod Silindi');
}

public function storereport()
  {
      return view('yarn.report');
  }
   public function storejs ()
   {
    $yarnstore= yarnstore::leftjoin('yarntypes','yarntypes.id','=','yarnstores.yarntype_id')
                        ->leftjoin('colortypes','colortypes.id','=','yarnstores.colortype_id')
                        ->leftjoin('units','units.id','=','yarnstores.unit_id')
                        ->select(
                                  'yarnbrand',
                                  'lotno', 
                                  DB::raw('SUM(amount) as amount'),
                                  DB::raw('SUM(amountgross) as amountgross'),
                                  'units.name as unit',
                                  'colortypes.name as colortype',
                                  'yarntypes.name as yarntype',
                                  'yarntypes.id as yarntype_id',
                                  'yarnno',
                                  'ne',
                                  'color',
                                  'colorno',
                                  'colorsim',
                                  'colornosim',
                                  'dispatchno'
                                )
                          ->groupBy('yarnno','ne','yarntype','lotno','colorno','colorsim')
                          ->get();
    return Datatables::of($yarnstore)
    ->removeColumn('password')
    ->make(true);
  }

public function etiket($id)
{
        $yarndetail= yarndetail::where('id',$id)->first();
        $asd=QrCode::size(130)->generate($yarndetail->barcode);
        return 
        '<!DOCTYPE html>
        <html>
        <head>
        <title>ASD</title>
        </head>
        <style type="text/css">
        body{
          margin-top:0px;
          margin-left:0px;
        }
        
        @media print {
          #btn {
          display :  none;
        }
      }
      </style>
      <body onload="window.print()">
      <table border="2" width="400">
      <tr><th colspan="2"><h3>BAYZARA TEKSTİL</h3>Tarih='.date('d-m-Y',strtotime($yarndetail->created_at)).'</th></tr>
      <tr>
      <td><b><center>Sipariş No<br>'.mb_substr($yarndetail->yarn->order->no,0,4).'-'.mb_substr($yarndetail->yarn->order->no,4,2).'-'.mb_substr($yarndetail->yarn->order->no,6,3).'</td>
      <td><center>'.$asd.'<br> No:'.$yarndetail->barcode.'</td>
      </tr>
      <tr>
      <td>Lot No-Marka </td>
      <td>'.$yarndetail->lotno.'---'.$yarndetail->yarnbrand.'</td>
      </tr>
      <tr>
      <td>İplik Cinsi</td>
      <td>'.$yarndetail->yarntype->name.'</td>
      </tr>
      <tr>
      <td>Boya Cinsi</td>
      <td>'.$yarndetail->colortype->name.'</td>
      </tr>
      <tr>
      <td>İplik No-Ne</td>
      <td>'.$yarndetail->yarnno.'/'.$yarndetail->ne.'</td>
      </tr>
      <tr>
      <td>İplik color</td>
      <td>'.$yarndetail->color.'+'.$yarndetail->colorsim.'</td>
      </tr>
      <tr>
      <td>İplik color No</td>
      <td>'.$yarndetail->colorno.'+'.$yarndetail->colornosim.'</td>
      </tr>
      <tr>
      <td>Miktar</td>
      <td>'.$yarndetail->amount.$yarndetail->unit->name.'</td>
      </tr>
      <tr>
      <td>Brüt Miktar</td>
      <td>'.$yarndetail->amountgross.$yarndetail->unit->name.'</td>
      </tr>
      <tr>
      <td>Çuval No</td>
      <td>'.$yarndetail->place.'</td>
      </tr>

      </table>
      <button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button>
      </body>
      </html>
      <script type="text/javascript">
      setTimeout( function() {
           history.go(-1);
      }, 1000);
      function goBack() {
        window.history.back();
      }
      </script>
      ';
}
public function topluetiket($id)
{
        $yarndetail= yarndetail::where('yarn_id',$id)->orderby('place')->get();
        $q='';
        $q .= '<!DOCTYPE html>
                        <html>
                        <head>
                        <title>ASD</title>
                        </head>
                        <style type="text/css">
                        body{
                          margin-top:0px;
                          margin-left:1px;
                        }
                        
                        @media print {
                          #btn {
                          display :  none;
                        }
                        .baslik{
                         font-size: 14px; 
                        font-weight: bold;
                      }
                      td{
                         font-size: 15px; 
                        font-weight: bold;
                      }
                      }
                      </style>
                      <body onload="window.print()">';
        foreach ($yarndetail as $list)
        {  
                $asd=QrCode::size(100)->generate($list->barcode);
                $q .=
                '<br><table border="1" width="380">
              <tr><th colspan="2">BAYZARA TEKSTİL <br>Tarih='.date('d-m-Y',strtotime($list->created_at)).'</th></tr>
              <tr>
              <th><font size="4"><b><center>Sipariş No<br>'.mb_substr($list->yarn->order->no,0,4).'-'.mb_substr($list->yarn->order->no,4,2).'-'.mb_substr($list->yarn->order->no,6,4).'</th>
              <th rowspan="2"><center>'.$asd.'</th>
              </tr>
              <tr><th>
               <font size="4">Çuval No:'.$list->place.'<br>'.$list->barcode.'</font>
              </th></tr>
              <tr>
              <td width="120" class="baslik">Lot No-İplik Marka </td>
              <td>'.$list->lotno.'---'.$list->yarnbrand.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik Cinsi</td>
              <td>'.$list->yarntype->name.'</td>
              </tr>
              <tr>
              <td class="baslik">Boya Cinsi</td>
              <td>'.$list->colortype->name.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik No-Ne</td>
              <td>'.$list->yarnno.'/'.$list->ne.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik color</td>
              <td>'.$list->color.'+'.$list->colorsim.'</td>
              </tr>
              <tr>
              <td class="baslik">İplik color No</td>
              <td>'.$list->colorno.'+'.$list->colornosim.'</td>
              </tr>
              <tr>
              <td class="baslik">Miktar</td>
              <td>'.$list->amount.$list->unit->name.'</td>
              </tr>
              <tr>
              <td class="baslik">Brüt Miktar</td>
              <td>'.$list->amountgross.$list->unit->name.'</td>
              </tr>
              </table>
              ';}
              $q .= '
              <!--<button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button> -->
              </body>
              </html>
              <script type="text/javascript">
              setTimeout( function() {
                   history.go(-1);
              }, 4000);
              function goBack() {
                window.history.back();
              }
              </script>';
              return $q;

}
    public function cuvalboletiket($id)
      {
        $q='';
        $yarndetail= yarndetail::where('id',$id)->first();
        $barcode = explode ("B",$yarndetail['barcode']);
        $yarnstore = yarnstore::where('barcode',$barcode[1])->first(); 
          $asd=QrCode::size(100)->generate($yarndetail->barcode);
          $q .=
          '<!DOCTYPE html>
          <html>
          <head>
          <title>ASD</title>
          </head>
          <style type="text/css">
          body{
            margin-top:0px;
            margin-left:0px;
            }
              td{
                         font-size: 15px; 
                        font-weight: bold;
                      }
          @media print {
                  #btn {
            display :  none;
          }
        }
        </style>
        <body onload="window.print()">
        <br><table border="1" width="380">
        <tr><th colspan="2">BAYZARA TEKSTİL <br>Tarih='.date('d-m-Y',strtotime($yarndetail->created_at)).'</th></tr>
        <tr>';
         if($yarndetail->yarn->order) $q .='<td><center>Sipariş No<br>'.mb_substr($yarndetail->yarn->order->no,0,4).'-'.mb_substr($yarndetail->yarn->order->no,4,2).'-'.mb_substr($yarndetail->yarn->order->no,6,3).'<br>Bölünmüş Çuval-'.$yarndetail->place.'<br> No:'.$yarndetail->barcode.'</td>';
         $q .='<td><center>'.$asd.'</td>
        </tr>
        <tr>
        <td>Lot No-Marka </td>
        <td>'.$yarndetail->lotno.'---'.$yarndetail->yarnbrand.'</td>
        </tr>
        <tr>
        <td>İplik Cinsi</td>
        <td>'.$yarndetail->yarntype->name.'</td>
        </tr>
        <tr>
        <td>Boya Cinsi</td>
        <td>'.$yarndetail->colortype->name.'</td>
        </tr>
        <tr>
        <td>İplik No-Ne</td>
        <td>'.$yarndetail->yarnno.'/'.$yarndetail->ne.'</td>
        </tr>
        <tr>
        <td>İplik color</td>
        <td>'.$yarndetail->color.'+'.$yarndetail->colorsim.'</td>
        </tr>
        <tr>
        <td>İplik color No</td>
        <td>'.$yarndetail->colorno.'+'.$yarndetail->colornosim.'</td>
        </tr>
        <tr>
        <td>Miktar</td>
        <td>'.$yarndetail->amount.$yarndetail->unit->name.'</td>
        </tr>
        <tr>
        <td>Brüt Miktar</td>
        <td>'.$yarndetail->amountgross.$yarndetail->unit->name.'</td>
        </tr>
        
        </table>
        <!--<button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button> -->
        </body>
        </html>
        
        ';
         $q .=
          '<!DOCTYPE html>
          <html>
          <head>
          <title>ASD</title>
          </head>
          <style type="text/css">
          body{
            margin-top:0px;
            margin-left:0px;
          }
            td{
                         font-size: 14px; 
                        font-weight: bold;
                      }
          @media print {
                  #btn {
            display :  none;
          }
        }
        </style>
        <body onload="window.print()">
        <br><table border="1" width="380">
        <tr><th colspan="2">BAYZARA TEKSTİL <br>Tarih='.date('d-m-Y',strtotime($yarnstore->created_at)).'</th></tr>
        <tr>';
       if ($yarnstore->yarn->order) $q .='<td><center>Sipariş No<br>'.mb_substr($yarnstore->yarn->order->no,0,4).'-'.mb_substr($yarnstore->yarn->order->no,4,2).'-'.mb_substr($yarnstore->yarn->order->no,6,3).
            '</td>';
        $q .= '<td rowspan="2"><center>'.$asd.'</td>
        </tr>
        <tr><th>
               <font size="4">Çuval No:'.$yarnstore->place.'<br>'.$yarnstore->barcode.'</font>
              </th></tr>
        <tr>
        <td>Lot No-İplik Marka </td>
        <td>'.$yarnstore->lotno.'---'.$yarnstore->yarnbrand.'</td>
        </tr>
        <tr>
        <td>İplik Cinsi</td>
        <td>'.$yarnstore->yarntype->name.'</td>
        </tr>
        <tr>
        <td>Boya Cinsi</td>
        <td>'.$yarnstore->colortype->name.'</td>
        </tr>
        <tr>
        <td>İplik No-Ne</td>
        <td>'.$yarnstore->yarnno.'/'.$yarnstore->ne.'</td>
        </tr>
        <tr>
        <td>İplik color</td>
        <td>'.$yarnstore->color.'</td>
        </tr>
        <tr>
        <td>İplik color No</td>
        <td>'.$yarnstore->colorno.'</td>
        </tr>
        <tr>
        <td>Miktar</td>
        <td>'.$yarnstore->amount.$yarnstore->unit->name.'</td>
        </tr>
        <tr>
        <td>Brüt Miktar</td>
        <td>'.$yarnstore->amountgross.$yarnstore->unit->name.'</td>
        </tr>
        
        </table>
        <!--<button id="btn" style="width: 100px; height: 100px;" onclick="goBack()">Geri</button> -->
        </body>
        </html>

        <script type="text/javascript">
        setTimeout( function() {
         history.go(-1);
         }, 1000);
         function goBack() {
          window.history.back();
        }
        </script>                               
        ';
        return $q;

      }

     
}

