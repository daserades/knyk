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
                    <form method="POST" action="{{ route('pattern.update', $pattern->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="design_name" class="col-md-4 col-form-label text-md-right">{{ ('Desen Adı') }}</label>

                            <div class="col-md-6">
                                <input id="design_name" type="text" class="form-control @error('design_name') is-invalid @enderror" name="design_name" required autocomplete="design_name" value="{{$pattern->design_name}}" autofocus>

                                @error('design_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="epi" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Çözgü Sıklığı') }}</label>

                            <div class="col-md-6">
                                <input id="epi" type="text" class="form-control @error('epi') is-invalid @enderror" name="epi" autocomplete="epi" value="{{$pattern->epi}}" autofocus>

                                @error('epi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reed_space" class="col-md-4 col-form-label text-md-right">{{ ('Tarak Eni(cm)') }}</label>

                            <div class="col-md-6">
                                <input id="reed_space" type="text" class="form-control @error('reed_space') is-invalid @enderror" name="reed_space" autocomplete="reed_space" value="{{$pattern->reed_space}}" autofocus>

                                @error('reed_space')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finish_width" class="col-md-4 col-form-label text-md-right">{{ ('Mamul En(cm)') }}</label>

                            <div class="col-md-6">
                                <input id="finish_width" type="text" class="form-control @error('finish_width') is-invalid @enderror" name="finish_width" autocomplete="finish_width" value="{{$pattern->finish_width}}" autofocus>

                                @error('finish_width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ppi" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Atkı Sıklığı') }}</label>

                            <div class="col-md-6">
                                <input id="ppi" type="text" class="form-control @error('ppi') is-invalid @enderror" name="ppi"  autocomplete="ppi" value="{{$pattern->ppi}}" autofocus>

                                @error('ppi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_dents" class="col-md-4 col-form-label text-md-right">{{ ('Toplam Tarak Dişi') }}</label>

                            <div class="col-md-6">
                                <input id="total_dents" type="text" class="form-control @error('total_dents') is-invalid @enderror" name="total_dents"  autocomplete="total_dents" value="{{$pattern->total_dents}}" autofocus>

                                @error('total_dents')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_ends" class="col-md-4 col-form-label text-md-right">{{ ('Toplam Çözgü Teli') }}</label>

                            <div class="col-md-6">
                                <input id="total_ends" type="text" class="form-control @error('total_ends') is-invalid @enderror" name="total_ends" autocomplete="total_ends" value="{{$pattern->total_ends}}" autofocus>

                                @error('total_ends')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grey_construction" class="col-md-4 col-form-label text-md-right">{{ ('Ham Sıklıklar') }}</label>

                            <div class="col-md-6">
                                <input id="grey_construction" type="text" class="form-control @error('grey_construction') is-invalid @enderror" name="grey_construction" autocomplete="grey_construction" value="{{$pattern->grey_construction}}" autofocus>

                                @error('grey_construction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grey_construction1" class="col-md-4 col-form-label text-md-right">{{ ('Ham Sıklık 1') }}</label>

                            <div class="col-md-6">
                                <input id="grey_construction1" type="text" class="form-control @error('grey_construction1') is-invalid @enderror" name="grey_construction1" autocomplete="grey_construction1" value="{{$pattern->grey_construction1}}" autofocus>

                                @error('grey_construction1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grey_construction2" class="col-md-4 col-form-label text-md-right">{{ ('Ham Sıklık 2') }}</label>

                            <div class="col-md-6">
                                <input id="grey_construction2" type="text" class="form-control @error('grey_construction2') is-invalid @enderror" name="grey_construction2" autocomplete="grey_construction2" value="{{$pattern->grey_construction2}}" autofocus>

                                @error('grey_construction2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finish_construction" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Sıklıklar') }}</label>

                            <div class="col-md-6">
                                <input id="finish_construction" type="text" class="form-control @error('finish_construction') is-invalid @enderror" name="finish_construction" autocomplete="finish_construction" value="{{$pattern->finish_construction}}" autofocus>

                                @error('finish_construction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finish_construction1" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Sıklık 1') }}</label>

                            <div class="col-md-6">
                                <input id="finish_construction1" type="text" class="form-control @error('finish_construction1') is-invalid @enderror" name="finish_construction1" autocomplete="finish_construction1" value="{{$pattern->finish_construction1}}" autofocus>

                                @error('finish_construction1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finish_construction2" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Sıklık 2') }}</label>

                            <div class="col-md-6">
                                <input id="finish_construction2" type="text" class="form-control @error('finish_construction2') is-invalid @enderror" name="finish_construction2" autocomplete="finish_construction2" value="{{$pattern->finish_construction2}}" autofocus>

                                @error('finish_construction2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reed_count" class="col-md-4 col-form-label text-md-right">{{ ('Tarak No(1cm)') }}</label>

                            <div class="col-md-6">
                                <input id="reed_count" type="text" class="form-control @error('reed_count') is-invalid @enderror" name="reed_count" autocomplete="reed_count" value="{{$pattern->reed_count}}" autofocus>

                                @error('reed_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="average_dent" class="col-md-4 col-form-label text-md-right">{{ ('Dişten Geçen Tel') }}</label>

                            <div class="col-md-6">
                                <input id="average_dent" type="text" class="form-control @error('average_dent') is-invalid @enderror" name="average_dent" autocomplete="average_dent" value="{{$pattern->average_dent}}" autofocus>

                                @error('average_dent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gray_width" class="col-md-4 col-form-label text-md-right">{{ ('Ham En') }}</label>

                            <div class="col-md-6">
                                <input id="gray_width" type="text" class="form-control @error('gray_width') is-invalid @enderror" name="gray_width" autocomplete="gray_width" value="{{$pattern->gray_width}}" autofocus>

                                @error('gray_width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gray_glm" class="col-md-4 col-form-label text-md-right">{{ ('Ham Gramaj') }}</label>

                            <div class="col-md-6">
                                <input id="gray_glm" type="text" class="form-control @error('gray_glm') is-invalid @enderror" name="gray_glm" autocomplete="gray_glm" value="{{$pattern->gray_glm}}" autofocus>

                                @error('gray_glm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finish_glm" class="col-md-4 col-form-label text-md-right">{{ ('Mamul Gramaj') }}</label>

                            <div class="col-md-6">
                                <input id="finish_glm" type="text" class="form-control @error('finish_glm') is-invalid @enderror" name="finish_glm" autocomplete="finish_glm" value="{{$pattern->finish_glm}}" autofocus>

                                @error('finish_glm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="warp_pattern" class="col-md-4 col-form-label text-md-right">{{ ('Çözgü Raporu') }}</label>

                            <div class="col-md-6">
                                <textarea id="warp_pattern" type="text" class="form-control"  name="warp_pattern"  autocomplete="warp_pattern" autofocus>{{$pattern->warp_pattern}} </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="warp_total" class="col-md-4 col-form-label text-md-right">{{ ('Çözgü Raporu Toplam') }}</label>

                            <div class="col-md-6">
                                <input id="warp_total" type="text" class="form-control @error('warp_total') is-invalid @enderror" name="warp_total" autocomplete="warp_total" value="{{$pattern->warp_total}}" autofocus>

                                @error('warp_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weft_pattern" class="col-md-4 col-form-label text-md-right">{{ ('Atkı Raporu') }}</label>

                            <div class="col-md-6">
                                <textarea id="weft_pattern" type="text" class="form-control"  name="weft_pattern"  autocomplete="weft_pattern" autofocus>{{$pattern->weft_pattern}} </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weft_total" class="col-md-4 col-form-label text-md-right">{{ ('Atkı Raporu Toplam') }}</label>

                            <div class="col-md-6">
                                <input id="weft_total" type="text" class="form-control @error('weft_total') is-invalid @enderror" name="weft_total" autocomplete="weft_total" value="{{$pattern->weft_total}}" autofocus>

                                @error('weft_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="draft_total" class="col-md-4 col-form-label text-md-right">{{ ('Toplam Taslak') }}</label>

                            <div class="col-md-6">
                                <input id="draft_total" type="text" class="form-control @error('draft_total') is-invalid @enderror" name="draft_total" autocomplete="draft_total" value="{{$pattern->draft_total}}" autofocus>

                                @error('draft_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="draft_total1" class="col-md-4 col-form-label text-md-right">{{ ('Toplam Taslak 1') }}</label>

                            <div class="col-md-6">
                                <input id="draft_total1" type="text" class="form-control @error('draft_total1') is-invalid @enderror" name="draft_total1" autocomplete="draft_total1" value="{{$pattern->draft_total1}}" autofocus>

                                @error('draft_total1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="draft_total2" class="col-md-4 col-form-label text-md-right">{{ ('Toplam Taslak 2') }}</label>

                            <div class="col-md-6">
                                <input id="draft_total2" type="text" class="form-control @error('draft_total2') is-invalid @enderror" name="draft_total2" autocomplete="draft_total2" value="{{$pattern->draft_total2}}" autofocus>

                                @error('draft_total2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pegptan_total" class="col-md-4 col-form-label text-md-right">{{ ('Pegptan Total') }}</label>

                            <div class="col-md-6">
                                <input id="pegptan_total" type="text" class="form-control @error('pegptan_total') is-invalid @enderror" name="pegptan_total" autocomplete="pegptan_total" value="{{$pattern->pegptan_total}}" autofocus>

                                @error('pegptan_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                                <label for="aciklama" class="col-md-4 col-form-label text-md-right">{{ __('Açıklama') }}</label>
                                <div class="col-md-6">
                                     <textarea id="aciklama" type="text" class="form-control"  name="aciklama"  autocomplete="aciklama" autofocus>{{$pattern->aciklama}}</textarea>
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
