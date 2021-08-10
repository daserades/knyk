@extends('voyager::master')
@section('page_header')
    <h1 class="page-title">
      <i class="{{ $dataType->icon }}"></i>
        {{ $dataType->getTranslatedAttribute('display_name_plural') }}
                                <a href="javascript:history.back()" class="btn btn-primary">Geri</a>
      </h1>
@stop


@section('content')
<center>
  
 <table id="numune" width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="{{ Storage::url('article/upload/'.$article->no.'_dobfab.bmp') }}" alt="Smiley face" height="300" width="750">
        </td>

        </tr>
    </table>
      <table id="tahar" width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="{{ Storage::url('article/upload/'.$article->no.'_TEMP0.bmp') }}" alt="Smiley face" style="width:52 height:93;">
        </tr>
    </table>
</center>

{{-- @php $no=explode('-',$article->no); @endphp --}}
@if(!strpos($article->no,'J'))
 @include('des.'.$article->no)
 @else
<center>
<div id="orders-contain" class="ui-widget">

  <table width="900" border="1" cellpadding="0" cellspacing="0" >
          <tr>
          <td rowspan="4"><img src="{{ Storage::url('icons/logo.png') }}" alt="Smiley face" height="87" width="63"></td>
            <td width="51%" rowspan="4" align="center" valign="middle"><strong>ARTICLE DETAY FORMU</strong></td>
            <td width="15%" height="22"><strong>Dökuman No:</strong></td>
            <td width="14%" align="center" valign="middle">FR-0003</td>
          </tr>
          <tr>
            <td height="22"><strong>Yayın Tarihi :</strong></td>
            <td align="center" valign="middle">01.01.2014</td>
          </tr>
          <tr>
            <td height="19"><strong>Revizyon Tar. :</strong></td>
            <td align="center" valign="middle"></td>
          </tr>
          <tr>
            <td height="16"><strong>Revizyon:</strong></td>
            <td align="center" valign="middle">00</td>
          </tr>
  </table>
     <table border="1" cellpadding="0" cellspacing="0" width="900">
      <tr>
        <td width="137" height="5" align="center"><div align="center"><strong>Kaynak Article</strong></div></td>
        <td width="139" align="center"><div align="center"><strong>ısim</strong></div></td>
        <td width="139" align="center"><div align="center"><strong>Müşteri Article</strong></div></td>
        <td width="178" align="center"><div align="center"><strong>Müşteri</strong></div></td>
        <td width="195" align="center"><div align="center"><strong>özellik</strong></div></td>
       </tr>
      <tr>
        <td><div align="center">
          {{$article->no}}
        </div></td>
        <td><div align="center">
          {{$article->isim}}
        </div></td>
        <td><div align="center">
          {{$article->marticle}}
        </div></td>
        <td><div align="center">
          {{$article->musteri}}
        </div></td>
        <td><div align="center">
          {{$article->ozellik}}
        </div></td>
       </tr>
    </table>

    <table border="1" cellpadding="0" cellspacing="0" width="900">
      <tr>
        <td width="224"><div align="center"><strong>Çözgü NE ve Cinsi</strong></div></td>
        <td width="214"><div align="center"><strong>Atkı NE ve Cinsi</strong></div></td>  
        <td width="186"><div align="center"><strong>Çözgü Sıklığı</strong></div></td>
        <td width="166"><div align="center"><strong>Atkı Sıklığı</strong></div></td>
      </tr>
      <tr>
        <td><div align="center">
        @if($article->cne != '') {{$article->cne}} {{$article->cneadet}} {{$article->cnecins}} @endif
        @foreach ($article->harman->where('ac','C') as $list)
          {{$list->ne}} / {{$list->neadet}} {{$list->necins}}
        @endforeach
        </div></td>
        <td> <div align="center">
        @if($article->ane != '') {{$article->ane}} / {{$article->aneadet}}  {{$article->anecins}} @endif
				@foreach ($article->harman->where('ac','A') as $list)
          {{$list->ne}} / {{$list->neadet}} {{$list->necins}}
        @endforeach
       </div></td>
        <td><div align="center">
          {{$article->csik}}
        </div></td>
        <td><div align="center">
          {{$article->asik}}
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
          {{$article->targ}}
        </div></td>
        <td><div align="center">
          {{$article->ctel}}
        </div></td>
        <td><div align="center">
          {{$article->taren}}
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
          {{$article->hamen}}
        </div></td>
        <td><div align="center">
          {{$article->hamgr}}
        </div></td>
        <td><div align="center">
          {{$article->mamen}}
        </div></td>
        <td><div align="center">
          {{$article->mamgr}}
        </div></td>
      </tr>
    </table>

<table id="numune" width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="{{ Storage::url('article/upload/'.$article->no.'_dobfab.bmp') }}" alt="Smiley face" height="300" width="900">
        </td>

        </tr>
    </table>
@endif
@endsection
