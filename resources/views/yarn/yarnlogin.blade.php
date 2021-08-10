@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        İplik Giriş Bilgileri
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
                        <td>Firma    :{{ $yarn->company->name }}

                        </td>
                        <td>Firma Tipi    :{{ $yarn->companytype->name }}

                        </td>
                        <td>Giriş Tarihi     :{{ $yarn->logindate }}
                        </td>
                        <td> İrsaliye No   :   {{ $yarn->dispatchno }}
                        </td>
                        <td> Fatura No   :   {{ $yarn->invoiceno }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Açıklama   :    {{ $yarn->explanation }}
                        </td>
                    </tr>
                </table> 
                   @if($yarn->companytype->name == 'BÜKÜM')
                 <div class="card-header">{{ __('Büküme Gönderilen İplikler') }}</div>
                <table border="1" class="table table-striped database-tables">
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td>Lot No</td>
                                <td>İplik Marka</td>
                                <td>İplik No-Ne</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>Bobin Sayısı</td>
                                <td>Renk No</td>
                                <td>Renk</td>
                                <td>Miktar</td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>  @foreach($yarntwist as $a)
                        @foreach($a->yarntwistdetail as $list)
                        <tr>
                             <td>{{ $list->yarndetail->lotno ?? $list->yarnstore->lotno ?? ''}}</td>
                            <td>{{ $list->yarndetail->yarnbrand ?? $list->yarnstore->yarnbrand ?? ''}}</td>
                            <td>{{ $list->yarndetail->yarnno ?? $list->yarnstore->yarnno ?? ''}}/{{$list->yarndetail->ne ?? $list->yarnstore->ne ?? ''}}</td>
                            <td>{{ $list->yarndetail->yarntype->name ?? $list->yarnstore->yarntype->name ?? ''}}</td>
                            <td>{{ $list->yarndetail->colortype->name ?? $list->yarnstore->colortype->name ?? ''}}</td>
                            <td>{{ $list->yarndetail->bobbin ?? $list->yarnstore->bobbin ?? ''}}</td>
                            <td>{{ $list->yarndetail->colorno ?? $list->yarnstore->colorno ?? ''}}</td>
                            <td>{{ $list->yarndetail->color ?? $list->yarnstore->color ?? ''}}</td>
                            <td>{{ $list->amount ?? ''}}</td>
                        </tr>
                        @endforeach 
                        @endforeach 
                    </tbody>
                </table>
                        @endif
                <table class="table table-striped database-tables">
                    {{-- <input id="yarn_id" name="yarn_id" type="hidden" class="form-control" value="{{ $yarn->id }}"> --}}
                    <thead>
                        <tr>
                            <div class="col-md-6">
                                <td></td>
                                <td>İplik Markası</td>
                                <td>Lot No</td>
                                <td>İplik Cinsi</td>
                                <td>Boya Cinsi</td>
                                <td>İplik No-Ne</td>
                                <td>Büküm Sayısı</td>
                                <td>Renk</td>
                                <td>Renk No</td>
                                <td>Renk2</td>
                                <td>Renk No2</td>
                                <td>Bobin S.</td>
                                <td>Brüt Miktar</td>
                                <td>Birim</td>
                                <td>Miktar</td>
                                <td>
                                    <a  href="{{route('topluetiket',$yarn->id)}}"style="color:black" title="TOPLU YAZDIR"><i class="voyager-zoom-in"></i></a>
                                </td>
                            </div>
                        </tr>
                    </thead>
                    <tbody>
                   @if($yarn->companytype->name == 'BÜKÜM')
                    @isset($yarn->barcode_piece)
                        @for($i=1; $i <= $yarn->barcode_piece; $i++)
                        <tr>
                             <td>
                                <label>{{$i}}</label>
                            </td>
                            <td>
                                <input id="yarnbrand{{$i}}" type="text" class="form-control @error('yarnbrand') is-invalid @enderror" name="yarnbrand" value="{{ $yarn->yarndetail->where('place',$i)->pluck('yarnbrand')->first() }}"  autocomplete="yarnbrand" autofocus>
                                <input id="yarn_id" name="yarn_id" type="hidden" class="form-control" value="{{ $yarn->id }}">
                                <input id="yarndetail_id{{$i}}" name="yarndetail_id" type="hidden" class="form-control" value="{{ $yarn->yarndetail->where('place',$i)->pluck('id')->first() }}">
                            </td>
                            <td>
                                <input id="lotno{{$i}}" type="text" class="form-control @error('lotno') is-invalid @enderror" name="lotno" value="{{ $yarn->yarndetail->where('place',$i)->pluck('lotno')->first() }}"  autocomplete="lotno" autofocus>
                            </td>
                            <td>
                                <select id="yarntype_id{{$i}}" name='yarntype_id' class="form-control  @error('yarntype_id') is-invalid @enderror" >
                                    <option value="{{ $yarn->yarndetail->where('place',$i)->pluck('yarntype_id')->first() }}">{{ $yarn->yarndetail->where('place',$i)->pluck('yarntype.name')->first() }} </option>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($yarntype as $list)
                                    <option value="{{$list->id}}" id="yarntype_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="colortype_id{{$i}}" name='colortype_id' class="form-control  @error('colortype_id') is-invalid @enderror" >
                                    <option value="{{ $yarn->yarndetail->where('place',$i)->pluck('colortype_id')->first() }}">{{ $yarn->yarndetail->where('place',$i)->pluck('colortype.name')->first() }} </option>
                                    @foreach ($colortype as $list)
                                    <option value="{{$list->id}}" id="boyains_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="90">
                                <input id="yarnno{{$i}}" type="number" class="form-control @error('yarnno') is-invalid @enderror" value="{{$yarn->yarndetail->where('place',$i)->pluck('yarnno')->first()}}" name="yarnno"  autocomplete="yarnno" autofocus>
                            </td>
                            <td width="90">
                                <input id="ne{{$i}}" type="number" class="form-control @error('ne') is-invalid @enderror" name="ne" value="{{$yarn->yarndetail->where('place',$i)->pluck('ne')->first()}}"  autocomplete="ne" autofocus>
                            </td>
                            <td>
                                <input id="color{{$i}}" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $yarn->yarndetail->where('place',$i)->pluck('color')->first() }}"  autocomplete="color" autofocus>
                            </td>
                            <td>
                                <input id="rno{{$i}}" type="text" class="form-control @error('rno') is-invalid @enderror" name="rno" value="{{ $yarn->yarndetail->where('place',$i)->pluck('colorno')->first() }}"  autocomplete="rno" autofocus>
                            </td>
                            <td width="90">
                                <input id="sim{{$i}}" type="text" class="form-control @error('sim') is-invalid @enderror" name="sim" value="{{ $yarn->yarndetail->where('place',$i)->pluck('colorsim')->first() }}"  autocomplete="sim" autofocus>
                            </td>
                            <td width="90">
                                <input id="sno{{$i}}" type="text" class="form-control @error('sno') is-invalid @enderror" name="sno" value="{{ $yarn->yarndetail->where('place',$i)->pluck('colornosim')->first() }}"  autocomplete="sno" autofocus>
                            </td>
                            <td width="90">
                                <input id="bobbin{{$i}}" type="text" class="form-control @error('bobbin') is-invalid @enderror" name="bobbin" value="{{ $yarn->yarndetail->where('place',$i)->pluck('bobbin')->first() }}"  autocomplete="bobbin" autofocus>
                            </td>
                             <td width="90"> 
                                <input id="amountgross{{$i}}" type="number" class="form-control @error('amountgross') is-invalid @enderror" name="amountgross" value="{{ $yarn->yarndetail->where('place',$i)->pluck('amountgross')->first() }}"  autocomplete="amountgross" autofocus>
                            </td>
                            <td><select id="unit_id{{$i}}" name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" >
                                    <option value="{{ $yarn->yarndetail->where('place',$i)->pluck('unit_id')->first() }}">{{ $yarn->yarndetail->where('place',$i)->pluck('unit.name')->first() }} </option>
                                    @foreach ($unit as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                             <td width="90"> <input id="amount{{$i}}" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $yarn->yarndetail->where('place',$i)->pluck('amount')->first() }}"  autocomplete="amount" autofocus required>
                             </td> 
                             @if ($yarn->yarndetail->where('place',$i)->pluck('id')->first())
                                <td>
                                    <a  href="{{route('etiket',$yarn->yarndetail->where('place',$i)->pluck('id')->first())}}"style="color:black" title="YAZDIR"><i class="voyager-zoom-in"></i></a>
                                </td>
                                @endif
                           </tr>
                        @endfor
                        @endisset
                    @else
                        @isset($yarn->barcode_piece)
                        @for($i=1; $i <= $yarn->barcode_piece; $i++)
                        <tr>
                            <td>
                                <label>{{$i}}</label>
                            </td>
                            <td>
                                <input id="yarnbrand{{$i}}" type="text" class="form-control @error('yarnbrand') is-invalid @enderror" name="yarnbrand" value="{{ $yarn->yarndetail->where('place',$i)->pluck('yarnbrand')->first() }}"  autocomplete="yarnbrand" autofocus>
                                <input id="yarn_id" name="yarn_id" type="hidden" class="form-control" value="{{ $yarn->id }}">
                                <input id="yarndetail_id{{$i}}" name="yarndetail_id" type="hidden" class="form-control" value="{{ $yarn->yarndetail->where('place',$i)->pluck('id')->first() }}">
                            </td>
                            <td>
                                <input id="lotno{{$i}}" type="text" class="form-control @error('lotno') is-invalid @enderror" name="lotno" value="{{ $yarn->yarndetail->where('place',$i)->pluck('lotno')->first() }}"  autocomplete="lotno" autofocus>
                            </td>
                            <td>
                                <select id="yarntype_id{{$i}}" name='yarntype_id' class="form-control  @error('yarntype_id') is-invalid @enderror" >
                                    <option value="{{ $yarn->yarndetail->where('place',$i)->pluck('yarntype_id')->first() }}">{{ $yarn->yarndetail->where('place',$i)->pluck('yarntype.name')->first() }} </option>
                                    <option value="">Seçiniz..</option>
                                    @foreach ($yarntype as $list)
                                    <option value="{{$list->id}}" id="yarntype_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="colortype_id{{$i}}" name='colortype_id' class="form-control  @error('colortype_id') is-invalid @enderror" >
                                    <option value="{{ $yarn->yarndetail->where('place',$i)->pluck('colortype_id')->first() }}">{{ $yarn->yarndetail->where('place',$i)->pluck('colortype.name')->first() }} </option>
                                    @foreach ($colortype as $list)
                                    <option value="{{$list->id}}" id="boyains_id">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="90">
                                <input id="yarnno{{$i}}" type="number" class="form-control @error('yarnno') is-invalid @enderror" value="{{$yarn->yarndetail->where('place',$i)->pluck('yarnno')->first()}}" name="yarnno"  autocomplete="yarnno" autofocus>
                            </td>
                            <td width="90">
                                <input id="ne{{$i}}" type="number" class="form-control @error('ne') is-invalid @enderror" name="ne" value="{{$yarn->yarndetail->where('place',$i)->pluck('ne')->first()}}"  autocomplete="ne" autofocus>
                            </td>
                            <td>
                                <input id="color{{$i}}" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $yarn->yarndetail->where('place',$i)->pluck('color')->first() }}"  autocomplete="color" autofocus>
                            </td>
                            <td>
                                <input id="rno{{$i}}" type="text" class="form-control @error('rno') is-invalid @enderror" name="rno" value="{{ $yarn->yarndetail->where('place',$i)->pluck('colorno')->first() }}"  autocomplete="rno" autofocus>
                            </td>
                            <td width="90">
                                <input id="sim{{$i}}" type="text" class="form-control @error('sim') is-invalid @enderror" name="sim" value="{{ $yarn->yarndetail->where('place',$i)->pluck('colorsim')->first() }}"  autocomplete="sim" autofocus>
                            </td>
                            <td width="90">
                                <input id="sno{{$i}}" type="text" class="form-control @error('sno') is-invalid @enderror" name="sno" value="{{ $yarn->yarndetail->where('place',$i)->pluck('colornosim')->first() }}"  autocomplete="sno" autofocus>
                            </td>
                            <td width="90">
                                <input id="bobbin{{$i}}" type="text" class="form-control @error('bobbin') is-invalid @enderror" name="bobbin" value="{{ $yarn->yarndetail->where('place',$i)->pluck('bobbin')->first() }}"  autocomplete="bobbin" autofocus>
                            </td>
                             <td width="90"> 
                                <input id="amountgross{{$i}}" type="number" class="form-control @error('amountgross') is-invalid @enderror" name="amountgross" value="{{ $yarn->yarndetail->where('place',$i)->pluck('amountgross')->first() }}"  autocomplete="amountgross" autofocus>
                            </td>
                            <td><select id="unit_id{{$i}}" name='unit_id' class="form-control  @error('unit_id') is-invalid @enderror" >
                                    <option value="{{ $yarn->yarndetail->where('place',$i)->pluck('unit_id')->first() }}">{{ $yarn->yarndetail->where('place',$i)->pluck('unit.name')->first() }} </option>
                                    @foreach ($unit as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                             <td width="90"> <input id="amount{{$i}}" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $yarn->yarndetail->where('place',$i)->pluck('amount')->first() }}"  autocomplete="amount" autofocus required>
                             </td> 
                             @if ($yarn->yarndetail->where('place',$i)->pluck('id')->first())
                                <td>
                                    <a  href="{{route('etiket',$yarn->yarndetail->where('place',$i)->pluck('id')->first())}}"style="color:black" title="YAZDIR"><i class="voyager-zoom-in"></i></a>
                                </td>
                                @endif
                           </tr>
                        @endfor
                        @endisset
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
  
    $('input[name=yarnbrand],input[name=lotno],input[name=yarnno],input[name=ne],input[name=color],input[name=rno],input[name=sim],input[name=sno],input[name=amountgross],input[name=bobbin]').change(function(){
        var a   = $(this).attr('name');
        var val = $(this).val();
        id      = $(this).attr('id').substring(a.length);
        if (id == 1) {
            $('input[name*=' + a + ']').val(val);
        }
    });

    $('select[name=yarntype_id], select[name=colortype_id], select[name=unit_id]').change(function(){
       
        var a= $(this).attr('name');
        var val= $(this).val();
        id= $(this).attr('id').substring(a.length);
        var c= $('#'+a+id+' option:selected').val();
        if (id==1){
                $("select[name*="+a+"] option[value="+c+"]").attr('selected', 'selected');
            }
    })

     $('input[id*=amount],input[id*=yarnbrand],input[id*=lotno],select[id*=yarntype_id],select[id*=colortype_id],input[id*=yarnno],input[id*=ne],input[id*=color],input[id*=rno],input[id*=sim],input[id*=sno],input[id*=amountgross],input[id*=bobbin],select[id*=unit_id]').change(function(){
        $(this).toggle( "highlight" );
        var val= $(this).val(); 
        var a=$(this).attr('name');
        id = $(this).attr('id').substring(a.length);
        var yarnbrand = $('#yarnbrand'+id).val();
        var lotno = $('#lotno'+id).val();
        var yarntype_id = $('#yarntype_id'+id).val();
        var colortype_id = $('#colortype_id'+id).val();
        var yarnno = $('#yarnno'+id).val();
        var ne = $('#ne'+id).val();
        var color = $('#color'+id).val();
        var rno = $('#rno'+id).val();
        var sim = $('#sim'+id).val();
        var sno= $('#sno'+id).val();
        var amount = $('#amount'+id).val();
        var amountgross = $('#amountgross'+id).val();
        var bobbin = $('#bobbin'+id).val();
        var unit_id = $('#unit_id'+id).val();
        var yarn_id = $('#yarn_id').val();
        var yarndetail_id = $('#yarndetail_id'+id).val();
        // alert(yarndetail_id+' '+yarn_id+' '+yarnbrand+' '+lotno+' '+yarntype_id+' '+colortype_id+' '+yarnno+' '+ne+' '+color+' '+rno+' '+amountgross+' '+unit_id+' '+val);
         // $( "input[id][name$='man']" ).val( "only this one" ); mutiple attribute
            $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            sayfa = '{{ route('yarnlogindetail') }}';
            $.post(sayfa, {yarnbrand: yarnbrand,lotno:lotno,yarntype_id:yarntype_id,colortype_id:colortype_id ,yarnno:yarnno,ne:ne,color:color,colorno:rno,amountgross:amountgross,bobbin:bobbin, unit_id:unit_id,yarn_id:yarn_id,amount:amount,place:id,yarndetail_id:yarndetail_id ,colornosim:sno,colorsim:sim}, function(data) {
                $("#"+a+id).toggle( "highlight" );
                console.log(data);
            });
     });
</script>
@endsection