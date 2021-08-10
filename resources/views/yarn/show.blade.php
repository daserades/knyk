@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        İplik Giriş Raporu
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                        <table class="table table-striped database-tables">
                        <tr>
                            <td>No :{{ $yarn->id ?? '' }}</td>
                            <td>Yer  :{{ $yarn->companytype->name ?? '' }}</td>
                            <td>Firma  :{{ $yarn->company->name  ?? ''}}</td>
                            <td>Sipariş  :{{ $yarn->order->no  ?? ''}}</td>
                            <td>Sevk Tarihi :{{ $yarn->logindate ?? '' }}</td>
                            <td>İrsaliye No  :{{ $yarn->dispatchno ?? '' }}</td>
                            <td>Fatura No  :{{ $yarn->invoiceno ?? '' }}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="9">Açıklama  :{{ $yarn->explanation ?? '' }}</td>
                        </tr>
                        <tr><td colspan="9"></td></tr>
                        <tr>
                            <div class="col-md-6">
                               <td></td>
                               <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Miktar</td>
                                <td>Bobin S.</td>
                            </div>
                        </tr>
                    <tbody>
                        @isset($yarn->yarndetail)
                        @foreach($yarn->yarndetail as $list)
                        <tr>
                            <td>{{ $list->place }}</td>
                            <td>{{ $list->lotno }}</td>
                            <td>{{ $list->yarnbrand }}</td>
                            <td>{{ $list->yarnno }}</td>
                            <td>{{ $list->yarntype->name ?? ''}}</td>
                            <td>{{ $list->colortype->name  ?? ''}}</td>
                            <td>{{ $list->colorno ?? ''}}</td>
                            <td>{{ $list->color ?? ''}}</td>
                            <td>{{ $list->amount ?? ''}}</td>
                            <td>{{ $list->bobbin ?? ''}}</td>
                        </tr>
                        @endforeach 
                         <tr>
                            <td colspan="8">Toplam</td>
                            <td>{{$yarn->yarndetail->sum('amount') ?? ''}}</td>
                        </tr>
                        @endisset
                    </tbody>
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