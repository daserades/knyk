@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
    	Sipariş Detayı
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
               <table  class="table table-striped database-tables">
					<thead >
						<tr>
							<th>No</th>
							<th>Müşteri</th>
							<th>Yetkili</th>
							<th>Sip.Trh.</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
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
					<thead >
						<tr>
						<th>Kaynak Article</th>
						<th>Müşteri Article</th>
						<th>Konstrüksüyon</th>
						<th>Renk</th>
						<th>Sipariş Miktarı</th>
						<th>Teslim Tarihi</th>
						<th>Fiyat/Vade</th>
						<th colspan="2">
						<a href="{{route('orderdetail.create2',$order->id)}} " class="btn btn-sm btn-success browse_bread"><i class="voyager-plus"></i> Detay Ekle</a>
						</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order->orderdetail as $list)
						<tr>
							<td>@if(isset($list->article->no)) <a href="{{url('article',$list->article_id)}}">{{$list->article->no}} </a> @elseif(isset($list->patterndetail_id)) sss @endif  </td>
							<td>{{$list->marticle}} </td>
							<td>{{$list->const}} </td>
							<td>{{$list->color}} </td>
							<td>{{$list->finishmt}} </td>
							<td>{{$list->deadline}} </td>
							<td><a href="{{route('orderdetailedit',$list->id)}}" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
							<td><a href="{{route('orderdetailedit',$list->id)}}" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
			                 <td class="del">
			                 	<div class="delete-form">
                                    <form action="{{route('orderdetail.destroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
					            <button type="submit" class="btn btn-sm btn-danger pull-right delete" title="Sil"><i class="voyager-trash"></i> Sil</button>
                                    </form>
                                </div> 
				             </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	  $('#table').on( 'click', 'tbody tr td.del', function () {
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
            } );
</script>
@endsection
