@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="POST" action="{{ route('yarn.store') }}" id="form">
                        @csrf
                         <div class="form-group row">
                            <label for="movementkind_id"  class="col-md-4 col-form-label text-md-right">{{ __('Hareket Türü') }}</label>

                            <div class="col-md-6">
                                <select name='movementkind_id' id="movementkind_id" class="form-control @error('movementkind_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($movementkind as $list)
                                    <option value="{{$list->id}}" id="movementkind_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('movementkind_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row" name="giris">
                            <label for="companytype_id"  class="col-md-4 col-form-label text-md-right">{{ __('Sevk Tipi') }}</label>

                            <div class="col-md-6">
                                <select name='companytype_id' id="companytype_id" class="form-control @error('companytype_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
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
                         <div class="form-group row" name="yarntwist">
                            <label for="yarntwist_id" class="col-md-4 col-form-label text-md-right">{{ __('Büküm Talimatı') }}</label>

                            <div class="col-md-6">
                                <select name='yarntwist_id' id="yarntwist_id" class="form-control  @error('yarntwist_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($yarntwist as $list)
                                    <option value="{{$list->id}}" class="{{$list->company_id ?? ''}}-{{$list->company->name}}" name="{{$list->order_id ?? ''}}{{$list->order->no ?? ''}} ">S.N.{{$list->order->no ?? ''}} {{$list->no ?? '' }} {{$list->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('yarntwist_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row" name="yarnpaint">
                            <label for="yarnpaint_id" class="col-md-4 col-form-label text-md-right">{{ __('İplik Boya Talimatı') }}</label>

                            <div class="col-md-6">
                                <select name='yarnpaint_id' id="yarnpaint_id" class="form-control  @error('yarnpaint_id') is-invalid @enderror" >
                                    <option value="">Seçiniz..</option>
                                    @foreach ($yarnpaint as $list)
                                    <option value="{{$list->id}}" class="{{$list->company_id ?? ''}} {{$list->company->name ?? ''}}" name="{{$list->order_id.'-'}}{{$list->order->no ?? ''}} ">S.N.{{$list->order->no ?? ''}}-{{$list->no}} {{$list->company->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('yarnpaint_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                         <div class="form-group row" name="giris">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                            <div class="col-md-6">
                                <select name='company_id' id="company_id" class="form-control  @error('company_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($company as $list)
                                    <option value="{{$list->id}}" >{{$list->name}}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                    
                        <div class="form-group row" name="giris">
                            <label for="order_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş') }}</label>

                            <div class="col-md-6">
                                <select name='order_id' id="order_id" class="form-control  @error('order_id') is-invalid @enderror" required>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($order as $list)
                                    <option value="{{$list->id}}">{{$list->no ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ 'Gerekli' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row" name="logindate">
                            <label for="logindate" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                            <div class="col-md-6">

                                <input id="logindate" type="date" class="form-control @error('logindate') is-invalid @enderror" name="logindate" value="{{ old('logindate') }}"  autocomplete="logindate" autofocus>
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

                                <input id="outdate" type="date" class="form-control @error('outdate') is-invalid @enderror" name="outdate" value="{{ old('outdate') }}" autocomplete="outdate" autofocus>
                                @error('outdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                       
                        <div class="form-group row" name="logindate">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Fiyat') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="logindate">
                            <label for="exchange_id" class="col-md-4 col-form-label text-md-right">{{ __('Döviz Cinsi') }}</label>

                            <div class="col-md-6">
                                <select name='exchange_id' class="form-control  @error('exchange_id') is-invalid @enderror" >
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
                        <div class="form-group row" name="logindate">
                            <label for="barcode_piece" class="col-md-4 col-form-label text-md-right">{{ __('Barkod Adet') }}</label>

                            <div class="col-md-6">
                                <input id="barcode_piece" type="text" class="form-control @error('barcode_piece') is-invalid @enderror" name="barcode_piece" value="{{ old('barcode_piece') }}"  autocomplete="barcode_piece" autofocus>

                                @error('barcode_piece')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="dispatchno" class="col-md-4 col-form-label text-md-right">{{ __('İrsaliye No') }}</label>

                            <div class="col-md-6">
                                <input id="dispatchno" type="text" {{-- minlength="9" --}} class="form-control @error('dispatchno') is-invalid @enderror" name="dispatchno" value="{{ old('dispatchno') }}"  autocomplete="dispatchno" autofocus>

                                @error('dispatchno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="invoiceno" class="col-md-4 col-form-label text-md-right">{{ __('Fatura No') }}</label>

                            <div class="col-md-6">
                                <input id="invoiceno" type="text" minlength="9" class="form-control @error('invoiceno') is-invalid @enderror" name="invoiceno" value="{{ old('invoiceno') }}"  autocomplete="invoiceno" autofocus>

                                @error('invoiceno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" name="giris">
                            <label for="explanation" class="col-md-4 col-form-label text-md-right">{{ __('Açıkklama') }}</label>
                            <div class="col-md-6">
                               <textarea id="explanation" type="text" class="form-control"  name="explanation" id="explanation" autocomplete="explanation" autofocus>
                               </textarea>
                           </div>
                       </div> 
                       <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
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
</div>
    </div>
</div>
</div>
@endsection

@section('css') 
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('javascript')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
     $( function() 
    { 
        $("div[name*='giris'],div[name='order_id'],div[name*='logindate'],div[name*='outdate'],div[name='yarntwist'],div[name='yarnpaint'],div[name='cozgu']").hide();

       $('#movementkind_id').change(function(){
              
            if($('#movementkind_id option:selected').text() == 'GİRİŞ')
            { 
                $("div[name*='logindate'],div[name*='giris'],div[name='order_id']").show();
                $("#order_id").prop('required', true);
                $("div[name*='outdate']").hide();

                $('#companytype_id').change(function(){
                     if (($('#companytype_id option:selected').text()) =='BÜKÜM')
                        {
                        $("div[name='yarntwist']").show();
                        $("div[name='cozgu'],div[name='yarnpaint_id']").hide();
                        $("#yarntwist_id").prop('required', true);
                        $("#cozgu_id, #yarnpaint_id").prop('required',false);
                        }
                    else if (($('#companytype_id option:selected').text()) =='ÇÖZGÜ')
                        {
                        $("div[name='cozgu']").show();
                        $("div[name='yarntwist'],div[name='yarnpaint']").hide();
                        $("#cozgu_id").prop('required', true);
                        $("#yarntwist_id, #yarnpaint_id").prop('required',false);
                        }
                    else if (($('#companytype_id option:selected').text()) =='İPLİK BOYAHANE')
                        {
                        $("div[name='yarnpaint']").show();
                        $("div[name='yarntwist'],div[name='cozgu']").hide();
                        $("#yarnpaint_id").prop('required', true);
                        $("#cozgu_id, #yarntwist_id").prop('required',false);
                        }
                    else if (($('#companytype_id option:selected').text()) =='MÜŞTERİ')
                        {
                        $("div[name='cozgu'],div[name='yarnpaint'],div[name='yarntwist']").hide();
                        $("div[name='order_id']").show();
                        $("#cozgu_id, #yarnpaint_id ,#yarntwist_id,#order_id").prop('required',false);   
                        }
                    else        
                        {
                        $("div[name='cozgu'],div[name='yarnpaint'],div[name='yarntwist']").hide();
                        $("div[name='order_id']").show();
                        $("#order_id").prop('required', true);
                        $("#cozgu_id, #yarnpaint_id ,#yarntwist_id").prop('required',false);
                        }
                });

            }
            else if ($('#movementkind_id option:selected').text() == 'ÇIKIŞ')
            {
               $("div[name*='outdate'],div[name*='giris'],div[name='order_id']").show();
               $("#order_id").prop('required', true);
               $("div[name*='logindate']").hide();

               $('#companytype_id').change(function(){
                    if (($('#companytype_id option:selected').text()) =='BÜKÜM')
                        {
                        $("div[name='yarntwist']").show();
                        $("div[name='cozgu'],div[name='yarnpaint_id']").hide();
                        $("#yarntwist_id").prop('required', true);
                        $("#cozgu_id, #yarnpaint_id").prop('required',false);
                        }
                    else if (($('#companytype_id option:selected').text()) =='ÇÖZGÜ')
                        {
                        $("div[name='cozgu']").show();
                        $("div[name='yarntwist'],div[name='yarnpaint']").hide();
                        $("#cozgu_id").prop('required', true);
                        $("#yarntwist_id, #yarnpaint_id").prop('required',false);
                        }
                    else if (($('#companytype_id option:selected').text()) =='İPLİK BOYAHANE')
                        {
                        $("div[name='yarnpaint']").show();
                        $("div[name='yarntwist'],div[name='cozgu']").hide();
                        $("#yarnpaint_id").prop('required', true);
                        $("#cozgu_id, #yarntwist_id").prop('required',false);
                        }
                     else if (($('#companytype_id option:selected').text()) =='MÜŞTERİ')
                        {
                        $("div[name='cozgu'],div[name='yarnpaint'],div[name='yarntwist']").hide();
                        $("div[name='order_id']").show();
                        $("#order_id").prop('required', true);
                        $("#cozgu_id, #yarnpaint_id ,#yarntwist_id").prop('required',false);   
                        }   
                    else        
                        {
                        $("div[name='cozgu'],div[name='yarnpaint'],div[name='yarntwist']").hide();
                        $("div[name='order_id']").show();
                        $("#order_id").prop('required', true);
                        $("#cozgu_id, #yarnpaint_id ,#yarntwist_id").prop('required',false);
                        }
                });
            }
        });

     
       $('#yarntwist_id,#yarnpaint_id,#cozgu_id').change(function(){
           val=  $(this).find('option:selected').attr('class');
           id= val.split("-");
           $("select[name='company_id']").append('<option value="'+id[0]+'" selected> '+id[1]+'</option>'); 
           valorder=  $(this).find('option:selected').attr('name');
           orderid= valorder.split("-");
           $("select[name='order_id']").append('<option value="'+orderid[0]+'" selected> '+orderid[1]+'</option>'); 
       });
   });

$( function() {
    $('#company_id,#order_id,#yarntwist_id,#yarnpaint_id,#cozgu_id').select2({ width: '320px' });
});


</script>
@endsection