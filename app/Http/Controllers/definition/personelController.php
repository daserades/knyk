<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\models\department;
use App\models\dutylist;
use App\models\status;
use App\models\personel;
use Yajra\Datatables\Datatables;
use TCG\Voyager\Facades\Voyager;

class personelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'personels')->firstOrFail();
        return view('definition.personel.index',compact('dataType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'personels')->firstOrFail();
        $user= user::leftjoin('personels', 'users.id', '=', 'personels.users_tb_id')->
        whereNull('personels.users_tb_id')->select('users.id','users.username')->get();
        $department = department::get();
        $dutylist = dutylist::get();
        $status= status::get();
        return view('definition.personel.create',['user'=>$user,'department'=>$department,'dutylist'=>$dutylist,'status'=>$status,'dataType'=>$dataType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $personel = new personel([
            'name'=> $request ->get('name'),
            'surname'=>$request ->get('surname'),
            'tel' => $request ->get('tel'),
            'department_id'=>$request ->get('department_id'),
            'dutylists_tb_id'=>$request ->get('dutylists_tb_id'),
            'gtrh'=>$request ->get('gtrh'),
            'ctrh'=>$request ->get('ctrh'),
            'status_id'=>$request ->get('status_id'),
            'users_tb_id'=>$request ->get('users_tb_id'),
            'adres'=>$request ->get('adres')
        ]);
        $personel->save();
        return redirect('personel')->with('success','Personel Ekleme Başarılı..');

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
        $personel=personel::find($id);
        $user= User::get();
        $department = department::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'personels')->firstOrFail();
        $dutylist = dutylist::get();
        $status= status::get();
        return view('definition.personel.edit',compact('personel','user','department','status','dataType','dutylist'));
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
        
        
        $personel = personel::find($id);
        $personel ->name = $request->get('name');
        $personel ->surname= $request->get('surname');
        $personel ->tel= $request->get('tel');
        $personel ->department_id= $request->get('department_id');
        $personel ->dutylists_tb_id= $request->get('dutylists_tb_id');
        $personel ->gtrh= $request->get('gtrh');
        $personel ->ctrh= $request->get('ctrh');
        $personel ->status_id= $request->get('status_id');
        $personel ->users_tb_id= $request->get('users_tb_id');
        $personel ->adres= $request->get('adres');
        $personel -> save();
        return redirect('personel')->with('success','Personel Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personel = personel::find($id);
        $personel -> delete();
        return redirect('personel')->with('success','Personel Silindi');
    }
   public function js()
    {
        $personel=personel::with('department','dutylist','status','user')->get();
    return Datatables::of($personel)
        ->addColumn('action', function ($personel) {
            $a= '<table><tr>
            <td><a href="personel/'.$personel->id.'" class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
            <td><a href="personel/'.$personel->id.'/edit" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
            <td class="sil"><div class="delete-form">
            <form action="personel/'.$personel->id.'" method="POST">  
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
