<tr>
    <td colspan="17">Ara Toplam</td>
    <td>{{ $list->where('yarn_id', $id)->count('amount') }} ad.</td>
    <td>{{ $list->where('yarn_id', $id)->sum('amount') }} </td>
    <td>{{ $list->where('yarn_id', $id)->sum('amountgross') }} </td>
</tr>
<tr>
    <td colspan="20"></td>
</tr>