@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    <a href="{{route('authorized.create')}}" class="btn btn-xs btn-success"><i class="voyager-plus"></i> Yeni Ekle</a>
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
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>Firma</th>
                                <th>Görev Listesi</th>
                                <th>Telefon</th>
                                <th>Telefon(GSM)</th>
                                <th>Email</th>
                                <th>Açıklama</th>
                                <th>İşlemler</th>
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
            ajax: '{{ route('authorizedjs') }}',
            columns: [
            { data: 'name' ,"defaultContent": "" },
            { data: 'surname' },
            { data: 'company.name' ,"defaultContent": "" },
            { data: 'dutylist.name' ,"defaultContent": "" },
            { data: 'telephone' ,"defaultContent": "" },
            { data: 'mobilephones' ,"defaultContent": "" },
            { data: 'email' ,"defaultContent": "" },
            { data: 'explanation' ,"defaultContent": "" },
            {data: 'action', orderable: false, searchable: false}
            ],
            

        });

} );

    </script>
@stop