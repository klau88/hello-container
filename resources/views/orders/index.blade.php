@extends('app')

@section('title')
    Orders
@endsection

@section('content')
    <div class="flex flex-col justify-center items-center">
        <table>
            <thead>
            <tr>
                <th class="px-2">ID</th>
                <th class="px-2">BL release date</th>
                <th class="px-2">BL release user ID</th>
                <th class="px-2">Freight payer self</th>
                <th class="px-2">Contract number</th>
                <th class="px-2">BL number</th>
                <th class="px-2">Notification sent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="px-2">{{ $order->id }}</td>
                    <td class="px-2">{{ \Carbon\Carbon::parse($order->bl_release_date)->format('d-m-Y') }}</td>
                    <td class="px-2">{{ $order->bl_release_user_id }}</td>
                    <td class="px-2">{{ $order->freight_payer_self ? 'Yes' : 'No' }}</td>
                    <td class="px-2">{{ $order->contract_number }}</td>
                    <td class="px-2">{{ $order->bl_number }}</td>
                    <td class="px-2">{{ $order->notification_sent ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="flex flex-row justify-center items-center w-full">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
