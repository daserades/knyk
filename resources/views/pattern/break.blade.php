@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
            Excel Aktarma 
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
            
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
        <div class="float-left">
            <form action="{{ route('breakimport') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Desen Excel Seç</label>
                <input type="file" name="file" class="form-control">
            </div>
            <center>
                <button class="btn btn-success">YÜKLE</button>
            </center>
            </form>
              <table border="1">
          <form method="POST" action="{{ route('variant') }}">
            @csrf
        <tr>
            <th><input type="checkbox" id="checkAll" checked></th>
            <th>Article Varyant No</th>
            <input type="hidden" name="design_name" value="{{$break1->design_name ?? ''}}">
        </tr>
        @isset($break1->break2)
    @foreach ($break1->break2 as $list)
        <tr>
            <td> <input id="item" type="checkbox" name="item[]" value="{{$list->variant_no ?? ''}}" checked></td>
            <td>{{ $break1->design_name ?? ''}} - {{$list->variant_no ?? ''}}</td>
        </tr>
    @endforeach
    @endisset
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-success">
                {{ __('Seçilenleri Aktar') }}
            </button>
            </td>
        </tr>
        </form>
    </table>
        </div>
        <div class="float-right">
            <form action="{{ route('importimages') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Resimleri Seç</label>
                <input type="file" class="form-control" name='resimler[]' multiple >
            </div>
            <center>
                <button class="btn btn-success">Import</button>
            </center>
            </form>
        </div>
            
  
    </div>
</div>
   
@endsection
@section('javascript')
<script type="text/javascript">
    
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>
@endsection