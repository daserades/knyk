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
                    <form method="POST" action="{{ route('pattern.store') }}">
                        @csrf
                        <div id="ww">
                            <div class="form-group row">
                                <label for="marticle" class="col-md-4 col-form-label text-md-right">{{ __('Müşteri Desen No') }}</label>

                                <div class="col-md-6">
                                    <input id="marticle" type="text" class="form-control @error('marticle') is-invalid @enderror" name="marticle" value="{{ old('marticle') }}" autocomplete="marticle" autofocus>

                                    @error('marticle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ordertype_id" class="col-md-4 col-form-label text-md-right">{{ __('Siparişin Desen Türü') }}</label>

                                <div class="col-md-6">
                                    <select name='ordertype_id' class="form-control  @error('ordertype_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($ordertype as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ordertype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="type_id" class="col-md-4 col-form-label text-md-right">{{ __('Desen Serisi') }}</label>

                                <div class="col-md-6">
                                    <select name='type_id' class="form-control  @error('type_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($type as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='company_id' id="company_id" class="form-control  @error('company_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($company as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comp" class="col-md-4 col-form-label text-md-right">{{ __('Kompozisyon') }}</label>

                                <div class="col-md-6">
                                    <select name='comp' id="comp" class="form-control @error('comp') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($comp as $list)
                                        <option value="{{$list->comp}}">{{$list->comp}}</option>
                                        @endforeach
                                    </select>
                                    @error('comp')
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
@endsection

@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
    /*li{
        list-style-type:none; 
    }*/
</style>
@endsection
@section('javascript')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
   $( function() {
    $('#company_id, #comp').select2({ width: '350px' });
});
</script>
@endsection