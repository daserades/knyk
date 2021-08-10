<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\company;
use App\models\companytype;
use App\models\status;
use App\models\country;
use App\models\city;
use App\models\adress;
use App\models\yesno;
use App\User;
use Yajra\Datatables\Datatables;
use TCG\Voyager\Facades\Voyager;
use Auth;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'companys')->firstOrFail();
        // $company=company::paginate(10);
        return view('definition.company.index',compact('dataType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status= status::get();
        $companytype= companytype::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'companys')->firstOrFail();
        $country= country::get();
        $yesno= yesno::get();
        return view('definition.company.create',['companytype'=>$companytype,'status'=>$status,'country'=>$country,'yesno'=>$yesno,'dataType'=>$dataType]);
    }

    public function city($id)
    {
        $city= city::where('countries_id',$id)->get();
        return $city;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request['users_id']= Auth::id();
        $company =company::create($request->all());
        if($request->countries_id)
        {

            for ($i=0; $i < count($request->countries_id); $i++)
            {
                if(country::find($request->countries_id[$i])->first() && city::where([['id',$request->cities_id[$i]],['countries_id',$request->countries_id[$i]]])->first())
                {
                    adress::create([
                        'company_id'=> $company->id,
                        'place'=> $i,
                        'countries_id'=>$request->countries_id[$i], 
                        'cities_id'=>$request->cities_id[$i], 
                        'text'=> $request->adres[$i],
                        'users_id'=> Auth::id()
                    ]);
                // echo 'asd';
                }
                else return redirect('company')->with('success','company Ekleme Başarılı. Ancak adresde eşleşmeyen kayıtlar mevcut! Lütfen düzeltiniz!');
            }
        }
        return redirect('company')->with('success','company Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'companys')->firstOrFail();
        $company=company::where('id',$id)->with('adress.country','adress.city')->first();
        return view('definition.company.show',compact('company','dataType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=company::with('adress')->find($id);
        $companytype= companytype::get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'companys')->firstOrFail();
        $status= status::get();
        $country= country::get();
        $city= city::get();
        $yesno= yesno::get();
        return view('definition.company.edit',compact('company','dataType','companytype','status','country','city','yesno'));
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
        $company = company::find($id);
        $company->update($request->all());
        return redirect('company')->with('success','company Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = company::find($id);
        $company -> delete();
        return redirect('company')->with('success','company Silindi');
    }
    public function js()
    {
        $company=company::with('companytype','status')->get();
        return Datatables::of($company)
        ->addColumn('action', function ($company) {
            $a= '<table><tr>
            <td><a href="company/'.$company->id.'" class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
            <td><a href="company/'.$company->id.'/edit" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
            <td class="sil"><div class="delete-form">
            <form action="company/'.$company->id.'" method="POST">  
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
