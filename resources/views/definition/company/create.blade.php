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
                    <form method="POST" action="{{ route('company.store') }}">
                        @csrf
                        <div id="ww">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Firma Adı') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="companytype_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Tipi') }}</label>

                                <div class="col-md-6">
                                    <select name='companytype_id' class="form-control  @error('companytype_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($companytype as $list)
                                        <option value="{{$list->id}}" id="companytype_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('companytype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="unvan" class="col-md-4 col-form-label text-md-right">{{ __('Ünvan') }}</label>

                                <div class="col-md-6">

                                    <input id="unvan" type="text" class="form-control @error('unvan') is-invalid @enderror" name="unvan" value="{{ old('unvan') }}"  autocomplete="unvan" autofocus placeholder="unvan">
                                    @error('unvan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="vergidairesi" class="col-md-4 col-form-label text-md-right">{{ __('Vergi Dairesi') }}</label>

                                <div class="col-md-6">

                                    <input id="vergidairesi" type="text" class="form-control @error('vergidairesi') is-invalid @enderror" name="vergidairesi" value="{{ old('vergidairesi') }}"  autocomplete="vergidairesi" autofocus placeholder="vergidairesi">
                                    @error('vergidairesi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="verginumarasi" class="col-md-4 col-form-label text-md-right">{{ __('Vergi Numarasi') }}</label>

                                <div class="col-md-6">

                                    <input id="verginumarasi" type="text" class="form-control @error('verginumarasi') is-invalid @enderror" name="verginumarasi" value="{{ old('verginumarasi') }}"  autocomplete="verginumarasi" autofocus placeholder="verginumarasi">
                                    @error('verginumarasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tel1" class="col-md-4 col-form-label text-md-right">{{ __('Telefon 1') }}</label>

                                <div class="col-md-6">

                                    <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ old('tel1') }}"  autocomplete="tel1" autofocus placeholder="5554443321">
                                    @error('tel1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tel2" class="col-md-4 col-form-label text-md-right">{{ __('Telefon 2') }}</label>

                                <div class="col-md-6">

                                    <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2" value="{{ old('tel2') }}"  autocomplete="tel2" autofocus placeholder="5554443321">
                                    @error('tel2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="fax1" class="col-md-4 col-form-label text-md-right">{{ __('Fax 1') }}</label>

                                <div class="col-md-6">

                                    <input id="fax1" type="text" class="form-control @error('fax1') is-invalid @enderror" name="fax1" value="{{ old('fax1') }}"  autocomplete="fax1" autofocus placeholder="5554443321">
                                    @error('fax1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="fax2" class="col-md-4 col-form-label text-md-right">{{ __('Fax 2') }}</label>

                                <div class="col-md-6">

                                    <input id="fax2" type="text" class="form-control @error('fax2') is-invalid @enderror" name="fax2" value="{{ old('fax2') }}"  autocomplete="fax2" autofocus placeholder="5554443321">
                                    @error('fax2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email1" class="col-md-4 col-form-label text-md-right">{{ __('Email 1') }}</label>

                                <div class="col-md-6">

                                    <input id="email1" type="text" class="form-control @error('email1') is-invalid @enderror" name="email1" value="{{ old('email1') }}"  autocomplete="email1" autofocus placeholder="asd@gmail.com">
                                    @error('email1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="email2" class="col-md-4 col-form-label text-md-right">{{ __('Email 2') }}</label>

                                <div class="col-md-6">

                                    <input id="email2" type="text" class="form-control @error('email2') is-invalid @enderror" name="email2" value="{{ old('email2') }}"  autocomplete="email2" autofocus placeholder="asd@gmail.com">
                                    @error('email2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="banka" class="col-md-4 col-form-label text-md-right">{{ __('Banka') }}</label>

                                <div class="col-md-6">

                                    <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" value="{{ old('banka') }}"  autocomplete="banka" autofocus placeholder="banka">
                                    @error('banka')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="sube" class="col-md-4 col-form-label text-md-right">{{ __('Şube') }}</label>

                                <div class="col-md-6">

                                    <input id="sube" type="text" class="form-control @error('sube') is-invalid @enderror" name="sube" value="{{ old('sube') }}"  autocomplete="sube" autofocus placeholder="sube">
                                    @error('sube')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="hesapno" class="col-md-4 col-form-label text-md-right">{{ __('Hesapno') }}</label>

                                <div class="col-md-6">

                                    <input id="hesapno" type="text" class="form-control @error('hesapno') is-invalid @enderror" name="hesapno" value="{{ old('hesapno') }}"  autocomplete="hesapno" autofocus placeholder="hesapno">
                                    @error('hesapno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="iban" class="col-md-4 col-form-label text-md-right">{{ __('İban No') }}</label>

                                <div class="col-md-6">

                                    <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" value="{{ old('iban') }}"  autocomplete="iban" autofocus placeholder="iban">
                                    @error('iban')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                                <div class="col-md-6">

                                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}"  autocomplete="website" autofocus placeholder="www.asd.com">
                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="status_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='status_id' class="form-control @error('status_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($status as $list)
                                        <option value="{{$list->id}}" id="status_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="yesno_id" class="col-md-4 col-form-label text-md-right">{{ __('Tesis Mi ?') }}</label>

                                <div class="col-md-6">
                                    <select name='yesno_id' class="form-control @error('yesno_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($yesno as $list)
                                        <option value="{{$list->id}}" id="yesno_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('yesno_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="yesno_id" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="aciklama"></textarea>
                                </div>
                            </div>
                       </div>
                       <span class="inputname">
                        <a href="#" style="color: black" class="ekle">Adres Ekle</a>
                    </span>
                       {{-- <span class="inputname">
                        <a href="#" style="color: black" class="aciklamaekle">Açıklama Ekle</a>
                    </span> --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Firma Ekle') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
    li{
        list-style-type:none; 
    }
</style>
@endsection
@section('js')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>

<script type="text/javascript">
    // $( function() {
    //     $('#countries_id').select2();   
    //     $('#cities_id').select2();   
    // });


    // Add new input with associated 'remove' link when 'add' button is clicked.
    $('.ekle').click(function(e) {
        e.preventDefault();

        $("#ww").append(
            '<li><div class="form-group row">'
            + '<label  class="col-md-4 col-form-label text-md-right">{{ __('Ülke - Şehir - Adres') }}</label>'
            + '<div class="col-md-6">'
            + '<select name="countries_id[]" id="countries_id" class="form-control  @error('countries_id') is-invalid @enderror">'
            + '<option value="">Seçiniz..</option>'
            + '@foreach ($country as $list) <option value="{{$list->id}}" >{{$list->name}}</option> @endforeach'
            + '</select>'
            + '<select name="cities_id[]" id="cities_id" class="form-control  @error('cities_id') is-invalid @enderror">'
            + '<option value="">Seçiniz..</option>'
            + '</select>'
            + '<textarea class="form-control" name="adres[]"></textarea>'
            + '</div>'
            + '<a href="#" class="remove">X</a>'
            + '</div>'
            + '</li>');
    });

    $('#ww').on('mouseenter focus', '#countries_id,#cities_id', function() {
        // $('#countries_id,#cities_id').select2();   
        $(this).select2();   
    });

    $('#ww').on('change', '#countries_id', function() {
            sid= $(this).val();
            if(sid){
                $.ajax({
                   type:"get",
                   url:'{{url('/company/city')}}/'+sid, 
                   success:function(res)
                   {   
                    var kayitSay = res.length;  
                        if(kayitSay > 0)
                        { 
                                // $("select[id=cities_id]").empty();
                                for (var i = 0; i < kayitSay; i++)
                                {
                                    $("select[id=cities_id]").append('<option value="'+res[i].id+'">'+res[i].name+'</option>');
                                };
                        }
                        else 
                        {
                         $("select[id=cities_id]").empty();
                        }
                 }
             });
            }
        });
// Remove parent of 'remove' link when link is clicked.
$('#ww').on('click', '.remove', function(e) {
    e.preventDefault();

    $(this).parent().remove();
});

// $('.aciklamaekle').click(function(e) {
//         e.preventDefault();

//         $("#ww").append(
//             '<li><div class="form-group row">'
//             + '<label  class="col-md-4 col-form-label text-md-right">{{ __('Açıklama Departmanı') }}</label>'
//             + '<div class="col-md-6">'
//             + '<input class="form-control" name="type[]">'
//             + '<textarea class="form-control" name="aciklama[]"></textarea>'
//             + '</div>'
//             + '<a href="#" class="remove">X</a>'
//             + '</div>'
//             + '</li>');
//     });
</script>
@endsection