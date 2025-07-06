@extends('app')

@section('title')
    Create order
@endsection

@section('content')
    <div class="flex flex-col justify-center items-center">
        <form method="post" action="{{ route('orders.store') }}" class="w-full max-w-sm">
            @csrf

            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label for="bl_release_date" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        BL release date
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input type="date"
                           name="bl_release_date"
                           id="bl_release_date"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                           placeholder="BL release date"
                           value="{{ old('bl_release_date') }}"
                           required
                    >
                </div>
                @error('bl_release_date')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label for="bl_release_user_id"
                           class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        BL release user ID
                    </label>
                </div>
                <div class="w-2/3">
                    <input type="string"
                           name="bl_release_user_id"
                           id="bl_release_user_id"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                           placeholder="BL release user ID"
                           value="{{ old('bl_release_user_id') }}"
                           required
                    >
                </div>
                @error('bl_release_user_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label for="contract_number" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        Contract number
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input type="string"
                           name="contract_number"
                           id="contract_number"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                           placeholder="Contract number"
                           value="{{ old('contract_number') }}"
                           required
                    >
                </div>
                @error('contract_number')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label for="bl_number" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        BL number
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input type="string"
                           name="bl_number"
                           id="bl_number"
                           class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                           placeholder="BL number"
                           value="{{ old('bl_number') }}"
                           required
                    >
                </div>
                @error('bl_number')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3"></div>
                <label for="freight_payer_self" class="md:w-2/3 block text-gray-500 font-bold">
                    <input type="checkbox"
                           name="freight_payer_self"
                           id="freight_payer_self"
                           class="mr-2 leading-tight"
                        {{ old('freight_payer_self') ? 'checked' : '' }}
                    >
                    <span class="text-sm">
                        Freight payer self
                    </span>
                </label>
                @error('freight_payer_self')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button type="submit"
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
