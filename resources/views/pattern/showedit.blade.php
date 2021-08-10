@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
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
                	<form method="GET" action="{{ route('showupdate', $patterndetail->id) }}">
                		@csrf
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">Renk Adı</label>

                			<div class="col-md-6">
                				<input type="text" class="form-control" name="yarn_name" value="{{ $patterndetail->yarn_name }}">
                			</div>
                		</div>
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">Band</label>

                			<div class="col-md-6">
                				<select class="form-control" name="band">
                					<option value="{{ $patterndetail->bands->id }}">{{ $patterndetail->bands->name }}</option>
                					@foreach($bands as $list)
                						<option value="{{ $list->id }}">{{ $list->name }}</option>
                					@endforeach
                				</select>
                			</div>
                		</div>
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">Renk No</label>

                			<div class="col-md-6">
                				<input type="text" class="form-control" name="colorrgb" value="{{ $patterndetail->colorrgb }}">
                			</div>
                		</div>
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">İplik Bilgisi</label>

                			<div class="col-md-6">
                				<input type="text" class="form-control" name="yarncount" value="{{ $patterndetail->yarncount }}">
                			</div>
                		</div>
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">KG</label>

                			<div class="col-md-6">
                				<input type="text" class="form-control" name="quantity" value="{{ $patterndetail->quantity }}">
                			</div>
                		</div>
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">Tel Adet</label>

                			<div class="col-md-6">
                				<input type="text" class="form-control" name="picksrpt" value="{{ $patterndetail->picksrpt }}">
                			</div>
                		</div>
                		<div class="form-group row">
                			<label class="col-md-4 col-form-label text-md-right">Toplam Adet</label>

                			<div class="col-md-6">
                				<input type="text" class="form-control" name="tp" value="{{ $patterndetail->tp }}">
                			</div>
                		</div>
                		<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
                                <button type="submit" class="btn btn-success">
                                    Güncelle
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