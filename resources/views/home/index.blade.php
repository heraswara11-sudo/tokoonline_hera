@extends('layout')

@section('content')

{{-- Ambil satu produk pertama untuk ditampilkan pada Hero --}}
@php
    $product = \App\Models\Produk::first();
@endphp

{{-- ========================= HERO SECTION ========================= --}}
<section class="text-gray-600 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">

        {{-- Gambar Produk --}}
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded" 
                 alt="Product"
                 src="{{ $product ? $product->getFirstMediaUrl('produk_images') : 'https://dummyimage.com/600x400' }}">
        </div>

        {{-- Detail Produk --}}
        <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 
                    flex flex-col md:items-start md:text-left items-center text-center">

            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                {{ $product->nama_barang ?? 'Nama Produk' }}
            </h1>

            {{-- DESKRIPSI BARU --}}
            <p class="mb-8 leading-relaxed text-justify">
                Cushion makeup multifungsi yang menggabungkan foundation & bedak dalam satu kemasan praktis — sempurna untuk kamu yang ingin makeup cepat tapi tetap flawless 🍃. Cushion ini punya coverage tinggi tapi tetap ringan di wajah, membuat kulit tampak halus, merata, dan natural sepanjang hari. Formulanya juga diperkaya dengan kandungan skincare yang membantu melembapkan & merawat kulit, jadi bukan sekadar makeup biasa.
            </p>

            {{-- Tombol --}}
            <div class="flex justify-center">
                @if($product)
                <a href="{{ route('product.detail', $product->id) }}" 
                   class="inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 
                          focus:outline-none hover:bg-gray-200 rounded text-lg">
                    Lihat Detail
                </a>
                @endif
            </div>

        </div>
    </div>
</section>



{{-- ========================= PRODUK LAINNYA ========================= --}}
<section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 pb-24 pt-4 mx-auto">

        <h2 class="text-5xl font-medium text-gray-900 title-font mb-24 text-center">
            Produk Lainnya
        </h2>

        @php
            $product = \App\Models\Produk::all();
        @endphp

        <div class="-my-8 divide-y-2 divide-gray-100">

            @foreach ($product as $item)
            <div class="py-8 flex flex-wrap md:flex-nowrap">

                {{-- Gambar Produk --}}
                <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                    <img class="object-cover object-center rounded-full border-5 border-gray-200 
                                w-48 h-48 p-2" 
                         src="{{ $item->getFirstMediaUrl('product_images') }}" 
                         alt="{{ $item->nama_barang }}">
                </div>

                {{-- Detail Produk --}}
                <div class="md:flex-grow">
                    <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">
                        {{ $item->nama_barang }}
                    </h2>

                    <p class="leading-relaxed">
                        {{ $item->product_description_short }}
                    </p>

                    {{-- Tombol Lihat Detail --}}
                    <a href="{{ route('product.detail', $item->id) }}" 
                       class="text-indigo-500 inline-flex items-center mt-4">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" 
                             stroke-width="2" fill="none" stroke-linecap="round" 
                             stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

            </div>
            @endforeach

        </div>
    </div>
</section>

@endsection