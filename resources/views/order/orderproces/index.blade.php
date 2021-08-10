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
      <form method="POST" action="{{ route('orderproces.store')}} ">
                        @csrf
                        <div id="ww">
                        <input type="hidden" name="order_id" value="{{$order->id}} ">    
                        <div class="float-left">
                            @foreach($costtype->whereIn('id',[1,2,3,4,5,6,7]) as $list)
                                <label for="exchange_id" class="col-md-4 col-form-label text-md-right">{{ $list->text  ?? ''}}</label>
                              <div class="col-md-4">
                                    <input id="{{$list->id ?? ''}}" type="number" class="form-control" name="number[{{$list->id ?? ''}}]"  autocomplete="{{$list->id ?? ''}}" autofocus placeholder="@if($list->id==3)kg @elseif($list->id==4)mt @elseif($list->id == 5) % @elseif($list->id == 6) % @elseif($list->id == 7) %  @endif" value="{{$order->costprices->where('costtype_id',$list->id)->pluck('amount')->first()}}">  
                                </div>
                                <div class="col-md-4">
                                    <select name='exchange_id[{{$list->id}}]' id="exchange_id" class="form-control @error('exchange_id') is-invalid @enderror">
                                        <option value="{{$order->costprices->where('costtype_id',$list->id)->pluck('exchange_id')->first()}}">{{$order->costprices->where('costtype_id',$list->id)->pluck('exchange.name')->first()}} </option>
                                        <option value="">Seçiniz..</option>
                                        @foreach ($exchange as $list)
                                        <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('exchange_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br>
                            @endforeach
                                <label for="company_id" class="col-md-4 col-form-label text-md-left">{{ __('Sanfor Değeri?') }}</label>
                              <div class="col-md-8">
                                  <input type="number" step="0.001" id="sanfor" class="form-control" name="sanfor" value="{{$order->orderproces->sanfor ?? ''}}">
                              </div>
                              <label for="company_id" class="col-md-4 col-form-label text-md-left">{{ __('Sanfor Test Şekli?') }}</label>
                              <div class="col-md-8">
                                  <input type="text" id="sanfortest" class="form-control" name="sanfortest" value="{{$order->orderproces->sanfortest ?? ''}} ">
                              </div>
                              <label for="company_id" class="col-md-4 col-form-label text-md-left">{{ __('Tuşe Özellikleri?') }}</label>
                              <div class="col-md-8">
                                  <input type="text" id="touchfeature" class="form-control" name="touchfeature"  value="{{$order->orderproces->touchfeature ?? ''}} ">
                              </div>
                                </div>
                        <div class="float-right">

                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('İplik Boya Prosesi') }}</label>
                              <div class="col-md-6">
                                    <select name='colortype_id' id="colortype_id" class="form-control @error('colortype_id') is-invalid @enderror">
                                        <option value="{{$order->orderproces->colortype_id ?? ''}}">{{$order->orderproces->colortype->name ?? ''}} </option>
                                        <option value="">Seçiniz..</option>
                                        @foreach ($colortype as $list)
                                        <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('colortype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br><br>
                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('Şardon Varmı ?') }}</label>
                              <div class="col-md-6">
                                @if(empty($order->orderproces->sardon))
                                  <input type="checkbox" id="sardon" name="sardon" value="sardon">
                                @elseif($order->orderproces->sardon==1)
                                  <input type="checkbox" id="sardon" name="sardon" value="sardon" checked="">
                                  @else
                                  <input type="checkbox" id="sardon" name="sardon" value="sardon">
                                  @endif
                              </div>
                                <br><br>
                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('Liza Varmı ?') }}</label>
                              <div class="col-md-6">
                                @if(empty($order->orderproces->liza))
                                  <input type="checkbox" id="liza" name="liza" value="liza">
                                @elseif($order->orderproces->liza==1)
                                  <input type="checkbox" id="liza" name="liza" value="liza" checked="">
                                  @else
                                  <input type="checkbox" id="liza" name="liza" value="liza">
                                  @endif
                              </div>
                                <br><br>
                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('Lycra Varmı ?') }}</label>
                              <div class="col-md-6">
                                @if(empty($order->orderproces->lycra))
                                <input type="checkbox" id="lycra" name="lycra" value="lycra">
                                 @elseif($order->orderproces->lycra==1)
                                  <input type="checkbox" id="lycra" name="lycra" value="lycra" checked="">
                                  @else
                                <input type="checkbox" id="lycra" name="lycra" value="lycra">
                                @endif
                              </div>
                                <br><br>
                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('Gofre Varmı ?') }}</label>
                              <div class="col-md-6">
                                @if(empty($order->orderproces->gofre))
                                  <input type="checkbox" id="gofre" name="gofre" value="gofre">
                                @elseif($order->orderproces->gofre==1)
                                  <input type="checkbox" id="gofre" name="gofre" value="gofre" checked="">
                                  @else
                                  <input type="checkbox" id="gofre" name="gofre" value="gofre">
                                  @endif
                              </div>
                                <br><br>
                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('Bitim İşlemi') }}</label>
                              <div class="col-md-6">
                                    <select name='finishproces_id' id="finishproces_id" class="form-control @error('finishproces_id') is-invalid @enderror">
                                        <option value="{{$order->orderproces->finishproces_id ?? ''}}">{{$order->orderproces->finishproces->name ?? ''}} </option>
                                        <option value="">Seçiniz..</option>
                                        @foreach ($finishproces as $list)
                                        <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('finishproces_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br><br>
                                <label for="company_id" class="col-md-6 col-form-label text-md-left">{{ __('Parça Yıkama Varmı?') }}</label>
                              <div class="col-md-6">
                                @if(empty($order->orderproces->partwash))
                                  <input type="checkbox" id="partwash" name="partwash" value="partwash">
                                @elseif($order->orderproces->partwash==1)
                                  <input type="checkbox" id="partwash" name="partwash" value="partwash" checked="">
                                  @else
                                  <input type="checkbox" id="partwash" name="partwash" value="partwash">
                                  @endif
                              </div>
                                <br><br>
                            </div>
                             <div class="col-md-12 offset-md-6">
                            <span class="inputname">
                            <a href="#" style="color: black" class="ekle">Açıklama Ekle</a>
                        </span>
                            <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Ekle') }}
                            </button>
                        </div>
                </div>
      </form>                        

</div>
</div>
</div>
</div>
</center>
</div>
@endsection    

@section('css')
    <style type="text/css">
     li{
        list-style-type:none; 
    }
    </style>
@endsection
@section('javascript')
<script type="text/javascript">
   $('.ekle').click(function(e) {
        e.preventDefault();

        $("#ww").append(
            '<li><div class="form-group row">'
            + '<label  class="col-md-4 col-form-label text-md-right">{{ __('Açıklama Tipi - Açıklama') }}</label>'
            + '<div class="col-md-6">'
            + '<input class="form-control" name="type[]" required>'
            + '<textarea class="form-control" name="text[]"></textarea>'
            + '</div>'
            + '<a href="#" class="remove">X</a>'
            + '</div>'
            + '</li>');
    });
$('#ww').on('click', '.remove', function(e) {
    e.preventDefault();
    $(this).parent().remove();
});
</script>
@endsection