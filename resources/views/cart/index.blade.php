@extends('layout')

@section('content')
<div class="container mx-auto px-5 py-10">

    <h1 class="text-3xl font-bold mb-6">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) == 0)
        <p class="text-gray-600">Keranjang masih kosong.</p>
    @else

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3">Produk</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Jumlah</th>
                <th class="p-3">Subtotal</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($cart as $item)
            <tr class="border-b">
                <td class="p-3 flex items-center gap-3">
                    <img src="{{ $item['image'] }}" class="w-16 rounded">
                    <span>{{ $item['nama_barang'] }}</span>
                </td>

                <td class="p-3">
                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                </td>

                <td class="p-3">
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                        <input type="number" name="quantity"
                               value="{{ $item['quantity'] }}"
                               min="1"
                               class="w-16 text-center border rounded">

                        <button class="bg-blue-500 text-white px-3 py-1 rounded ml-2">
                            Update
                        </button>
                    </form>
                </td>

                <td class="p-3">
                    Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}
                </td>

                <td class="p-3">
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-right mt-5 text-2xl font-bold">
        Total: Rp {{ number_format($total, 0, ',', '.') }}
    </div>

    <div class="flex justify-end mt-5">
        <a href="/checkout" class="bg-indigo-600 text-white px-6 py-3 rounded">
            Checkout
        </a>
    </div>

    @endif
</div>
@endsection