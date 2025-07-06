@extends('app')

@section('title')
    Orders
@endsection

@section('content')
    <div class="flex flex-col justify-center items-center">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>BL release date</th>
                <th>BL release user ID</th>
                <th>Freight payer self</th>
                <th>Contract number</th>
                <th>BL number</th>
                <th>Notification sent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->bl_release_date)->format('d-m-Y') }}</td>
                    <td>{{ $order->bl_release_user_id }}</td>
                    <td>{{ $order->freight_payer_self ? 'Yes' : 'No' }}</td>
                    <td>{{ $order->contract_number }}</td>
                    <td>{{ $order->bl_number }}</td>
                    <td>{{ $order->notification_sent ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="flex flex-row justify-center items-center w-full">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
