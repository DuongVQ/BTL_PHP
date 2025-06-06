<!-- filepath: d:\PHP\ecommerce_project\resources\views\admin\orders_pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách đơn hàng</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">DANH SÁCH ĐƠN HÀNG</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ nhận</th>
                <th>Điện thoại</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->rec_address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->product->title ?? '' }}</td>
                <td>{{ number_format($order->product->price ?? 0) }} đ</td>
                <td>
                    @if($order->status == 'pending') Chờ xử lý
                    @elseif($order->status == 'shipping') Đang giao
                    @elseif($order->status == 'completed') Hoàn thành
                    @elseif($order->status == 'cancelled') Hủy
                    @else {{ $order->status }}
                    @endif
                </td>
                <td>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>