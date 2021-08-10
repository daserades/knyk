<tr>
    <td colspan="6">Ara Toplam</td>
    <td>{{ $list->where('lotno', $yarntype_id)->where('yarn_id', $id)->count('amount') }} ad.</td>
    <td>{{ $list->where('lotno', $yarntype_id)->where('yarn_id', $id)->sum('amount') }} </td>
</tr>
<tr>
    <td colspan="8"></td>
</tr>