@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('company.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="POST" action="{{ route('company.update', $company->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Ad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" value="{{$company->name ?? ''}}" autofocus>

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
                                            <option value="{{$company->companytype_id}}">{{$company->companytype->name ?? ''}}</option>
                                        @foreach ($companytype as $list)
                                            <option value="{{$list->id}}" id="companytype_id">{{$list->name ?? ''}}</option>
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
                            <label for="unvan" class="col-md-4 col-form-label text-md-right">{{ ('Ünvan') }}</label>

                            <div class="col-md-6">
                                <input id="unvan" type="text" class="form-control @error('unvan') is-invalid @enderror" name="unvan" autocomplete="unvan" value="{{$company->unvan}}" autofocus>

                                @error('unvan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vergidairesi" class="col-md-4 col-form-label text-md-right">{{ ('Vergi Dairesi') }}</label>

                            <div class="col-md-6">
                                <input id="vergidairesi" type="text" class="form-control @error('vergidairesi') is-invalid @enderror" name="vergidairesi" autocomplete="vergidairesi" value="{{$company->vergidairesi}}" autofocus>

                                @error('vergidairesi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="verginumarasi" class="col-md-4 col-form-label text-md-right">{{ ('Vergi Numarası') }}</label>

                            <div class="col-md-6">
                                <input id="verginumarasi" type="text" class="form-control @error('verginumarasi') is-invalid @enderror" name="verginumarasi" autocomplete="verginumarasi" value="{{$company->verginumarasi}}" autofocus>

                                @error('verginumarasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel1" class="col-md-4 col-form-label text-md-right">{{ ('Telefon 1') }}</label>

                            <div class="col-md-6">
                                <input id="tel1" type="text" class="form-control @error('tel1') is-invalid @enderror" name="tel1"  autocomplete="tel1" value="{{$company->tel1}}" autofocus>

                                @error('tel1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel2" class="col-md-4 col-form-label text-md-right">{{ ('Telefon 2') }}</label>

                            <div class="col-md-6">
                                <input id="tel2" type="text" class="form-control @error('tel2') is-invalid @enderror" name="tel2"  autocomplete="tel2" value="{{$company->tel2}}" autofocus>

                                @error('tel2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax1" class="col-md-4 col-form-label text-md-right">{{ ('Fax 1') }}</label>

                            <div class="col-md-6">
                                <input id="fax1" type="text" class="form-control @error('fax1') is-invalid @enderror" name="fax1" autocomplete="fax1" value="{{$company->fax1}}" autofocus>

                                @error('fax1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax2" class="col-md-4 col-form-label text-md-right">{{ ('Fax 2') }}</label>

                            <div class="col-md-6">
                                <input id="fax2" type="text" class="form-control @error('fax2') is-invalid @enderror" name="fax2" autocomplete="fax2" value="{{$company->fax2}}" autofocus>

                                @error('fax2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="banka" class="col-md-4 col-form-label text-md-right">{{ ('Banka') }}</label>

                            <div class="col-md-6">
                                <input id="banka" type="text" class="form-control @error('banka') is-invalid @enderror" name="banka" autocomplete="banka" value="{{$company->banka}}" autofocus>

                                @error('banka')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sube" class="col-md-4 col-form-label text-md-right">{{ ('Şube') }}</label>

                            <div class="col-md-6">
                                <input id="sube" type="text" class="form-control @error('sube') is-invalid @enderror" name="sube" autocomplete="sube" value="{{$company->sube}}" autofocus>

                                @error('sube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hesapno" class="col-md-4 col-form-label text-md-right">{{ ('Hesap No') }}</label>

                            <div class="col-md-6">
                                <input id="hesapno" type="text" class="form-control @error('hesapno') is-invalid @enderror" name="hesapno" autocomplete="hesapno" value="{{$company->hesapno}}" autofocus>

                                @error('hesapno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">{{ ('İban') }}</label>

                            <div class="col-md-6">
                                <input id="iban" type="text" class="form-control @error('iban') is-invalid @enderror" name="iban" autocomplete="iban" value="{{$company->iban}}" autofocus>

                                @error('iban')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ ('Web Site') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" autocomplete="website" value="{{$company->website}}" autofocus>

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
                                    <select name='status_id' class="form-control  @error('status_id') is-invalid @enderror">
                                            <option value="{{$company->status_id}}">{{$company->status->name ?? ''}}</option>
                                        @foreach ($status as $list)
                                            <option value="{{$list->id}}" id="status_id">{{$list->name ?? ''}}</option>
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
                                <label for="yesno_id" class="col-md-4 col-form-label text-md-right">{{ __('Tesis Mi?') }}</label>

                                <div class="col-md-6">
                                    <select name='yesno_id' class="form-control  @error('yesno_id') is-invalid @enderror">
                                            <option value="{{$company->yesno_id}}">{{$company->yesno->name ?? ''}}</option>
                                        @foreach ($yesno as $list)
                                            <option value="{{$list->id}}" id="yesno_id">{{$list->name ?? ''}}</option>
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
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama" autocomplete="aciklama" autofocus>{{$company->aciklama}}
                                    </textarea>
                                    </div>
                        </div>
                        @foreach($company->adress as $list)
                        <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Ülke-Şehir-Adres') }}</label>

                                <div class="col-md-6">
                                    <select id="countries_id" name='countries_id{{$list->place}}' class="form-control  @error('countries_id') is-invalid @enderror">
                                            <option  value="{{$list->countries_id}}">{{$list->country->name ?? ''}}</option>
                                        @foreach ($country as $liste)
                                            <option value="{{$liste->id}}" >{{$liste->name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                    <select id="cities_id" name='cities_id{{$list->place}}' class="form-control  @error('cities_id') is-invalid @enderror">
                                            <option value="{{$list->cities_id}}">{{$list->city->name ?? ''}}</option>
                                    </select>
                                    <textarea id="text" type="text" class="form-control"  name="text" autocomplete="text" autofocus>{{$list->text}}
                                    </textarea>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
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
    
    $( function() {
        $('select[name^=countries_id]').select2();   
        //$('#cities_id').select2();   
    });
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
</script>
@endsection
