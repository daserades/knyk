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
               <table id="table" class="table table-striped database-tables">
 <thead>
                        <tr>
                                  <td></td>
                                  <td>no</td>
                                  <td>varyant</td>
                                  <td>isim</td>
                                  <td>tip</td>
                                  <td>seri</td>
                                  <td>ozellik</td>
                                  <td>comp</td>
                                  <td>cne</td>
                                  <td>cneadet</td>
                                  <td>cnecins</td>
                                  <td>cipcins</td>
                                  <td>citt</td>
                                  <td>ane</td>
                                  <td>aneadet</td>
                                  <td>anecins</td>
                                  <td>aipcins</td>
                                  <td>aitt</td>
                                  <td>csik</td>
                                  <td>asik</td>
                                  <td>targ</td>
                                  <td>ctel</td>
                                  <td>nm</td>
                                  <td>cek</td>
                                  <td>taren</td>
                                  <td>orgu</td>
                                  <td>marticle</td>
                                  <td>musteri</td>
                                  <td>hamen</td>
                                  <td>hamgr</td>
                                  <td>mamen</td>
                                  <td>mamgr</td>
                                  <td>icgr</td>
                                  <td>iagr</td>
                                  <td>cgr</td>
                                  <td>agr</td>
                                  <td>oipfiyat</td>
                                  <td>oipkur</td>
                                  <td>ack</td>
                                  <td>desenack</td>
                                  <td>projeid</td>
                                  <td>date</td>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                    <tfoot> 
                      <td></td>
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
        th { font-size: 11px; }
        td {
             font-size: 10px; 
            font-weight: bold;
        }
        tr:hover td {background:#FF7F50}
        /*th.asd input[type="text"]
            {
            font-weight: bold;
                font-size:16px;
                width:120px;
            }*/
            
    </style>
@endsection
@section('javascript')
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script>
    $(function() {
      $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" size="3" placeholder="Search '+title+'" />' );
  } );

        var table= $('#table').DataTable({
            order:[], 
            processing: true,
            // serverSide: true,
            scrollX: true,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        },
            dom: 'Blfrtip',
            ajax: '{{ route('articlejs') }}',
            columns: [
            {data: 'action', orderable: false, searchable: false},
            {data:'no', "defaultContent": ""},
            {data:'varyant', "defaultContent": ""},
            {data:'isim', "defaultContent": ""},
            {data:'tip', "defaultContent": ""},
            {data:'seri', "defaultContent": ""},
            {data:'ozellik', "defaultContent": ""},
            {data:'comp', "defaultContent": ""},
            {data:'cne', "defaultContent": ""},
            {data:'cneadet', "defaultContent": ""},
            {data:'cnecins', "defaultContent": ""},
            {data:'cipcins', "defaultContent": ""},
            {data:'citt', "defaultContent": ""},
            {data:'ane', "defaultContent": ""},
            {data:'aneadet', "defaultContent": ""},
            {data:'anecins', "defaultContent": ""},
            {data:'aipcins', "defaultContent": ""},
            {data:'aitt', "defaultContent": ""},
            {data:'csik', "defaultContent": ""},
            {data:'asik', "defaultContent": ""},
            {data:'targ', "defaultContent": ""},
            {data:'ctel', "defaultContent": ""},
            {data:'nm', "defaultContent": ""},
            {data:'cek', "defaultContent": ""},
            {data:'taren', "defaultContent": ""},
            {data:'orgu', "defaultContent": ""},
            {data:'marticle', "defaultContent": ""},
            {data:'musteri', "defaultContent": ""},
            {data:'hamen', "defaultContent": ""},
            {data:'hamgr', "defaultContent": ""},
            {data:'mamen', "defaultContent": ""},
            {data:'mamgr', "defaultContent": ""},
            {data:'icgr', "defaultContent": ""},
            {data:'iagr', "defaultContent": ""},
            {data:'cgr', "defaultContent": ""},
            {data:'agr', "defaultContent": ""},
            {data:'oipfiyat', "defaultContent": ""},
            {data:'oipkur', "defaultContent": ""},
            {data:'ack', "defaultContent": ""},
            {data:'desenack', "defaultContent": ""},
            {data:'projeid', "defaultContent": ""},
            {data:'date', "defaultContent": ""},
            ],
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

} );    
</script>
@endsection

