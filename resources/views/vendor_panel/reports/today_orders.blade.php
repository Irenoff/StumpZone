<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Today's Orders Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Today's Orders Report - {{ $date }}</h2>
    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer Email</th>
                <th>Address</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th>Placed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $o)
                <tr>
                    <td>{{ $o->order_number ?? $o->id }}</td>
                    <td>{{ $o->customer_email }}</td>
                    <td>{{ $o->customer_address }}</td>
                    <td>Rs. {{ number_format($o->grand_total ?? 0, 2) }}</td>
                    <td>{{ ucfirst($o->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($o->created_at)->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
