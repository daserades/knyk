@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        Maliyet Hesabı
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
               <table id="table" class="table table-striped database-tables">
					<thead align="center" style="background-color: lightgrey">
						<tr>
							<td>No</td>
							<td>Müşteri</td>
							<td>Yetkili</td>
							<td>Sip.Trh.</td>
							<td></td>
						</tr>
					</thead>
					<tbody align="center">
						<tr>
							<td>{{ $order->no }}</td>
							<td>{{ $order->company->name ?? ''}}</td>
							<td>{{ $order->authorized->name ?? ''}}</td>
							<td>{{ $order->date }}</td>
							<td><a href="{{route('showorder',$order->id)}} " class="btn btn-warning btn-sm browse_bread" title="Siparişi Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
						</tr>
					</tbody>
				</table>
				<br>
               <table id="table" class="table table-striped database-tables">
					<thead align="center" style="background-color: lightgrey">
						<tr>
							<td rowspan="2"></td>
							<td rowspan="2" style="vertical-align: middle;">Article</td>
							<td colspan="4">Ham Satış Fiyatı</td>
							<td colspan="4">Mamül Satış Fiyatı</td>
							<td rowspan="2" style="vertical-align: middle;"><a href="{{ route('yarncolor', ['id'=>$order->id, 'fid'=>$order->company->id]) }}" 
								class="btn btn-xs btn-primary" target="_blank">İ.B Ekle </a></td>
							<td rowspan="2" style="vertical-align: middle;"><a href="{{ route('evencolor', ['id'=>$order->id, 'fid'=>$order->company->id]) }}" 
								class="btn btn-xs btn-primary" target="_blank">D.B Ekle</a></td>
						</tr>
						<tr>
							<td>EUR</td>
							<td>USD</td>
							<td>GBP</td>
							<td>TL</td>
							<td>EUR</td>
							<td>USD</td>
							<td>GBP</td>
							<td>TL</td>
						</tr>
					</thead>
					<tbody align="center">
						@foreach($order->cost as $list)
						<tr>
							<td>{{$list->id}} </td>
							<td>{{$list->article}} </td>
							<td>{{$list->ordertype->name}} </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection