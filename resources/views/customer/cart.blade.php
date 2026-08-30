 @extends('customer.layouts.master')
 @section('content')
    
 <div class="container-fluid py-5">
            <div class="container py-5">
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(empty($cart) || count($cart) == 0)
                    <div class="col-12 text-center py-5">
                        <i class="fa fa-shopping-bag fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Keranjang belanja Anda kosong.</h4>
                        <a href="{{ route('menu') }}" class="btn btn-primary rounded-pill px-4 py-2 mt-3 text-white">Lihat Menu</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                              <tr>
                                <th scope="col">Gambar</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach($cart as $id => $item)
                                    @php
                                        $itemPrice = $item['price'] ?? 0;
                                        $itemQty = $item['quantity'] ?? $item['qty'] ?? 1;
                                        $itemTotal = $itemPrice * $itemQty;
                                        $subtotal += $itemTotal;
                                        $itemImage = $item['image'] ?? 'no-image.jpg';
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ Str::startsWith($itemImage, ['http://', 'https://']) ? $itemImage : asset('img_item_upload/' . $itemImage) }}" 
                                                 alt="{{ $item['item_name'] ?? $item['name'] ?? 'Menu' }}" 
                                                 class="img-fluid rounded" 
                                                 style="width: 80px; height: 80px; object-fit: cover;"
                                                 onerror="this.onerror=null; this.src='https://placehold.co/100x100?text=No+Image';">
                                        </td>
                                        <td class="fw-bold">{{ $item['item_name'] ?? $item['name'] ?? 'Menu' }}</td>
                                        <td>Rp{{ number_format($itemPrice, 0, ',', '.') }}</td>
                                        <td>{{ $itemQty }}</td>
                                        <td>Rp{{ number_format($itemTotal, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm rounded-circle" title="Hapus Item" onclick="return confirm('Hapus menu ini dari keranjang?')">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 justify-content-end mt-1">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h2 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h2>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Subtotal</h5>
                                        <p class="mb-0">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0 me-4">Pajak (10%)</p>
                                        <div>
                                            <p class="mb-0">Rp{{ number_format($subtotal * 0.1, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 mb-4 border-top d-flex justify-content-between">
                                    <h4 class="mb-0 ps-4 me-4">Total</h4>
                                    <h5 class="mb-0 pe-4 text-primary fw-bold">Rp{{ number_format($subtotal + ($subtotal * 0.1), 0, ',', '.') }}</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="mb-0 mb-3">
                                    <a href="{{ route('checkout') }}" class="btn btn-primary rounded-pill py-3 px-4 text-white text-uppercase mb-4">Lanjut ke Pembayaran</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endsection