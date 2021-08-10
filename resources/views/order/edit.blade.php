@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        Sipariş Güncelleme
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="POST" action="{{ route('order.update', $order->id) }}">
                        @method('PATCH')
                        @csrf
                        <div id="ww">

                        <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Tarih') }}</label>

                                <div class="col-md-6">

                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" required value="{{ date('Y-m-d',strtotime($order->date))}}" autocomplete="date" autofocus>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>	
                        <div class="form-group row">
                                <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='company_id' id="firma_i"d class="form-control  @error('company_id') is-invalid @enderror">
                                            <option value="{{$order->company_id}}">{{$order->company->name ?? ''}}</option>
                                        @foreach ($company as $list)
                                            <option value="{{$list->id}}" id="company_id">{{$list->name ?? ''}}</option>
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
                                <label for="authorized_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Yetkilisi') }}</label>

                                <div class="col-md-6">
                                    <select name='authorized_id' class="form-control  @error('authorized_id') is-invalid @enderror">
                                            <option value="{{$order->authorized_id}}">{{$order->authorized->name ?? ''}}</option>
                                        @foreach ($authorized as $list)
                                            <option value="{{$list->id}}" id="authorized_id">{{$list->name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                     @error('authorized_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="language_id" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Dili') }}</label>

                                <div class="col-md-6">
                                    <select name='language_id' class="form-control  @error('language_id') is-invalid @enderror">
                                            <option value="{{$order->language_id}}">{{$order->language->name ?? ''}}</option>
                                        @foreach ($language as $list)
                                            <option value="{{$list->id}}" id="language_id">{{$list->name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                     @error('language_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @foreach($order->explanation as $list)
                        <div class="form-group row">
                                <label for="aciklama" class="col-md-3 col-form-label text-md-left">{{ __('Tip & Açıklama') }}</label>
                                <div class="col-md-4">
                                    <input type="text" name="type[]" class="form-control" value="{{$list->type}}" required>
                                    </div>
                                <div class="col-md-4">
                                     <textarea type="text" class="form-control"  name="text[]" autocomplete="text" autofocus>{{ $list->text ?? '' }}</textarea>
                                    </div>
                            <a href="{{route('explanationdelete',$list->id)}}">X</a>
                        </div>
                            @endforeach

                        <span class="inputname">
                        <a href="#" style="color: black" class="ekle">Açıklama Ekle</a>
                        </span>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Güncelle') }}
                                </button>
                            </div>
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
@section('javascript')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>

<script type="text/javascript">
        $('#company_id').select2();   
    
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
