@extends('layout')
@section('content')
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Checkout Form -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Data Pemesan</h2>
                    
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-4">

                            <div>
                                <label class="block text-sm font-medium mb-2">Nama Lengkap *</label>
                                <input type="text" 
                                       name="customer_name" 
                                       value="{{ old('customer_name') }}"
                                       required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                @error('customer_name')
                                    <p class="text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Email *</label>
                                <input type="email" 
                                       name="customer_email" 
                                       value="{{ old('customer_email') }}"
                                       required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                @error('customer_email')
                                    <p class="text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Nomor Telepon *</label>
                                <input type="text" 
                                       name="customer_phone" 
                                       value="{{ old('customer_phone') }}"
                                       required
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                @error('customer_phone')
                                    <p class="text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Alamat Pengiriman</label>
                                <textarea name="customer_address"
                                          rows="3"
                                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                    <p class="text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Catatan</label>
                                <textarea name="notes"
                                          rows="3"
                                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-600 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-6 flex gap-4">
                            <a href="{{ route('cart.index') }}" 
                               class="px-6 py-2 border rounded-lg text-gray-700 hover:bg-gray-50">
                                Kembali ke Keranjang
                            </a>

                            <button type="submit" 
                                    class="flex-1 bg-indigo-500 text-white py-2 px-6 rounded-lg hover:bg-indigo-600">
                                Buat Pesanan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-4">
                        @foreach($cart as $item)
                            <div class="flex items-center gap-3 pb-3 border-b">
                                
                                <img src="{{ $item['image'] ?: 'https://dummyimage.com/150x150' }}" 
                                     class="w-16 h-16 object-cover rounded">

                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold">{{ $item['nama_barang'] }}</h3>
                                    <p class="text-xs text-gray-500">
                                        Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    </p>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 mb-4">

                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Item</span>
                            <span class="font-medium">{{ count($cart) }} item</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between">
                                <span class="font-bold text-lg">Total</span>
                                <span class="font-bold text-lg">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection