<tr>
    <td colspan="2" style="padding: 20px 50px; background-color: pink; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;">User already exists</td>
</tr>
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
        {{ $citizen->area()->ter_name ?? "Район не указан" }}
    </td>
</tr>