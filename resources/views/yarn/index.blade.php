@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('yarn.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                        <form action="{{route('yarnsearch')}}" method="post">
                        	@csrf
                            <div class="input-group">
                                <input type="companytype" name="companytype"  placeholder="Yer">
                                <input type="movementkind" name="movementkind"  placeholder="Hareket Türü">
                                <input type="company" name="company"  placeholder="Firma Adı">
                                <input type="order" name="order"  placeholder="Sipariş No">
                                <input type="date" name="logindate"  placeholder="Sipariş No">
                                <input type="date" name="outdate"  placeholder="Sipariş No">
                                <input type="dispatchno" name="dispatchno"  placeholder="İrsaliye No">
                                <input type="yarntype" name="yarntype"  placeholder="İplik Cins">
                                <input type="yarnbrand" name="yarnbrand"  placeholder="İplik Marka">
                                <input type="text" name="color"  placeholder="Renk">
                                <input type="yarnno" name="yarnno"  placeholder="İplikno (ÖR=30)">
                                <input type="ne" name="ne"  placeholder="NE (ÖR=1)">
                                <input type="explanation" name="explanation"  placeholder="Açıklama">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Ara</button>
                                </span>
                            </div>
                        </form>
                    </div>
				<div class="panel body">
					<table id="table" class="table table-striped database-tables" border="1">
						<thead>
							<tr>
								<th>No</th>
								<th>Sevk Yer</th>
								<th>Hareket Türü</th>
								<th>Firma</th>
								<th>Sipariş No </th>
								<th>Giriş Tarihi </th>
								<th>Çıkış Tarihi </th>
								<th>İrsaliye No</th>
								<th>Fatura No</th>
								<th>İplik Cinsi</th>
								<th>İplik Marka</th>
								<th>color</th>
								<th>Ne/No</th>
								<th>Açıklama</th>
								<th colspan="4"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($yarn as $list)
							<tr> 
								<td>{{$list->id ?? ''}} </td>
								<td>{{$list->companytype ?? ''}} </td>
								<td>{{$list->movementkind ?? ''}} </td>
								<td>{{$list->company ?? ''}} </td>
								<td>{{$list->order ?? ''}} </td>
								<td>{{$list->logindate ?? ''}} </td>
								<td>{{$list->outdate ?? ''}} </td>
								<td>{{$list->dispatchno ?? ''}} </td>
								<td>{{$list->invoiceno ?? ''}} </td>
								<td>{{$list->yarndetail[0]->yarntype->name ?? ''}} </td>
								<td>{{$list->yarndetail[0]->yarnbrand ?? ''}} </td>
								<td>{{$list->yarndetail[0]->color ?? ''}} </td>
								<td>{{$list->yarndetail[0]->yarnno ?? ''}}/{{$list->yarndetail[0]->ne ?? ''}} </td>
								<td>{{$list->explanation ?? ''}} </td>
								
									@if($list['movementkind_id']==1) 
							          <td><a href="{{ route('yarn.show',$list->id)}}" title="Detay" target="_blank" class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
							          <td><a href="{{ route('yarnlogin',$list->id)}}" title="İplik Giriş" target="_blank" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Ekle</a></td> 
							          
						            @elseif($list['movementkind_id']==2) 
							        <td><a href="{{ route('yarn.show2',$list->id)}}" title="Detay" target="_blank" class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
						         <td><a href="{{ route('yarnout',$list->id)}}" title="İplik Çıkış" target="_blank" class="btn btn-xs btn-success"><i class="voyager-truck"></i> Ekle</a></td>
							       	@endif 
							        <td><a href="{{route('yarn.edit',$list->id)}}" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
							    <td class="sil">
							           <div class="delete-form">
                                    <form action="{{route('yarn.destroy', $list->id)}}" method="POST">
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
                    {{$yarn->appends($_GET)->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
<style type="text/css">
    	/*th { font-size: 12px; }
    	td {
    		 font-size: 12px; 
    		font-weight: bold;
    	}*/
    	tr:hover td {background:orange}
    </style>
@endsection
@section('javascript')
<script type="text/javascript">
	  $('#table').on( 'click', 'tbody tr td.sil', function () {
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
            } );
</script>
@endsection
