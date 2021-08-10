@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('yarn.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="POST" action="{{ route('yarn.update', $yarn->id) }}">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" id="movementkind_id" value="{{$yarn->movementkind_id}}">                            
                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='company_id' class="form-control  @error('company_id') is-invalid @enderror" >
                                    <option value="@isset($yarn->company_id){{$yarn->company_id}}@endisset">@isset($yarn->company->name){{$yarn->company->name}}@endisset</option>
                                    @foreach ($company as $list)
                                    <option value="{{$list->id}}" id="company_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' class="form-control  @error('order_id') is-invalid @enderror" >
                                    <option value="@isset($yarn->order_id){{$yarn->order_id}}@endisset">@isset($yarn->order->no){{$yarn->order->no}}@endisset</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}" id="order_id">{{$list->no}}</option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="iplikdepo">
                            <label for="companytype_id" class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tipi') }}</label>

                            <div class="col-md-6">
                                <select name='companytype_id' class="form-control  @error('companytype_id') is-invalid @enderror" >
                                    <option value="@isset($yarn->companytype_id){{$yarn->companytype_id}}@endisset">@isset($yarn->companytype->name){{$yarn->companytype->name}}@endisset</option>
                                    @foreach ($companytype as $list)
                                    <option value="{{$list->id}}" id="companytype_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('companytype_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="logindate">
                            <label for="logindate" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="logindate" type="date" class="form-control @error('logindate') is-invalid @enderror" name="logindate" value="@if ($yarn->logindate){{ date('Y-m-d',strtotime($yarn->logindate))}}@endif"  autocomplete="logindate" autofocus>
                                @error('logindate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="outdate">
                            <label for="outdate" class="col-md-4 col-form-label text-md-right">{{ __('Çıkış Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="outdate" type="date" class="form-control @error('outdate') is-invalid @enderror" name="outdate" value="@if ($yarn->outdate){{ date('Y-m-d',strtotime($yarn->outdate))}}@endif" autocomplete="outdate" autofocus>
                                @error('outdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="cikis">
                            <label for="barcode_piece" class="col-md-4 col-form-label text-md-right">{{ ('Barkod Adeti') }}</label>

                            <div class="col-md-6">
                                <input id="barcode_piece" type="text" class="form-control @error('barcode_piece') is-invalid @enderror" name="barcode_piece"  autocomplete="barcode_piece" value="{{$yarn->barcode_piece}}" autofocus>

                                @error('barcode_piece')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="cikis">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ ('Fiyat') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price"  autocomplete="price" value="{{$yarn->price}}" autofocus>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" name="cikis">
                            <label for="exchange_id" class="col-md-4 col-form-label text-md-right">{{ __('Döviz Cinsi') }}</label>

                            <div class="col-md-6">
                                <select name='exchange_id' class="form-control  @error('exchange_id') is-invalid @enderror" >
                                    <option value="{{$yarn->exchange_id}}">{{$yarn->exchange->name ?? ''}}</option>
                                    @foreach ($exchange as $list)
                                    <option value="{{$list->id}}" id="exchange_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('exchange_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dispatchno" class="col-md-4 col-form-label text-md-right">{{ ('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="dispatchno" type="text" class="form-control @error('dispatchno') is-invalid @enderror" name="dispatchno"  autocomplete="dispatchno" value="{{$yarn->dispatchno}}" autofocus>

                                @error('dispatchno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="invoiceno" class="col-md-4 col-form-label text-md-right">{{ ('Fatura No') }}</label>

                            <div class="col-md-6">
                                <input id="invoiceno" type="text" class="form-control @error('invoiceno') is-invalid @enderror" name="invoiceno"  autocomplete="invoiceno" value="{{$yarn->invoiceno}}" autofocus>

                                @error('invoiceno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="explanation" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="explanation" type="text" class="form-control"  name="explanation"  autocomplete="explanation" autofocus>{{$yarn->explanation}}
                               </textarea>
                           </div>
                       </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Güncelle') }}
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
@section('javascript')
<script type="text/javascript">
    $( function() { 
     
       var movementkind_id= $('#movementkind_id').val();
       if (movementkind_id == 1)
       {
           $("div[name*='outdate']").hide();
       }
       else if(movementkind_id == 2)
       {
           $("div[name*='cikis']").hide()
           $("div[name*='logindate']").hide();   
       }
       else alert('Hatalı!! Yetkili ile iletişime geçiniz...');
   });
</script>
@endsection