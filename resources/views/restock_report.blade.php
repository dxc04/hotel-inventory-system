<h1>Items for Restock - {{ $date }}</h1>

@foreach($data as $room)
<h3>{{ $room['floor'] . ' Floor - Room ' . $room['room'] }}</h3>
<table>
    <thead>
        <tr>
            <th>Location</th>
            <th>Qty</th>
            <th>Item</th>
        </tr>
    </thead>
@foreach($room['items'] as $item)
    <tbody>
        <tr>
            <td>{{ $item['category_name'] }}</td>
            <td>{{ $item['restock_count'] }}</td>
            <td>{{ $item['item_name'] }}</td>
        </tr>
    </tbody>
@endforeach
</table>
@endforeach

<style type="text/css">
table {
    width: 100%;
    margin-top: -10px;
    padding-bottom: 20px;
}
table tr th:first-child , table tr td:first-child {
    width: 30%;
}
table tr th:nth-child(2), table tr td:nth-child(2) {
    width: 20%;
}
table tr th:nth-child(3), table tr td:nth-child(3) {
    width: 50%;
}
table td {
    border: 1px solid grey;
}
table {
  border-collapse: collapse;
}
 th {
  background: #ccc;
}

th, td {
  border: 1px solid #ccc;
  padding: 8px;
}

tr:nth-child(even) {
  background: #efefef;
}

tr:hover {
  background: #d1d1d1;
}
</style>