@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('authorized.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('authorized.update', $authorized->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Ad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name" value="{{$authorized->name}}" autofocus>

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
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"  autocomplete="surname" value="{{$authorized->surname}}" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Firma') }}</label>

                                <div class="col-md-6">
                                    <select name='company_id' class="form-control  @error('company_id') is-invalid @enderror" >
                                            <option value="@isset($authorized->company_id){{$authorized->company_id}}@endisset">@isset($authorized->company->name){{$authorized->company->name}}@endisset</option>
                                        @foreach ($company as $list)
                                            <option value="{{$list->id}}" id="company_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dutylist_id" class="col-md-4 col-form-label text-md-right">{{ __('Görev Listesi') }}</label>

                                <div class="col-md-6">
                                    <select name='dutylist_id' class="form-control  @error('dutylist_id') is-invalid @enderror" >
                                            <option value="@isset($authorized->dutylist_id){{$authorized->dutylist_id}}@endisset">@isset($authorized->dutylist->name){{$authorized->dutylist->name}}@endisset</option>
                                        @foreach ($dutylist as $list)
                                            <option value="{{$list->id}}" id="dutylist_id">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('dutylist_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                         <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ ('Telefon') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone"  autocomplete="telephone" value="{{$authorized->telephone}}" autofocus>

                                @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="mobilephones" class="col-md-4 col-form-label text-md-right">{{ ('Telefon(GSM)') }}</label>

                            <div class="col-md-6">
                                <input id="mobilephones" type="text" class="form-control @error('mobilephones') is-invalid @enderror" name="mobilephones"  autocomplete="tel" value="{{$authorized->mobilephones}}" autofocus>

                                @error('mobilephones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$authorized->email}}"  autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="explanation" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="explanation" type="text" class="form-control"  name="explanation"  autocomplete="explanation" autofocus>{{$authorized->explanation}}
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
