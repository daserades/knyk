@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('order.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
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
                            <div class="col-md-6">
                                <td><h6>No</h6></td>
                                <td><h6>Firma Adı</h6></td>
                                <td><h6>Sipariş Tarihi</h6></td>
                                <td><h6>Yetkili</h6></td>
                                <td><h6></h6></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('css')
{{-- <link  href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('javascript')
{{-- <script src="{{ asset('DataTables/datatables.min.js') }}"></script> --}}
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


        var table= $('#table').DataTable({
            order:[], 
            processing: true,
            serverSide: true,
        
        //     "language": {
        //     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
        // },
            dom: 'Blfrtip',
            ajax: '{{ route('orderjs') }}',
            columns: [
            { data: 'no' },
            { data: 'company.name' ,"defaultContent": "" },
            { data: 'date' ,"defaultContent": "" },
            { data: 'authorized.name' ,"defaultContent": "" },
            {data: 'action', orderable: false, searchable: false}
            ],
            

        });

} );










    
</script>
@endsection

