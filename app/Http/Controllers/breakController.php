<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\break1;
use App\break2;
use App\break3;
use App\models\pattern;
use App\models\patterndetail;
use App\models\patterncolor;
use App\Imports\breakimport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Auth;

class breakController extends Controller
{
    public function import() 
    {
       // Excel::import(new UsersImport, '19K1010-01.xls');
    	break1::query()->truncate();break2::query()->truncate();break3::query()->truncate();
        Excel::import(new breakimport, request()->file('file'));
        return back()->with('success', 'Başarılı..!!');
    }
    public function break()
    {
        $break1=break1::with(['break2'=>function($q){$q->groupby('variant_no')->select('variant_no','pattern_id');}])->first();
    	return view('pattern.break')->with('break1',$break1);
    }
    public function variant(Request $request)
    {
    	$pattern=pattern::where('design_name',$request->design_name)->first();
    	$break1=break1::first();
    	if(isset($pattern))
    	{	
           $break1['users_id']=Auth::id(); 
    	   $pattern->update($break1->toArray());
    	}
	    	$break2=break2::get();	$break3=break3::get();
	    	for($i=0; $i < count($request->item); $i++)
	    	{
				$patterndetail=patterndetail::where('pattern_id',$pattern->id)->where('variant_no',$request->item[$i])->get();
    				if(count($patterndetail) <= 0){
		    			foreach ($break2->where('variant_no',$request->item[$i]) as $list) {
				    		$list['pattern_id']=$pattern->id;
				    		patterndetail::create($list->toArray());
		    		}
		    	}
				$patterncolor=patterncolor::where('pattern_id',$pattern->id)->where('variant_no',$request->item[$i])->get();
					if(count($patterncolor) <= 0){
						foreach ($break3->where('variant_no',$request->item[$i]) as $list) {
							$list['pattern_id']=$pattern->id;		
							patterncolor::create($list->toArray());
						}
					}
	    	}
    	return back()->with('success','Başarılı..');
    }

     public function importimages(Request $request)
    {
    $resimler = $request->file('resimler'); 
    if (!empty($resimler))
    {   $i=0;
      foreach ($resimler as $list) {
         $resim_uzantı=$list->getClientOriginalExtension();
         $resim_ad=$list->getClientOriginalName();
         $resim_ad=explode('.', $resim_ad);
         $resim=$resim_ad[0];
         $article = substr($resim,0,7); 
         $pattern=pattern::where('design_name',$article)->select('design_name','id')->first();
         // $patterndetail=patterndetail::where('pattern_id',$pattern->id)->get();
         $fabric=substr($resim,-6);
         
          if($fabric =='Fabric')
          {
            $res=explode('_', $resim);
            $varyant=substr($res[1],0,-6);
            $design_name=$pattern->id.'-'.$varyant.'.'.$resim_uzantı;
            echo $design_name.'asd<br>';
            $patterndetail=patterndetail::where('pattern_id',$pattern->id)->where('variant_no',$varyant)->get();
            if(count($patterndetail) > 0)
            Storage::disk('uploads')->put($pattern->id.'/'.$design_name,file_get_contents($list));
          }
          elseif(strpos($fabric, 'Draft') !== false)
          {
           echo $fabric.'draf<br>';
           $design_name=$pattern->id.'-Draft'.'.'.$resim_uzantı;
           Storage::disk('uploads')->put($pattern->id.'/'.$design_name,file_get_contents($list));
          }
          elseif(strpos($fabric, 'Peg') !== false)
          {
           echo $fabric.'peg<br>';
           $design_name=$pattern->id.'-Peg'.'.'.$resim_uzantı;
           Storage::disk('uploads')->put($pattern->id.'/'.$design_name,file_get_contents($list));
          }
        $i++;
      }
    }
      return redirect('pattern/pattern')->with('success','Başarılı..');
    }
}
