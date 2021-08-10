@extends('voyager::master')

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
<center>

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
               <table id="table" class="table-striped table-hover table-sm">
        <tr>
          <td rowspan="10"><img src="{{ Storage::url('icons/logo.png') }}" alt="Smiley face" height="87" width="63"></td>
        <td width="90%" rowspan="80" align="center" valign="middle"><strong>SİPARİŞ DETAYLARI</strong></td>
            
        </tr>
     </table>   
          
      
     <table class="table-striped table-hover table-sm" border="1" >
      <tr>
        <td width="184" align="center"><div align="center"><strong>Sipariş Numarası</strong></div></td>
        <td width="184" align="center"><div align="center"><strong>Firma Adı</strong></div></td>
        <td width="184" align="center"><div align="center"><strong>Firma Yetkilisi</strong></div></td>
        <td width="184" align="center"><div align="center"><strong>Sipariş Tarihi</strong></div></td>
       </tr>

       <tr>
        <td><div align="center">
          {{$order->no ?? ''}}
        </div></td>
        <td><div align="center">
          {{$order->company->name ?? ''}}
        </div></td>
        <td><div align="center">
          {{$order->authorized->name ?? ''}}
        </div></td>
        <td><div align="center">
          {{$order->date ?? ''}}
        </div></td>

      </tr>
      </table>  
      @isset($order->explanation)
      <table class="table-striped table-hover table-sm" border="1" >
      <tr>
        <td width="736" align="center"><div align="center"><strong>Sipariş Açıklaması</strong></div></td>
        </tr>
    </table> 
    <table class="table-striped table-hover table-sm" border="1" >
        @foreach ($order->explanation as $message)
      <tr >
        <td width="115" align="center"><div align="center"><strong>{{$message->type ?? ''}}</strong></div></td>
        <td width="620" align="center"><div align="center"><strong>{{$message->text ?? ''}}</strong></div></td>
        </tr>
        @endforeach
        
    </table>  @endisset

   @isset($order->orderdetail)
   <table class="table-striped table-hover table-sm" border="1">
          <thead align="center">
            <tr>
            <th>Kaynak Article</th>
            <th>Müşteri Article</th>
            <th>Konstrüksüyon</th>
            <th>Renk</th>
            <th>Sipariş Miktarı</th>
            <th>Teslim Tarihi</th>
            <th>Fiyat/Vade</th>
            <th></th>
            </tr>
          </thead>
          <tbody align="center">
            @foreach($order->orderdetail as $list)
            <tr>
              <td>@if(isset($list->article->no)) <a href="{{url('article',$list->article_id)}}">{{$list->article->no}} </a> @elseif(isset($list->patterndetail_id)) newpattern @endif  </td>
              <td>{{$list->marticle}} </td>
              <td>{{$list->const}} </td>
              <td>{{$list->color}} </td>
              <td>{{$list->finishmt}} </td>
              <td>{{$list->deadline}} </td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endisset

<br>
<table class="table-striped table-hover table-sm" border="1" >
      <tr>
        <td></td>
        <td width="736" align="center"><div align="center"><strong>Sipariş Maddeleri</strong></div></td>
     </tr>
        @foreach ($order->orderitem as $clauses)
            <tr>                                
              <td>{{$loop->iteration}} </td>
                <td>{{ $clauses->contractitem->turkce  ?? ''}}</td>
            </tr>
        @endforeach
</table>
    


@endsection    

@section('css')
    <style type="text/css">
      td:hover {background:#FF7F50}
        th { font-size: 12px; }
        td {
             font-size: 12px; 
            font-weight: bold;
        }
    </style>
@endsection