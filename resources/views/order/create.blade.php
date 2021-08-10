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
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf
                        <div id="ww">

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Sipariş Tarihi') }}</label>
                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ date('Y-m-d',strtotime(now())) }}"  autocomplete="date" autofocus>
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
                                    <select name='company_id' id="company_id" class="form-control @error('company_id') is-invalid @enderror">
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
                            <div class="form-group row">
                                <label for="authorized_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma Yetkilisi') }}</label>

                                <div class="col-md-6">
                                    <select name='authorized_id' id="authorized_id" class="form-control @error('authorized_id') is-invalid @enderror">
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
                                    <select name='language_id' class="form-control @error('language_id') is-invalid @enderror">
                                        <option value="">Seçiniz..</option>
                                        @foreach ($language as $list)
                                        <option value="{{$list->id}}" id="language_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('language_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Gerekli' }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                          
                        <span class="inputname">
                            <a href="#" style="color: black" class="ekle">Açıklama Ekle</a>
                        </span>
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
    li{
        list-style-type:none; 
    }
</style>
@endsection
@section('javascript')
<script src="{{ asset('js/select2.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
        $('#company_id').select2();   
   $("select[name='company_id']").change(function(){
        //var a = $("select[name='company_id'] option:selected").text();
        var id = $("select[name='company_id']").val();
        if(id){
            $.ajax ({
                type:'get',
                url:'{{url('order/authorized')}}/'+id, 
                success:function(res)
                     {   
                    var kayitSay = res.length;  
                        if(kayitSay > 0)
                        { 
                                $("select[id=authorized_id]").empty();
                                for (var i = 0; i < kayitSay; i++)
                                {
                                    $("select[id=authorized_id]").append('<option value="'+res[i].id+'">'+res[i].name+' '+res[i].surname+'</option>');
                                };
                        }
                        else 
                        {
                         $("select[id=authorized_id]").empty();
                        }
                 }
            });  
        } 
    }); 
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