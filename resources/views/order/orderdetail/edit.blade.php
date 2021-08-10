@extends('voyager::master')
@section('page_header')
    <h1 class="page-title">
        Sipariş Detayı
    </h1>
@stop
@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="POST" action="{{ route('orderdetail.update',$orderdetail->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Sipariş No') }}</label>
                            <div class="col-md-6">
                            <label for="name" class="col-form-label">{{$orderdetail->order->no ?? ''}}</label>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Müşteri') }}</label>
                            <div class="col-md-6">
                            <label for="name" class="col-form-label">{{$orderdetail->order->company->name ?? ''}}</label>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Article') }}</label>
          <input type="hidden" name="article_id" id="article_id" value="{{$orderdetail->article_id ?? ''}}">
                            <div class="col-md-6">
                            	<input type="hidden" name="order_id" value="{{$orderdetail->order->id}}">
                                <input id="no" type="text" class="form-control @error('no') is-invalid @enderror" name="no" required autocomplete="no" value="{{$orderdetail->article->no ?? ''}}  " autofocus>
                                @error('no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="marticle" class="col-md-4 col-form-label text-md-right">{{ ('Müşteri Article') }}</label>

                            <div class="col-md-6">
                                <input id="marticle" type="text" class="form-control @error('marticle') is-invalid @enderror" name="marticle" autocomplete="marticle" value="{{$orderdetail->marticle ?? ''}}" autofocus>

                                @error('marticle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="color" class="col-md-4 col-form-label text-md-right">{{ ('Renk') }}</label>

                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" autocomplete="color" value="{{$orderdetail->color ?? ''}}" autofocus>

                                @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="const" class="col-md-4 col-form-label text-md-right">{{ ('Konstrüksiyon ') }}</label>

                            <div class="col-md-6">
                                <input id="const" type="text" class="form-control @error('const') is-invalid @enderror" name="const" autocomplete="const" value="{{$orderdetail->const ?? ''}}" autofocus>

                                @error('const')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finishwidth" class="col-md-4 col-form-label text-md-right">{{ ('Mamul En- Komp.') }}</label>

                            <div class="col-md-4">
                                <input id="finishwidth" type="number" class="form-control @error('finishwidth') is-invalid @enderror" name="finishwidth" placeholder="Mamul En"  autocomplete="finishwidth" value="{{$orderdetail->finishwidth ?? ''}}" autofocus>

                                @error('finishwidth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                              <div class="col-md-2">
                                <input id="bil" type="text" class="form-control @error('bil') is-invalid @enderror" name="bil"  autocomplete="bil" placeholder="Komp" value="{{$orderdetail->bil ?? ''}}" autofocus>

                                @error('bil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finishmt" class="col-md-4 col-form-label text-md-right">{{ ('Sipariş Miktarı') }}</label>

                            <div class="col-md-6">
                                <input id="finishmt" type="number" class="form-control @error('finishmt') is-invalid @enderror" name="finishmt" autocomplete="finishmt" value="{{$orderdetail->finishmt ?? ''}}" autofocus>

                                @error('finishmt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deadline" class="col-md-4 col-form-label text-md-right">{{ ('Termin') }}</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" autocomplete="deadline" value="{{$orderdetail->deadline ?? ''}}" autofocus>

                                @error('deadline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="orderkind_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Türleri') }}</label>

                                <div class="col-md-6">
                                    <select name='orderkind_id' id="orderkind_id" class="form-control @error('orderkind_id') is-invalid @enderror">
                                        <option value="{{$orderdetail->orderkind_id ?? ''}} ">{{$orderdetail->orderkind->name ?? ''}} </option>
                                        @foreach ($orderkind as $list)
                                        <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('orderkind_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                        <div class="form-group row">
                            <label for="graywidth" class="col-md-4 col-form-label text-md-right">{{ ('Ham en') }}</label>

                            <div class="col-md-6">
                                <input id="graywidth" type="number" class="form-control @error('graywidth') is-invalid @enderror" name="graywidth" autocomplete="graywidth" value="{{$orderdetail->graywidth ?? ''}}" autofocus>

                                @error('graywidth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="graymt" class="col-md-4 col-form-label text-md-right">{{ ('Ham Sipariş Miktarı') }}</label>

                            <div class="col-md-6">
                                <input id="graymt" type="number" class="form-control @error('graymt') is-invalid @enderror" name="graymt" autocomplete="graymt" value="{{$orderdetail->graymt ?? ''}}" autofocus>

                                @error('graymt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="graydeadline" class="col-md-4 col-form-label text-md-right">{{ ('Ham Sipariş Termini') }}</label>

                            <div class="col-md-6">
                                <input id="graydeadline" type="date" class="form-control @error('graydeadline') is-invalid @enderror" name="graydeadline" autocomplete="graydeadline" value="{{$orderdetail->graydeadline ?? ''}}" autofocus>

                                @error('graydeadline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ ('Fiyat-Kur-Vade') }}</label>

                            <div class="col-md-2">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="fiyat"  autocomplete="price" value="{{$orderdetail->price ?? ''}}" autofocus>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                             <div class="col-md-2">
                                    <select name='exchange_id' id="exchange_id" class="form-control @error('exchange_id') is-invalid @enderror">
                                        <option value="{{$orderdetail->exchange_id ?? ''}} ">{{$orderdetail->exchange->name ?? ''}} </option>
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
                            <div class="col-md-2">
                                <input id="maturity" type="text" class="form-control @error('maturity') is-invalid @enderror" name="maturity" placeholder="vade"  autocomplete="maturity" value="{{$orderdetail->maturity ?? ''}}" autofocus>

                                @error('maturity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ ('Ödeme Şekli') }}</label>

                            <div class="col-md-2">
                                <select name='payment_exchange_id' id="payment_exchange_id" class="form-control @error('payment_exchange_id') is-invalid @enderror">
                                        <option value="{{$orderdetail->payment_exchange_id ?? ''}} ">{{$orderdetail->paymentexchange->name ?? ''}} </option>
                                        @foreach ($exchange as $list)
                                        <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_exchange_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                            </div>
                             <div class="col-md-2">
                                    <select name='pricetype_id' id="pricetype_id" class="form-control @error('pricetype_id') is-invalid @enderror">
                                        <option value="{{$orderdetail->pricetype_id ?? ''}} ">{{$orderdetail->pricetype->name ?? ''}} </option>
                                        @foreach ($pricetype as $list)
                                        <option value="{{$list->id}}" >{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pricetype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            <div class="col-md-2">
                                <input id="paymentexplanation" type="text" class="form-control @error('paymentexplanation') is-invalid @enderror" name="paymentexplanation"   autocomplete="paymentexplanation" value="{{$orderdetail->paymentexplanation ?? ''}}" autofocus>

                                @error('paymentexplanation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="test" class="col-md-4 col-form-label text-md-right">{{ ('Test') }}</label>

                            <div class="col-md-6">
                                <input id="test" type="text" class="form-control @error('test') is-invalid @enderror" name="test" autocomplete="test" value="{{$orderdetail->test ?? ''}}" autofocus>

                                @error('test')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Kaydet') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<style type="text/css">
    li{
        list-style-type:none; 
    }
</style>
@endsection
@section('javascript')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script type="text/javascript">
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
    
        },
        close:function(event,ui){
                $("#no").val(asd);
                return false;
            }
      });

    });
</script>
@endsection