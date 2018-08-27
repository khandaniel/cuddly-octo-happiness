<tr>
    <td>
        Name:
    </td>
    <td>
        {{ $citizen->name }}
    </td>
</tr>
<tr>
    <td>
        Email:
    </td>
    <td>
        {{ $citizen->email }}
    </td>
</tr>
<tr>
    <td>
        Region:
    </td>
    <td>
        {{ $citizen->region()->ter_name }}
    </td>
</tr>
<tr>
    <td>
        City:
    </td>
    <td>
        {{ $citizen->city()->ter_name }}
    </td>
</tr>
<tr>
    <td>
        Area:
    </td>
    <td>
        {{ $citizen->area()->ter_name }}
    </td>
</tr>