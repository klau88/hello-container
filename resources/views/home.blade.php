@extends('app')

@section('title')
    HelloContainer
@endsection

@section('content')
    <div class="grid h-screen place-items-center">
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('orders.index') }}">Go to orders</a>
    </div>
@endsection
