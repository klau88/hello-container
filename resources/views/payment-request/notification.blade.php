@component('mail::message')
    <div>
        <div>{{ $greeting }}</div>
        <div>BL release date: {{$order['bl_release_date']}}</div>
        <div>BL release user ID: {{$order['bl_release_user_id']}}</div>
        <div>Freight payer self: {{$order['freight_payer_self'] ? 'Yes' : 'No' }}</div>
        <div>Contract number: {{$order['contract_number']}}</div>
        <div>BL number: {{$order['bl_number']}}</div>
        <div>{{ $salutation }}</div>
    </div>
@endcomponent
