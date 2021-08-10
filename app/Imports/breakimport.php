<?php

namespace App\Imports;

use App\break1;
use App\break2;
use App\break3;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class breakimport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $a = data_get($row, 'design_name');
        $epi = data_get($row, 'epi');    
        $reedspace= data_get($row, 'reed_space');
        $finish_width= data_get($row, 'finish_width');
        $ppi= data_get($row, 'ppi');
        $total_dents= data_get($row, 'total_dents');
        $total_ends= data_get($row, 'total_ends');
        $grey_construction= data_get($row, 'grey_construction');
        $greycons= explode('X', $grey_construction);
        $grey_construction1= $greycons[0];
        $grey_construction2= $greycons[1];
        $finish_construction=data_get($row, 'finish_construction') ;
        $finishcons=explode('X', $finish_construction);
        $finish_construction1= $finishcons[0];
        $finish_construction2= $finishcons[1];
        $reed_count= data_get($row, 'reed_count');
        $average_dent= data_get($row, 'average_dent');
        $gray_width= data_get($row, 'gray_width');
        $finish_glm= data_get($row, 'finish_glm');
        $gray_glm= data_get($row, 'gray_glm');
        $finish_glm= data_get($row, 'finish_glm');
        $warp_pattern= data_get($row, 'warp_pattern');
        $weft_pattern= data_get($row, 'weft_pattern');
        $weft_total= data_get($row, 'weft_total');
        $draft_total= data_get($row, 'draft_total');
        if(isset($draft_total))
        {
        $drafttot=explode(' ', $draft_total);
        $draft_total1= $drafttot[0];
        $draft_total2=$drafttot[2];
        }
        else 
        {
        $draft_total1=0;
        $draft_total2=0;    
        }
        $pegptan_total= data_get($row, 'pegptan_total');
        $warp_total= data_get($row, 'warp_total');
        $aciklama= data_get($row, 'aciklama');
        $name= explode('-',$a);
        $new=break1::where('design_name','like','%'.$name[0].'%')->first();
           
          if (empty($new))
          {
            // break1::create($array->all());
            break1::create([
            'design_name'=>$name[0],
            'epi' => $epi,
            'reed_space' => $reedspace,
            'finish_width'=>$finish_width,
            'ppi'=>$ppi,
            'total_dents'=>$total_dents,
            'total_ends'=>$total_ends,
            'grey_construction'=>$grey_construction,
            'grey_construction1'=>$grey_construction1,
            'grey_construction2'=>$grey_construction2,
            'finish_construction'=>$finish_construction,
            'finish_construction1'=>$finish_construction1,
            'finish_construction2'=>$finish_construction2,
            'reed_count'=>$reed_count,
            'average_dent'=>$average_dent,
            'gray_width'=>$gray_width,
            'gray_glm'=>$gray_glm,
            'finish_glm'=>$finish_glm,
            'warp_pattern'=>$warp_pattern,
            'weft_pattern'=>$weft_pattern,
            'weft_total'=>$weft_total,
            'draft_total'=>$draft_total,
            'draft_total1'=>$draft_total1,
            'draft_total2'=>$draft_total2,
            'pegptan_total'=>$pegptan_total,
            'warp_total'=>$warp_total,
            'aciklama'=>$aciklama 
            ]);
        }
        else
        {
           
            $new->update([
            'design_name'=>$name[0],
            'epi' => $epi,
            'reed_space' => $reedspace,
            'finish_width'=>$finish_width,
            'ppi'=>$ppi,
            'total_dents'=>$total_dents,
            'total_ends'=>$total_ends,
            'grey_construction'=>$grey_construction,
            'grey_construction1'=>$grey_construction1,
            'grey_construction2'=>$grey_construction2,
            'finish_construction'=>$finish_construction,
            'finish_construction1'=>$finish_construction1,
            'finish_construction2'=>$finish_construction2,
            'reed_count'=>$reed_count,
            'average_dent'=>$average_dent,
            'gray_width'=>$gray_width,
            'gray_glm'=>$gray_glm,
            'finish_glm'=>$finish_glm,
            'warp_pattern'=>$warp_pattern,
            'weft_pattern'=>$weft_pattern,
            'weft_total'=>$weft_total,
            'draft_total'=>$draft_total,
            'draft_total1'=>$draft_total1,
            'draft_total2'=>$draft_total2,
            'pegptan_total'=>$pegptan_total,
            'warp_total'=>$warp_total,
            'aciklama'=>$aciklama,
            'created_at'=>now()
            ]);
            $new->save();

        }

        $variant_no=data_get($row, 'variant_no');
        $pattern=break1::where('design_name','like','%'.$name[0].'%')->first();
        $patterndetail= break2::where([['variant_no',$variant_no],['pattern_id',$pattern->id]])->first();
        
        if(empty($patterndetail))
        {
        for ($i=1; $i <= 15; $i++){
           $atki = data_get($row, 'weft'.$i.'_yarn_name');
             $quantity = data_get($row, 'weft'.$i.'_quantity');
             $picksrpt = data_get($row, 'weft'.$i.'_picksrpt');
             $tp = data_get($row, 'weft'.$i.'_tp');
             $yarncount = data_get($row, 'weft'.$i.'_yarncount');
             $colorrgb = data_get($row, 'weft'.$i.'_colorrgb');

             $c = data_get($row, 'warp'.$i.'_yarn_name');
             $cozgu_sayisi = data_get($row, 'warp'.$i.'_quantity');
             $cozgu_ends_rpt = data_get($row, 'warp'.$i.'_endsrpt');
             $cozgu_te = data_get($row, 'warp'.$i.'_te');
             $cozgu_yarncount = data_get($row, 'warp'.$i.'_yarncount');
             $cozgu_colorrgb = data_get($row, 'warp'.$i.'_colorrgb');

             $atkicount=explode('/',$yarncount);
             $type=explode(':',$yarncount);
             $ne=$atkicount[0];
             $no=preg_split('#(?<=\d)(?=[a-z])#i',@$atkicount[1]);
             $yhn=explode('/',$cozgu_yarncount);
             $ctype=explode(':',$cozgu_yarncount);
             $cne=$yhn[0];
             $cno=preg_split('#(?<=\d)(?=[a-z])#i',@$yhn[1]);
                 if (isset($atki) ) 
                 {
                    $patterndetail= break2::create([
                        'pattern_id'=>$pattern['id'],
                        'variant_no'=>$variant_no,
                        'place'=>$i,
                        'band'=>2,
                        'yarn_name' =>$atki,
                        'quantity' =>$quantity,
                        'picksrpt' =>$picksrpt,
                        'tp' =>$tp,
                        'yarncount' =>$yarncount,
                        'ne' =>$ne,
                        'no' =>$no[0],
                        'type' =>$type[1],
                        'colorrgb' =>$colorrgb
                    ]);
                 } 
                 if (isset($c))     
                 {
                    $patterndetail= break2::create([
                        'pattern_id'=>$pattern['id'],
                        'variant_no'=>$variant_no,
                        'place'=>$i,
                        'band'=>1,
                        'yarn_name' =>$c,
                        'quantity' =>$cozgu_sayisi,
                        'picksrpt' =>$cozgu_ends_rpt,
                        'tp' =>$cozgu_te,
                        'yarncount' =>$cozgu_yarncount,
                        'ne' =>$cne,
                        'no' =>$cno[0],
                        'type' =>$ctype[1],
                        'colorrgb' =>$colorrgb
                    ]);
                 }
                 $atki=null; $c=null;
            }
        }
        $regular_expression_2 ="\[(.*?)\]";
        $regular_expression_3 ="\](.*?)\[";
        
        $atki_pattern = data_get($row, 'weft_pattern');
        $dizi = explode ("[",$atki_pattern);
        $ilk=$dizi[0];
        preg_match_all('#'.$regular_expression_2.'#' ,$atki_pattern , $matches);
        preg_match_all('#'.$regular_expression_3.'#' ,$atki_pattern , $asd);
        array_unshift($asd[1],$ilk);

        $cozgu_pattern = data_get($row, 'warp_pattern');
        $cdizi = explode ("[",$cozgu_pattern);
        $cilk=$cdizi[0];
        preg_match_all('#'.$regular_expression_2.'#' ,$cozgu_pattern , $cozgurenk);
        preg_match_all('#'.$regular_expression_3.'#' ,$cozgu_pattern , $cozgutekrar);
        array_unshift($cozgutekrar[1],$ilk);

      $patterncolor= break3::where([['variant_no',$variant_no],['patterndetail_id',$patterndetail->id],['pattern_id',$pattern->id]])->first();
      if(empty($patterncolor)){
            if($atki_pattern)
            {
                for ($z=0; $z<count($matches[1]); $z++)
                {
                     $color=preg_split('/(?<=\D)(?=\d)|\d+\K/',$matches[1][$z]);
                     $chunks = array_chunk($color, 2);
                   for ($j=0; $j < count($chunks); $j++) { 
                         break3::create([
                            'pattern_id'=>$pattern['id'],
                            'patterndetail_id'=>$patterndetail['id'],
                            'variant_no' =>$variant_no,
                            'band'  => 2,
                            'place1'=> $z,
                            'place2'=> $j,
                            'again1'=> $asd[1][$z],
                            'again2'=> $chunks[$j][0],
                            'color' => $chunks[$j][1]
                         ]);
                     }
                }
            }
            if($cozgu_pattern)
            {
                for ($z=0; $z<count($cozgurenk[1]); $z++)
                {
                     $color=preg_split('/(?<=\D)(?=\d)|\d+\K/',$cozgurenk[1][$z]);
                     $chunks = array_chunk($color, 2);
                   for ($j=0; $j < count($chunks); $j++) { 
                         break3::create([
                            'pattern_id'=>$pattern['id'],
                            'patterndetail_id'=>$patterndetail['id'],
                            'variant_no' =>$variant_no,
                            'band'  => 1,
                            'place1'=> $z,
                            'place2'=> $j,
                            'again1'=> $cozgutekrar[1][$z],
                            'again2'=> $chunks[$j][0],
                            'color' => $chunks[$j][1]
                         ]);
                    }
                }
            }
        }
     }
 }