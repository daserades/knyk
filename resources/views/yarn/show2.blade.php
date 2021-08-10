@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        İplik Çıkış Raporu
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                        <table class="table table-striped database-tables" border="1">
                        <tr>
                            <td>No :{{ $yarn->id ?? '' }}</td>
                            <td>Yer  :{{ $yarn->companytype->name ?? '' }}</td>
                            <td>Firma  :{{ $yarn->company->name  ?? ''}}</td>
                            <td>Sipariş  :{{ $yarn->order->no  ?? ''}}</td>
                            <td>Sevk Tarihi :{{ $yarn->outdate ?? '' }}</td>
                            <td>İrsaliye No  :{{ $yarn->dispatchno ?? '' }}</td>
                            <td>Fatura No  :{{ $yarn->invoiceno ?? '' }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8">Açıklama  :{{ $yarn->explanation ?? '' }}</td>
                        </tr>
                        <tr><td colspan="8"></td></tr>
                        <tr>
                            <div class="col-md-6">
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
                            @php $yarntype_id=null; $id=0;@endphp 
                    @foreach($yarn->yarndetail as $list)
                                 @php  $id=$list->yarn_id @endphp
                                  @if ($loop->index > 0 && $yarntype_id != $list->lotno)
                                    @include ('yarn.show2_subtotal', compact('list', 'yarntype_id','id'))
                                    @endif
                         <tr>
                             @if ($yarntype_id == $list->lotno)
                                            <td ></td>
                                            @else 
                                            @php ($yarntype_id=$list->lotno)
                                  <td>{{ $list->lotno ??  ''}}</td>
                             @endif
                            <td>{{ $list->yarnbrand ??  '' }}</td>
                            <td>{{ $list->yarnno ??  ''}}/{{$list->ne ??  ''}}</td>
                            <td>{{ $list->yarntype->name  ?? ''}}</td>
                            <td>{{ $list->colortype->name  ?? ''}}</td>
                            <td>{{ $list->colorno ??  ''}}</td>
                            <td>{{ $list->color ??  ''}}</td>
                            <td>{{ $list->amount ?? ''}}</td>
                            <td>{{ $list->bobbin ??  ''}}</td>
                        </tr>
                              @if ($loop->last)
                                    @include ('yarn.show2_subtotal', compact('list', 'yarntype_id','id'))
                                        
                                    @endif
                        @endforeach 
                        <tr>
                            <td colspan="7">Toplam</td>
                            <td>{{$yarn->yarndetail->sum('amount')}}</td>
                        </tr>
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