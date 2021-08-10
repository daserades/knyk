@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
       İplik Depo</h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
					<table id="table" class="table table-striped database-tables" border="1">
						<thead>
							<tr>
								<th>Lot No</th>
								<th>İrsaliye No</th>
								<th>Marka</th>
								<th>Cins</th>
								<th>Boya Cins</th>
								<th>No-Ne</th>
								<th>Büküm S.</th>
								<th>Renk 1</th>
								<th>Renk 2</th>
								<th>Renk No1</th>
								<th>Renk No2</th>
								<th>Miktar</th>
								<th>Brüt M.</th>
								<th>Birim</th>
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
						</tfoot>
						
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
@endsection
@section('javascript')
<script>
	$(function() {
		 $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="8" placeholder="Search '+title+'" />' );
    } ); 

		var table= $('#table').DataTable({
			//order : //['5','desc'],    
			order:[],    
			processing: true,
			ajax: '{{ route('yarn.storejs') }}',
			columns: [
			{ data: 'lotno' ,"defaultContent": ""},
			{ data: 'dispatchno' ,"defaultContent": ""},
			{ data: 'yarnbrand' ,"defaultContent": ""},
			// {data: null , name:'yarnbrand' ,render: function ( data, type, row) {
   //              //console.log(row);
   //              if (row.yarnbrand != null) return '<a href="{{url('iplikirsaliye/showreport3')}}/'+row.yarnno+'/'+row.ne+'/'+row.yarntyype_id+'/'+row.lotno+'/'+row.colorno+'" target="_blank">'+row.yarnbrand+'</a>';
   //          } ,"defaultContent": ""},
			{ data: 'yarntype' ,"defaultContent": ""},
			{ data: 'colortype' ,"defaultContent": ""},
			{ data: 'yarnno' ,"defaultContent": ""},
			{ data: 'ne' ,"defaultContent": ""},
			{ data: 'color' ,"defaultContent": ""},
			{ data: 'colorsim' ,"defaultContent": ""},
			{ data: 'colorno' ,"defaultContent": ""},
			{ data: 'colornosim' ,"defaultContent": ""},
			{ data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 2) ,"defaultContent": ""},
			{ data: 'amountgross' , render: $.fn.dataTable.render.number( '.', ',', 2) ,"defaultContent": ""},
			{ data: 'unit' ,"defaultContent": ""}
			]
		});

		table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

	});
</script>
@endsection