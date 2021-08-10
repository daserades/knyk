@extends('voyager::master')



@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
    </h1>
@stop


@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')

<div class="row">
            <div class="col-md-12">
                    <div class="panel panel-bordered">
                <div class="panel-body">
                  <center>
  <table class="table-striped table-hover table-sm" border="1" >
          <tr>
          <td rowspan="4"><img src="{{ Storage::url('icons/logo.png') }}" alt="Smiley face" height="87" width="63"></td>
            <td width="51%" rowspan="4" align="center" valign="middle"><strong>ARTICLE DETAY FORMU</strong></td>
            <td width="15%" height="22"><strong>Dökuman No:</strong></td>
            <td width="14%" align="center" valign="middle"></td>
          </tr>
          <tr>
            <td height="22"><strong>Yayın Tarihi :</strong></td>
            <td align="center" valign="middle">{{$pattern->created_at ?? ''}}</td>
          </tr>
          <tr>
            <td height="19"><strong>Revizyon Tar. :</strong></td>
            <td align="center" valign="middle">{{$pattern->updated_at ?? ''}} </td>
          </tr>
          <tr>
            <td height="16"><strong>Revizyon:</strong></td>
            <td align="center" valign="middle">00</td>
          </tr>
      <tr>
        <td width="137" height="5" align="center"><div align="center"><strong>Kaynak Article</strong></div></td>
        <td width="139" align="center"><div align="center"><strong>Müşteri Article</strong></div></td>
        <td width="178" align="center"><div align="center"><strong>Müşteri</strong></div></td>
        <td width="195" align="center"><div align="center"><strong>özellik</strong></div></td>
       </tr>
      <tr>
        <td><div align="center">
          {{$pattern->design_name ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->marticle ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->firma->name ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->ozellik ?? ''}}
        </div></td>
       </tr>
      <tr>
        <td width="224"><div align="center"><strong>Çözgü NE ve Cinsi</strong></div></td>
        <td width="214"><div align="center"><strong>Atkı NE ve Cinsi</strong></div></td>  
        <td width="186"><div align="center"><strong>Çözgü Sıklığı</strong></div></td>
        <td width="166"><div align="center"><strong>Atkı Sıklığı</strong></div></td>
      </tr>
      <tr>
        <td><div align="center">
        {{$pattern->grey_construction1 ?? ''}}
        </div></td>
        <td> <div align="center">
        {{$pattern->grey_construction2 ?? ''}}
       </div></td>
        <td><div align="center">
          {{$pattern->epi ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->ppi ?? ''}}
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><strong>Tarak No</strong></div></td>
        <td><div align="center"><strong>Toplam Tel Sayısı</strong></div></td>
        <td><div align="center"><strong>Tarak Eni</strong></div></td>
        <td><div align="center"><strong>örgü</strong></div></td>
      </tr>
      <tr>
        <td><div align="center">
          {{$pattern->reed_count ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->total_ends ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->reed_space ?? ''}}
        </div></td>
        <td><div align="center">
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><strong>Ham En</strong></div></td>
        <td><div align="center"><strong>Ham Gramaj</strong></div></td>
        <td><div align="center"><strong>Mamul Eni</strong></div></td>
        <td><div align="center"><strong>Mamul Gramaj</strong></div></td>
      </tr>
      <tr>
        <td><div align="center">
          {{$pattern->gray_width ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->gray_glm ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->finish_glm ?? ''}}
        </div></td>
        <td><div align="center">
          {{$pattern->finish_width ?? ''}}
        </div></td>
      </tr>
    </table>
<br>
{{-- <center>
<table class="table-striped table-hover" border="1">
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
	</tr>
    <tr>
        <td>{{$pattern->design_name ?? ''}}</td>
        <td>{{$pattern->firma->name ?? ''}}</td>
        <td>{{$pattern->marticle ?? ''}}</td>
        <td>{{$pattern->epi ?? ''}}</td>
        <td>{{$pattern->reed_space ?? ''}}</td>
        <td>{{$pattern->finish_width ?? ''}}</td>
        <td>{{$pattern->ppi ?? ''}}</td>
        <td>{{$pattern->total_dents ?? ''}}</td>
        <td>{{$pattern->total_ends ?? ''}}</td>
        <td>{{$pattern->grey_construction ?? ''}}</td>
        <td>{{$pattern->finish_construction ?? ''}}</td>
        <td>{{$pattern->reed_count ?? ''}}</td>
        <td>{{$pattern->average_dent ?? ''}}</td>
        <td>{{$pattern->gray_width ?? ''}}</td>
        <td>{{$pattern->gray_glm ?? ''}}</td>
        <td>{{$pattern->finish_glm ?? ''}}</td>
    </tr>  
</table> --}}
<table class="table-striped table-hover table-sm" border="1">
	<tr>
		<th>Desen</th>
		<th>Varyant No</th>
		<th>Band</th>
		<th>Renk Adı</th>
		<th>Renk No</th>
		<th>İplik Bilgisi</th>
		<th>KG</th>
		<th>Tel Adet</th>
		<th>Toplam Adet</th>
    <th></th>
	</tr>
        @isset($pattern->patterndetail)
        @php $no=null; $s=$pattern->patterndetail->min('variant_no'); 
        $row=$pattern->patterndetail->where('variant_no',$s)->count();  @endphp 
		@foreach ($pattern->patterndetail as $list)
		<tr>
			@if($no != $list->variant_no)
          	<td rowspan="{{$row}}"><img src="{{ Storage::url('uploads/'.$list->pattern_id.'/'.$list->pattern_id.'-'.$list->variant_no.'.bmp') }}" alt="Smiley face" height="100" width="150"></td>
			<td rowspan="{{$row}}" align="center"> <a href="{{route('patterndetail',[$list->pattern_id,$list->variant_no])}}" target="blank">{{$list->variant_no ?? ''}}</a></td>
       		@php $row=0; @endphp
			@endif
			<td>{{$list->bands->name ?? ''}}</td>
			<td>{{$list->yarn_name ?? ''}}</td>
			<td>{{$list->colorrgb ?? ''}}</td>
			<td>{{$list->yarncount ?? ''}}</td>
			<td>{{$list->quantity ?? ''}}</td>
			<td>{{$list->picksrpt ?? ''}}</td>
			<td>{{$list->tp ?? ''}}</td>
      <td><a href="{{ route('showedit', $list->id) }}" class="btn btn-sm btn-primary pull-right edit" title="Düzenle"><i class="voyager-edit"></i> Düzenle</a></td>
        @php $no=$list->variant_no; $row++; @endphp 
		</tr>
		@endforeach
		@endisset
</table>
@endsection    

@section('css')
	<style type="text/css">
      td:hover {background:#FF7F50}
    	th { font-size: 12px; }
    	td {
    		 font-size: 12px; 
    		font-weight: bold;
    	}
	</style>
@endsection