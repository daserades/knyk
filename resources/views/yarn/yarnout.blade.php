@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        İplik Çıkış Bilgileri
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
                    <tr>
                        <td>
                            Sipariş No   : {{$yarn->order->no  ?? ''}}
                        </td>
                        <td>Firma    :{{ $yarn->company->name ?? ''}}

                        </td>
                        <td>Çıkış Yeri    :{{ $yarn->companytype->name ?? ''}}

                        </td>
                        <td>Çıkış Tarihi     :{{ $yarn->outdate }}
                        </td>
                        <td> İrsaliye No   :   {{ $yarn->dispatchno }}
                        </td>
                        <td> Fatura No   :   {{ $yarn->invoiceno }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   : {{ $yarn->explanation }}
                        </td>
                    </tr>
                </table> 
                 @if($yarn->companytype->name == 'BÜKÜM')
                 <div class="card-header">{{ __('Büküme Gönderilecek İplikler') }}</div>
                <table  class="table table-striped database-tables">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Miktar</td>
                                <td>Max.Miktar</td>
                                <td>Bobin S.</td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($yarntwist as $a)
                        @foreach($a->yarntwistdetail as $list)
                        <tr>
                            <td>{{ $list->yarndetail->lotno ?? $list->yarnstore->lotno ?? ''}}</td>
                            <td>{{ $list->yarndetail->yarnbrand ?? $list->yarnstore->yarnbrand ?? '' }}</td>
                            <td>{{ $list->yarndetail->yarnno ?? $list->yarnstore->yarnno ?? ''}}/{{$list->yarndetail->ne ?? $list->yarnstore->ne ?? ''}}</td>
                            <td>{{ $list->yarndetail->yarntype->name ?? $list->yarnstore->yarntype->name ?? ''}}</td>
                            <td>{{ $list->yarndetail->colortype->name ?? $list->yarnstore->colortype->name ?? ''}}</td>
                            <td>{{ $list->yarndetail->colorno ?? $list->yarnstore->colorno ?? ''}}</td>
                            <td>{{ $list->yarndetail->color ?? $list->yarnstore->color ?? ''}}</td>
                            <td>{{ $list->miktar ?? ''}}</td>
                            <td>{{ $maxmiktar= $list->maxmiktar ?? ''}}</td>
                            <td>{{ $list->bobbin ?? ''}}</td>
                        </tr>
                        @endforeach 
                        @endforeach 
                    </tbody>
                </table>
                        @endif
                <form method="POST" action="{{route('yarnoutdetail')}}">
                    @csrf
                    <div class="card-header">{{ __('Barkod Okutma') }}</div> 
                    <div class="row align-items-center" id="qr">
                        <input id="yarn_id" name="yarn_id" type="hidden" class="form-control" value="{{ $yarn->id }}">
                        <label for="barcode" class="col-md-2 col-form-label text-md-center">{{ __('Barkod') }}</label>

                        <div class="col-md-10">
                            <input id="barcode" maxlength="16" type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}"  autocomplete="barcode" autofocus  placeholder="Barkodu Okutunuz...">
                            @error('barcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </form>
                <div class="card-header">{{ __('Eklenen İplikler') }}</div>

                <table  class="table table-striped database-tables">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>Barcode</td>
                                <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Miktar</td>
                                <td>Brüt Miktar</td>
                                <td>Bobin S.</td>
                                <td>Bölünüp Sevk Edilecek M.</td>
                                <td></td>
                            </div>
                        </tr>
                    </thead>
                    <tbody> 
                        @isset($yarndetail)
                        @foreach($yarndetail as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $list->barcode }}</td>
                            <td>{{ $list->lotno }}</td>
                            <td>{{ $list->yarnbrand }}</td>
                            <td>{{ $list->yarnno }}/{{$list->ne}}</td>
                            <td>{{ $list->yarntype->name ?? ''}}</td>
                            <td>{{ $list->colortype->name ?? ''}}</td>
                            <td>{{ $list->colorno }}</td>
                            <td>{{ $list->color }}</td>
                            <td>{{ $list->amount }}{{ $list->unit->name ?? ''}}</td>
                            <td>{{ $list->amountgross }}{{ $list->unit->name ?? ''}}</td>
                            <td>{{ $list->bobbin ?? ''}}</td>
                            <td class="cuvalbol{{$list->id}}"><input class="form-control" type="number" id="{{$list->id}}" name="cuvalbol" placeholder="Miktar Giriniz.."><input type="hidden" name="kod{{$list->id}}" value="{{$list->barcode}}">
                            </td>
                            <td>
                                <div class="delete-form">
                                    <form action="{{route('yarndetaildestroy', $list->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Sil" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')" class="btn btn-sm btn-danger pull-right delete" title="Sil"><i class="voyager-trash"></i> Sil</button>
                                    </form>
                                </div> 
                            </td>
                        </tr>
                        @endforeach @endisset
                        <tr>
                            <td colspan="9">Toplam</td>
                            <td>{{($yarndetail->sum('amount')) ?? ''}}</td>
                            <td>{{($yarndetail->sum('amountgross')) ?? ''}}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
   $('input[name=cuvalbol]').change(function(){
    $(this).toggle( "highlight" );
    val=$(this).val();
    id=$(this).attr('id');
    barcode=$('input[name=kod'+id).val();
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
    sayfa = '{{ route('cuvalbol') }}';
    $.post(sayfa, {id:id,val:val,barcode:barcode}, function(data) {
        $("#"+id).toggle( "highlight" );
    $('.cuvalbol'+id).append("<a href='{{url('yarn/cuvalboletiket')}}/"+id+"'style='color:black'><i class='fas fa-print fa-2x'></i></a>");
    });
});
</script>
@endsection