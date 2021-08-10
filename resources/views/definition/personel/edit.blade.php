@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('personel.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                    <form method="POST" action="{{ route('personel.update', $personel->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Ad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name" value="{{$personel->name}}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ ('Soyad') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"  autocomplete="surname" value="{{$personel->surname}}" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ ('Telefon') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel"  autocomplete="tel" value="{{$personel->tel}}" autofocus>

                                @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="department_id" class="col-md-4 col-form-label text-md-right">{{ __('Departman') }}</label>

                                <div class="col-md-6">
                                    <select name='department_id' class="form-control  @error('department_id') is-invalid @enderror" >
                                            <option value="@isset($personel->department_id){{$personel->department_id}}@endisset">@isset($personel->department->name){{$personel->department->name}}@endisset</option>
                                        @foreach ($department as $list)
                                            <option value="{{$list->id}}" id="department_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dutylists_tb_id" class="col-md-4 col-form-label text-md-right">{{ __('Görev Listesi') }}</label>

                                <div class="col-md-6">
                                    <select name='dutylists_tb_id' class="form-control  @error('dutylists_tb_id') is-invalid @enderror" >
                                            <option value="@isset($personel->dutylists_tb_id){{$personel->dutylists_tb_id}}@endisset">@isset($personel->dutylist->name){{$personel->dutylist->name}}@endisset</option>
                                        @foreach ($dutylist as $list)
                                            <option value="{{$list->id}}" id="department_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('dutylists_tb_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="gtrh" class="col-md-4 col-form-label text-md-right">{{ __('Giriş Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="gtrh" type="date" class="form-control @error('gtrh') is-invalid @enderror" name="gtrh"  value="{{ date('Y-m-d',strtotime($personel->gtrh))}}" autocomplete="gtrh" autofocus>
                                    @error('gtrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="ctrh" class="col-md-4 col-form-label text-md-right">{{ __('Çıkış Tarihi') }}</label>

                                <div class="col-md-6">

                                    <input id="ctrh" type="date" class="form-control @error('ctrh') is-invalid @enderror" name="ctrh" value="@if ($personel->ctrh){{ date('Y-m-d',strtotime($personel->ctrh))}}@endif" autocomplete="ctrh" autofocus>
                                    @error('ctrh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="status_id" class="col-md-4 col-form-label text-md-right">{{ __('Durum') }}</label>

                                <div class="col-md-6">
                                    <select name='status_id' class="form-control @error('status_id') is-invalid @enderror" >
                                            <option value="{{$personel->status_id ?? ''}}">{{$personel->status->name ?? ''}}</option>
                                        @foreach ($status as $list)
                                            <option value="{{$list->id}}" id="status_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                         @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="users_tb_id" class="col-md-4 col-form-label text-md-right">{{ __('Kullanıcı Adı') }}</label>

                                <div class="col-md-6">
                                    <select name='users_tb_id' class="form-control @error('users_tb_id') is-invalid @enderror" >
                                            <option value="{{$personel->users_tb_id}}">{{$personel->user->username}}</option>
                                    </select>
                                         @error('users_tb_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adres" class="col-md-4 col-form-label text-md-right">{{ __('Adres') }}</label>
                                <div class="col-md-6">
                                     <textarea id="adres" type="text" class="form-control"  name="adres"  autocomplete="adres" autofocus>{{$personel->adres}}
                                    </textarea>
                                    </div>
                            </div> 
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
