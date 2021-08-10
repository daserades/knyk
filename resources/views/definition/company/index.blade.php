@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('company.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
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
                                <th>Firma Adı</th>
                                <th>Firma Tipi</th>
                                <th>Ünvan</th>
                                <th>Durum</th>
                                <th></th>
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
<link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
<style type="text/css">
    
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


        var table= $('#table').DataTable({
            order:[], 
            processing: true,
            serverSide: true,
            ajax: '{{ route('companyjs') }}',
            columns: [
            { data: 'name' ,"defaultContent": "" },
            { data: 'companytype.name' ,"defaultContent": "" },
            { data: 'unvan' ,"defaultContent": "" },
            { data: 'status.name' ,"defaultContent": "" },
            {data: 'action', orderable: false, searchable: false}
            ],
            

        });

} );

    </script>
@stop
