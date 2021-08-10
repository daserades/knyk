@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Büküm Raporu') }}</div> 
                <div class="card-body">
                        <table class="table-sm table-striped table-hover" border="1">
                        <tr>
                            <td></td>
                            <td>Firma  :{{ $yarntwist->company->name  ?? ''}}</td>
                            <td>No  :{{ $yarntwist->no ?? '' }}</td>
                            <td>Sipariş No :{{ $yarntwist->order->no ?? '' }}</td>
                            <td colspan="6">Adı  :{{ $yarntwist->name ?? '' }}</td>
                        </tr>
                            <div class="col-md-6">
                                <th></th>
                                <th>İplik Cinsi</th>
                                <th>Boya Cinsi</th>
                                <th>Renk No</th>
                                <th>Renk</th>
                                <th>İplik NO-NE</th>
                                <th>Kat Sayısı</th>
                                <th>Büküm Turu</th>
                                <th>Kat Büküm Yönü</th>
                                <th>Miktar</th>
                            </div>
                        </tr>
                        @isset($yarntwist->yarntwistdetail)
                        @foreach($yarntwist->yarntwistdetail as $list)
                        <tr>
                            <div class="col-md-6">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->yarnstore->yarntype->name ?? ''}}</td>
                            <td>{{ $list->yarnstore->boyacins->name ?? ''}}</td>
                            <td>{{ $list->yarnstore->renkno ?? ''}}</td>
                            <td>{{ $list->yarnstore->renk ?? ''}}</td>
                            <td>{{ $list->yarnstore->iplikno ?? ''}}/{{$list->yarnstore->ne ?? ''}}</td>
                            <td>{{ $list->katsayi }}</td>
                            <td>{{ $list->tur }}</td>
                            <td>{{ $list->yon }}</td>
                            <td>{{ $list->miktar }}</td>
                        </div>
                        </tr>
                        @endforeach @endisset
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')

@endsection
@section('js')

@endsection