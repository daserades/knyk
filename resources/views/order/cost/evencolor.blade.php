@extends('voyager::master')
@section('page_header')
    <h1 class="page-title">
        Düz Boyalı
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
<center>
<form method="POST" action="{{ route('cost.store') }}" name="form" id="form">
  @csrf
<table border="1" cellpadding="0" cellspacing="0" width="800" id="table">
   @isset($order_id)<input type="hidden" name="order_id" value="{{ $order_id }}"> @endisset
    @isset($company_id)<input type="hidden" name="company_id" value="{{ $company_id }}"> @endisset
  <input type="hidden" name="article">
  <input type="hidden" name="ordertype_id" value="1">
      <tr>
        <td width="179" height="5"><strong>MÜŞTERİ</strong></td>
        <td height="5" colspan="3" align="left"><input type="text" name="musteri" id="musteri" value=" musteri " size="40" autocomplete="off" required>
      </tr>
      <tr>
        <td height="5"><strong>MÜŞTERİ KODU</strong></td>
        <td width="205" height="5" align="left"><input type="text" name="marticle" id="marticle" value="marticle" size="10" autocomplete="off" required></td>
        <td width="162" align="left"><strong>ARTİKEL KODU</strong></td>
        <td width="244" align="left"><input type="text" name="no" id="no" value="" size="10" autocomplete="off" required></td>
          <input type="hidden" name="article_id" id="article_id">
      </tr>
</table>
<br>
 <table border="1" cellpadding="0" cellspacing="0" width="800" id="dataTtable1">
      <tr>
        <td width="179" height="5"><strong>ÇÖZGÜ NE</strong></td>
        <td width="204" align="left"><input type="text" name="cne" id="cne" value="" size="10" class="required"></td>
        <td width="161" align="left"><strong>ÇÖZGÜ İP FİYATI</strong></td>
        <td width="246" height="5" align="left"><input type="text" name="cif" id="cif" value="" size="10" class="required">
          <select name="cif_kur" id="cif_kur" class="required" size="1">
            @foreach ($exchange as $list)
            <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        </select></td>
      </tr>
      <tr>
        <td><strong>ATKI NE</strong></td>
        <td id="plan_musteri3"><input type="text" name="ane" id="ane" value="" size="10" class="required"></td>
        <td id="plan_musteri3"><strong>ATKI İP FİYATI</strong></td>
        <td height="5" id="plan_musteri3"><input type="text" name="aif" id="aif" value="" size="10" class="required">
          <select name="aif_kur" id="aif_kur" class="required" size="1">
            @foreach ($exchange as $list)
            <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        </select></td>
      </tr>
      <tr>
        <td><strong>ÇÖZGÜ SIK</strong></td>
        <td id="plan_musteri"><input type="text" name="csik" id="csik" value="" size="10" class="required"></td>
      </tr>
      <tr>
        <td><strong>ATKI SIK</strong></td>
        <td id="plan_musteri74"><input type="text" name="asik" id="asik" value="" size="10" class="required"></td>
        <td id="plan_musteri74"><strong>ATKI FİYATI</strong></td>
        <td height="5" id="plan_musteri74"><input type="text" name="aft" id="aft" value="" size="10" class="required">
          <select name="aft_kur" id="aft_kur" class="required" size="1">
            @foreach ($exchange as $list)
            <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        </select> 
          (Kuruş)</td>
      </tr>
      <tr>
        <td><strong>TARAK ENİ</strong></td>
        <td id="plan_musteri65"><input type="text" name="taren" id="taren" value="" size="10" class="required"></td>
        <td id="plan_musteri65"><strong>HAŞIL - ÇÖZGÜ FİYATI</strong></td>
        <td height="5" id="plan_musteri65"><input type="text" name="hcf" id="hcf" value="" size="10" class="required">
          <select name="hcf_kur" id="hcf_kur" class="required" size="1">
            @foreach ($exchange as $list)
            <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        </select>
        (Kuruş)</td>
      </tr>
      <tr>
        <td><strong>TERBİYE MALİYETİ</strong></td>
        <td id="plan_musteri53"><input type="text" name="term" id="term2" value="" size="10">
          <select name="term_kur" id="term_kur" class="required" size="1">
           @foreach ($exchange as $list)
            <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        </select> 
          / Mt</td>
        <td id="plan_musteri53"><strong>VADE FARKI</strong></td>
        <td height="5" id="plan_musteri53"><input type="text" name="vf" id="vf" value="" size="10" autocomplete="off">
%</td>
      </tr>
      <tr>
        <td><strong>EURO &euro;</strong></td>
        <td id="plan_musteri5"><input type="text" name="eur" id="eur" value="" size="10" autocomplete="off">
        EURO</td>
        <td id="plan_musteri5"><strong>KUR GBP</strong></td>
        <td height="5" id="plan_musteri5"><input type="text" name="gbp" id="gbp" value="" size="10" autocomplete="off">
GBP</td>
      </tr>
      <tr>
        <td><strong>DOLAR</strong> $</td>
        <td id="plan_musteri6"><input type="text" name="usd" id="usd" value="" size="10" autocomplete="off">
DOLAR</td>
        <td id="plan_musteri6">&nbsp;</td>
        <td height="5" id="plan_musteri6">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td id="plan_musteri4">&nbsp;</td>
        <td id="plan_musteri4">&nbsp;</td>
        <td height="5" id="plan_musteri4">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>KAR MARJI</strong></td>
        <td id="plan_musteri8"><input type="text" name="kar" id="kar" value="" size="10" class="required">
%</td>
        <td id="plan_musteri8"><strong>TERBİYE FİRESİ</strong></td>
        <td height="5" id="plan_musteri8"><input type="text" name="terf" id="terf" value="" size="10" autocomplete="off">
%</td>
      </tr>
      <tr>
          <td id="plan_musteri7"><strong>ÇÖZGÜ GRAMAJI</strong></td>
          <td height="5" id="plan_musteri7"><input type="hidden" name="cgr" id="cgr" value="" size="10" autocomplete="off">
          </td>
          <td id="plan_musteri69"><strong>ATKI GRAMAJI</strong></td>
          <td height="5" id="plan_musteri69"><input type="hidden" name="agr" id="agr" value="" size="10" autocomplete="off">
          </td>
      </tr>
<? //} ?>
</table>
<br>
<table border="1" cellpadding="0" cellspacing="0" width="800" id="dataTtable">
      
      <tr>
        <td class="ui-state-highlight"><strong>HAM MALİYET</strong></td>
        <td align="center" class="ui-state-highlight"><input type="hidden" name="hamf_eur" id="hamf_eur" value="">
          
          hamf_eur
          EUR</td>
        <td align="center" class="ui-state-highlight"><input type="hidden" name="hamf_usd" id="hamf_usd" value="" size="10">
          
          hamf_usd
          USD</td>
        <td align="center" class="ui-state-highlight"><input type="hidden" name="hamf_gbp" id="hamf_gbp" value="" size="10">
          
          hamf_gbp
          GBP</td>
        <td align="center" class="ui-state-highlight"><input type="hidden" name="hamf_try" id="hamf_try" value="" size="10">
          
          hamf_try
          TL</td>
      </tr>
      <tr bgcolor="#99FF66">
        <td width="179"><strong>HAM SATIŞ FİYATI</strong></td>
        <td width="150" align="center">
          <strong>
          <input type="hidden" name="hamsts_eur" id="hamsts_eur" value="" size="10">          
          
          hamsts_eur EUR          </strong></td>
        <td width="150" align="center">
          <strong>
          <input type="hidden" name="hamsts_usd" id="hamsts_usd" value="" size="10">          
          
          hamsts_usd USD          </strong></td>
        <td width="150" align="center">
          <strong>
          <input type="hidden" name="hamsts_gbp" id="hamsts_gbp" value="" size="10">          
          
          hamsts_gbp GBP          </strong></td>
        <td width="159" align="center">
          <strong>
          <input type="hidden" name="hamsts_try" id="hamsts_try" value="" size="10">          
          
          hamsts_try TL          </strong></td>
      </tr>
      <tr bgcolor="#99FF66">
        <td><strong>MAMÜL SATIŞ FİYATI</strong></td>
        <td align="center"><strong>
          <input type="hidden" name="mamsts_eur" id="mamsts_eur" value="" size="10">
          
          mamsts_eur EUR        </strong></td>
        <td align="center"><strong>
          <input type="hidden" name="mamsts_usd" id="mamsts_usd" value="" size="10">
          
          mamsts_usd USD        </strong></td>
        <td align="center"><strong>
          <input type="hidden" name="mamsts_gbp" id="mamsts_gbp" value="" size="10"> 
          
          mamsts_gbp GBP        </strong></td>
        <td align="center"><strong>
          <input type="hidden" name="mamsts_try" id="mamsts_try" value="" size="10">
          
          mamsts_try TL        </strong></td>
      </tr>
      <tr bgcolor="#FF6600">
        <td><strong>VAD. HAM STŞ FİYATI</strong></td>
        <td align="center">
          <input type="hidden" name="hamvf_eur" id="hamvf_eur" value="" size="10">          
          hamvf_eur EUR </td>
        <td align="center">
          <input type="hidden" name="hamvf_usd" id="hamvf_usd" value="" size="10">          
          hamvf_usd USD </td>
        <td align="center">
          <input type="hidden" name="hamvf_gbp" id="hamvf_gbp" value="" size="10">          
          hamvf_gbp GBP </td>
        <td align="center">
          <input type="hidden" name="hamvf_try" id="hamvf_try" value="" size="10">          
          hamvf_try TL </td>
      </tr>
      <tr bgcolor="#FF6600" >
        <td><strong>VAD. MAMUL STŞ FİYATI</strong></td>
        <td align="center">
          <input type="hidden" name="mamvf_eur" id="mamvf_eur" value="" size="10">          
          mamvf_eur EUR </td>
        <td align="center">
          <input type="hidden" name="mamvf_usd" id="mamvf_usd" value="" size="10">          
          mamvf_usd USD </td>
        <td align="center">
          <input type="hidden" name="mamvf_gbp" id="mamvf_gbp" value="" size="10">          
          mamvf_gbp GBP </td>
        <td align="center">
          <input type="hidden" name="mamvf_try" id="mamvf_try" value="" size="10">          
          mamvf_try TL </td>
      </tr>
      <tr>
        <td height="5" id="noPrint" align="center" valign="top">
          <input type="button" id="btn_hesap" value="Hesapla" name="B1" tabindex="8"> 
          <input type="submit" id="btn_kayit" value="Kaydet" name="B2" tabindex="8">  
        <strong>
        {{-- <input type="hidden" name="articleid" id="articleid" value="$articleid;" size="10" autocomplete="off">
        <input type="hidden" name="islem" id="islem" value="hesap" size="10">
        <input type="hidden" name="tip" id="tip" value="I" size="10">
        <input type="hidden" name="username" id="username" value="$username;" size="10"> --}}
        </strong></td>
      </tr>
  </table>
</form>
@endsection
@section('css')
{{-- <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@endsection
@section('javascript')
{{-- <script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script> --}}
<script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script type="text/javascript"> 
        // $('#article_id').select2();   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
      
      $( "#no" ).autocomplete({
      minLength: 3,
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{ route('cost.article') }}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
              // console.log(data);
               response( data );
            }
          });
        },
        focus:function(event,ui){
                
                $("#no").val(ui.item.label);
                return false;
            },
        select: function (event, ui) {
           // Set selection
           $('#no').val(ui.item.label); // display the selected text
           $('#article_id').val(ui.item.value); // save selected id to input
           // return false;
      asd= ui.item.label;
      sid= ui.item.value;
      // cbf= $("#cbf").val();
      // abf= $("#abf").val();
       if(sid){
            $.ajax({
             type:"get",
             url:'{{url('/cost/data/')}}/'+sid, 
             success:function(res)
             {    
              var kayitSay = res.caglik.length;  
                if(res)
                { 
                // console.log(res); 
                 // $("input[name='cne']").empty(); 
                  for (i=0; i < kayitSay; i++)
                    { 
                     if(res.caglik[i].ac == 'C') {cne=res.caglik[i].ne; $("input[name='cne']").val(cne);}
                     if(res.caglik[i].ac == 'A') {ane=res.caglik[i].ne; $("input[name='ane']").val(res.caglik[i].ne);}
                    }
                    cgr = res.cgr; agr = res.agr; taren =res.taren; csik=res.csik; asik=res.asik; 
                    taren= taren.replace(',','.');
                    // alert(cbf);       
                    cgr=  ((csik*taren)/1.693/cne*1.06*1.03*(100+1));
                    agr=  ((asik*taren)/1.693/ane*1.06*1.03*(100+1));
                 $("input[name='marticle']").val(res.marticle);
                 $("input[name='article']").val(res.no);
                 $("input[name='taren']").val(res.taren);
                 $("input[name='cgr']").val(cgr.toFixed(2));
                 $("input[name='agr']").val(agr.toFixed(2));
                 $("label[name='cgr']").text(cgr.toFixed(2));
                 $("label[name='agr']").text(agr.toFixed(2));
                 $("input[name='csik']").val(csik);
                 $("input[name='asik']").val(asik);
                }
                        
           }
         });
        }
        },
        close:function(event,ui){
                $("#no").val(asd);
                return false;
            }
      });

    });
  </script>
  @endsection