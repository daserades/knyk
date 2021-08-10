<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ordertype;
use App\models\type;
use App\models\company;
use App\models\pattern;
use App\article;
use App\models\patterndetail;
use App\models\patterncolor;
use App\models\band;
use TCG\Voyager\Facades\Voyager;
use Yajra\Datatables\Datatables;
use Auth;

class patternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'patterns')->firstOrFail();
        return view('pattern.index',compact('dataType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordertype=ordertype::get();
        $type=type::get();
        $company=company::orderby('name')->get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'patterns')->firstOrFail();
        $comp=article::groupby('comp')->select('comp')->get();
        return view('pattern.create',compact('ordertype','type','company','comp','dataType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d=date('y');
        $ordertype=ordertype::where('id',$request->ordertype_id)->pluck('no')->first();
        $type=type::where('id',$request->type_id)->pluck('name')->first();
        $no=$d.$ordertype.$type;
        $pattern=pattern::where('type_id',$request->type_id)->max('design_name');
        // return $request;
        // $pattern=pattern::where('design_name','like','%'.$no.'%')->max('design_name');
        // return $pattern;
        if($pattern > 0) 
            {
            $no = substr($pattern,3,4); $no = $no+1;
            $no = str_pad($no, 3 , "0",STR_PAD_LEFT);
            $no =$d.$ordertype.$no;
            $request['design_name']=$no;$request['users_id']=Auth::id();
            pattern::create($request->all());
            }

        else
        {
            $request['design_name']=$no;$request['users_id']=Auth::id();
            pattern::create($request->all());
        }
        return redirect('pattern');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'patterns')->firstOrFail();
        $pattern=pattern::with('company','patterndetail','patterncolor')->where('id',$id)->first();
        return view('pattern.show',compact('pattern','dataType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'patterns')->firstOrFail();
        $pattern = pattern::where('id',$id)->first();
        return view('pattern.edit',compact('pattern','dataType'));
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
        pattern::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pattern=pattern::find($id);
        patterndetail::where('pattern_id',$id)->delete();
        patterncolor::where('pattern_id',$id)->delete();
        $pattern->delete();
        return back()->with('success','Başarılı..');
    }
     public function js ()
    {   
      $pattern= pattern::with('company')->orderbydesc('id')->get();
      return Datatables::of($pattern)
      ->addColumn('action', function ($pattern) {
        $action='';
        $action='<table><tr>
        <td><a href="pattern/'.$pattern->id.'" class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
            <td><a href="pattern/'.$pattern->id.'/edit" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
            <td class="sil"><div class="delete-form">
            <form action="pattern/'.$pattern->id.'" method="POST">  
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-sm btn-danger pull-right delete" title="Sil"><i class="voyager-trash"></i> Sil</button>
            </form>
            </div></td>';
        $action .='</tr></table>';
        return $action;
      })
      ->removeColumn('password')
      ->make(true);

    }
    public function patterndetail($id,$no)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'patterns')->firstOrFail();
        $pattern=pattern::where('id',$id)->with(['patterndetail'=>function($q) use ($no){
            $q->where('variant_no',$no);
        },'patterndetail'])->first();
        return view('pattern.patterndetail',compact('pattern','id','no','dataType'));
    }
    public function showedit($id){
        $dataType = Voyager::model('DataType')->where('slug', '=', 'patterns')->firstOrFail();
        $patterndetail = patterndetail::with('bands')->where('id',$id)->first();
        $bands = band::get();
        return view('pattern/showedit', compact('patterndetail','bands','dataType'));
    }

    public function showupdate(Request $request, $id){
        patterndetail::find($id)->update($request->all());
        $pattern_id = patterndetail::where('id',$id)->pluck('pattern_id')->first();
        return redirect('pattern/'.$pattern_id);
    }
}
