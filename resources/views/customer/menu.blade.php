@extends('customer.layouts.master')

@section('content')
 <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-3">
                            <div class="col-lg">
                                <div class="row g-4 justify-content-center">

                                @forelse($items as $item)
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <img src="{{ asset('img_item_upload/' . $item->image) }}" class="img-fluid w-100 rounded-top" alt="" onerror="this.onerror=null; this.src='{{ $item->image }}';" style="height: 220px; object-fit: cover;">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                            @if(($item->category->cat_name ?? '') == "Makanan")
                                                <i class="fa fa-utensils me-1"></i>
                                            @elseif(($item->category->cat_name ?? '') == "Minuman")
                                                <i class="fa fa-coffee me-1"></i>
                                            @else 
                                                <i class="fa fa-tag me-1"></i>
                                            @endif
                                            {{ $item->category->cat_name ?? 'Menu' }}
                                        </div>

                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ $item->item_name }}</h4>
                                            <p class="text-limited">{{ $item->description }}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                                <a href="#" onclick="addToCart({{ $item->id }})" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah Keranjang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center py-5">
                                    <h5 class="text-muted">Belum ada menu yang tersedia.</h5>
                                </div>
                                @endforelse
                                    <!-- Pagination -->
                                    <!-- <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <a href="#" class="rounded">&laquo;</a>
                                            <a href="#" class="active rounded">1</a>
                                            <a href="#" class="rounded">2</a>
                                            <a href="#" class="rounded">3</a>
                                            <a href="#" class="rounded">4</a>
                                            <a href="#" class="rounded">5</a>
                                            <a href="#" class="rounded">6</a>
                                            <a href="#" class="rounded">&raquo;</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script>
    function addToCart(menuId) {
        fetch("{{ route('add.to.cart') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({id: menuId})
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message || 'Menu berhasil ditambahkan ke keranjang!');
                const badge = document.querySelector('.badge');
                if (badge && data.cart_count !== undefined) {
                    badge.textContent = data.cart_count;
                }
            } else {
                alert(data.message || 'Gagal menambahkan menu ke keranjang.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menambahkan menu ke keranjang.');
        });
    }
</script>
@endsection