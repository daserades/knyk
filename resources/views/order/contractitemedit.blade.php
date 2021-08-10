@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        Sipariş Sözleşmesi Listesi
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
                                    <th><input type="checkbox"  id="checkAll" checked></th>
                                    <td><h3>Maddeler(Items)</h3></td>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="{{ route('contractitemupdate') }}">
                        @csrf
                            @foreach ($contractitem as $list)
                            <tr>                            	
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <td> <input id="item" type="checkbox"  name="item[]" value="{{$list->id}}" 
                                  @if($order->orderitem->where('contractitem_id',$list->id)-> first())checked @endif
                                 ></td>

                                @if($order->language_id ==1) <td>{{ $list->turkce }}</td>
                                @elseif($order->language_id ==2) <td>{{ $list->english }}</td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Kaydet') }}
                                </button>
                                </td>
                            </tr>

                        </form>

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
@endsection
@section('javascript')
<script type="text/javascript">
    
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>
@endsection