@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
			    <a href="{{route('pattern.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Desen No Kayıt</a>
				<a href="{{route('break')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Desen Yükle</a>
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
				<thead>
					<tr>
						<th>Desen Adı</th>
						<th>Müşteri</th>
						<th>Müşteri Article</th>
						<th>M.Çözgü Sık.</th>
						<th>Tarak Eni(cm)</th>
						<th>Mamul Eni(cm)</th>
						<th>M.Atkı Sık.</th>
						<th>Toplam TarakDişi</th>
						<th>C.T.S</th>
						<th>Ham Sıklıklar</th>
						<th>Mamul Sıklıklar</th>
						<th>Tarak No(cm)</th>
						<th>Dişten Geçen Tel</th>
						<th>Ham En</th>
						<th>Ham Gramaj</th>
						<th>Mamul Gramaj</th>
						<th>Atkı Raporu</th>
						<th>Çözgü Raporu</th>
						<th>Açıklama</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
				<tfoot>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
				</tfoot>
			</table>
		</div>
	</div>
</div>
</div>
</div>
@endsection
@section('css')
<link  href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<style type="text/css">
    	th { font-size: 12px; }
      tr:hover td{background:#FF7F50}
    	td {
    		 font-size: 12px; 
    		font-weight: bold;
    	}
	</style>
@endsection
@section('javascript')
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
	$(function() {
		$('#table').on( 'click', 'tbody tr td.sil', function () {
  //var rowData = table.row( this ).data();
                if (confirm('Silmek İstediğinize Emin Misiniz?'))
                    return true;
                else {
                    return false;
                }
            } );
	$('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="3" placeholder="Search '+title+'" />' );
	} );

		table= $('#table').DataTable({
			order:[],    
			processing: true,
			serverSide: true,
			scrollX: true,
			ajax: '{{ route('patternjs') }}',
			columns: [
			{ data: 'design_name', "defaultContent": ""},
			{ data: 'company.name', "defaultContent": ""},
			{ data: 'marticle' , "defaultContent": "" },
			{ data: 'epi' , "defaultContent": "" },
			{ data: 'reed_space' , "defaultContent": "" ,render: $.fn.dataTable.render.number( ',', '.', 0 )},
			{ data: 'finish_width' , "defaultContent": "",render: $.fn.dataTable.render.number( ',', '.', 0 )},
			{ data: 'ppi' , "defaultContent": "" },
			{ data: 'total_dents' , "defaultContent": ""},
			{ data: 'total_ends' , "defaultContent": ""},
			{ data: 'grey_construction' , "defaultContent": ""},
			{ data: 'finish_construction' , "defaultContent": ""},
			{ data: 'reed_count' , "defaultContent": "",render: $.fn.dataTable.render.number( ',', '.', 0 )},
			{ data: 'average_dent'  , "defaultContent": ""},
			{ data: 'gray_width' , "defaultContent": "",render: $.fn.dataTable.render.number( ',', '.', 0 ) },
		    { data: 'gray_glm' , "defaultContent": "",render: $.fn.dataTable.render.number( ',', '.', 3 )},
		    { data: 'finish_glm', "defaultContent": "" ,render: $.fn.dataTable.render.number( ',', '.', 3 ) },
		    { data: 'weft_total'  , "defaultContent": ""},
		    { data: 'warp_total'  , "defaultContent": ""},
		    { data: 'aciklama'  , "defaultContent": ""},
		    { data: 'action', orderable: false, searchable: false}
		    ]
		});

		table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear', function () 
        {
            if ( that.search() !== this.value ) 
            {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });

	});
</script>
@endsection
