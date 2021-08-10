<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\authorized;
use App\models\company;
use App\models\dutylist;
use Yajra\Datatables\Datatables;
use TCG\Voyager\Facades\Voyager;
use Auth;

class authorizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $authorized=authorized::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'authorizeds')->firstOrFail();
        // $dataTypeContent = Voyager::model('DataRow')->where('data_type_id',$dataType->id)->get();
        return view('definition.authorized.index',compact('authorized','dataType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'authorizeds')->firstOrFail();
        $company = company::get();
        $dutylist = dutylist::get();
        return view('definition.authorized.create',['company'=>$company,'dutylist'=>$dutylist,'dataType'=>$dataType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authorized = authorized::create($request->all());
        return redirect('authorized')->with('success','authorized Ekleme Başarılı..');

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
        $authorized=authorized::find($id);
        $company = company::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'authorizeds')->firstOrFail();
        $dutylist = dutylist::get();
        return view('definition.authorized.edit',compact('authorized','dataType','company','dutylist'));
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
        $request['users_id']= Auth::id();
        $authorized = authorized::find($id);
        $authorized->update($request->all());
        return redirect('authorized')->with('success','authorized Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authorized = authorized::find($id);
        $authorized -> delete();
        return redirect('authorized')->with('success','authorized Silindi');
    }
    public function js()
    {
        $authorized=authorized::with('company','dutylist')->get();
        return Datatables::of($authorized)
        ->addColumn('action', function ($authorized) {
            $a= '<table><tr>
            <td><a href="authorized/'.$authorized->id.'/edit" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
            <td class="sil"><div class="delete-form">
            <form action="authorized/'.$authorized->id.'" method="POST">  
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

}
