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
					<table class="table"> 
					<tr><td>
					<div class="form-group row">
						<label for="name" class="col-md-6 col-form-label text-md-center">{{ __('company Adı:  ') }}{{ $company->name }}</label>	
					</div></td><td>
					<div class="form-group row">
						<label for="unvan" class="col-md-6 col-form-label text-md-center">{{ __('Ünvan:  ') }}{{ $company->unvan }}</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="vergidairesi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Dairesi:  ') }}{{ $company->vergidairesi }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="verginumarasi" class="col-md-6 col-form-label text-md-center">{{ __('Vergi Numarası:  ') }}{{ $company->verginumarasi }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="tel1" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 1  :')   }}{{ $company->tel1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="tel2" class="col-md-6 col-form-label text-md-center">{{ __('Telefon 2  :')   }}{{ $company->tel2 }}</label>	
					</div></td></tr>
					<tr><td>
					<div class="form-group row">
						<label for="fax1" class="col-md-6 col-form-label text-md-center">{{ __('Fax 1  :  ') }}{{ $company->fax1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="fax2" class="col-md-6 col-form-label text-md-center">{{ __('Fax 2  :  ') }}{{ $company->fax2 }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="email1" class="col-md-6 col-form-label text-md-center">{{ __('Email 1  :  ') }}{{ $company->email1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="email2" class="col-md-6 col-form-label text-md-center">{{ __('Email 2  :  ') }}{{ $company->email2 }}</label>	
					</div></td></tr>
					{{-- <tr><td>	
					<div class="form-group row">
						<label for="adres1" class="col-md-6 col-form-label text-md-center">{{ __('Adres 1  :  ') }}{{ $company->adres1 }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="adres2" class="col-md-6 col-form-label text-md-center">{{ __('Adres 2  :  ') }}{{ $company->adres2 }}</label>	
					</div></td></tr> --}}
					<tr><td>	
					<div class="form-group row">
						<label for="banka" class="col-md-6 col-form-label text-md-center">{{ __('Banka  :  ') }}{{ $company->banka }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="sube" class="col-md-6 col-form-label text-md-center">{{ __('Şube  :  ') }}{{ $company->sube }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="hesapno" class="col-md-6 col-form-label text-md-center">{{ __('Hesap NO  :  ') }}{{ $company->hesapno }}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="iban" class="col-md-6 col-form-label text-md-center">{{ __('İban  :  ') }}{{ $company->iban }}</label>	
					</div></td></tr>
					<tr><td>	
					<div class="form-group row">
						<label for="website" class="col-md-6 col-form-label text-md-center">{{ __('Web Site  :  ') }}{{ $company->website }}</label>	
					</div></td><td>		
					<div class="form-group row">
						<label for="aciklama" class="col-md-6 col-form-label text-md-center">{{ __('Açıklama  :  ') }}{{ $company->aciklama }}</label>	
					</div></td></tr>
					@foreach ($company->adress as $list)
					<tr><td>	
					<div class="form-group row">
						<label for="country" class="col-md-6 col-form-label text-md-center">{{ __('Ülke-Şehir  :  ') }}{{ $list->country->name ?? ''}} - {{ $list->city->name ?? ''}}</label>	
					</div></td><td>	
					<div class="form-group row">
						<label for="city" class="col-md-6 col-form-label text-md-center">{{ __('Tip-Adres  :  ') }}{{ $list->type ?? ''}} - {{$list->text}}</label>	
					</div></td></tr>	
					@endforeach
					<tr><td colspan="2">	
					<div class="form-group row">
						<a href="javascript:history.back()" class="btn btn-primary">Geri</a>
					</div></td></tr>					
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
