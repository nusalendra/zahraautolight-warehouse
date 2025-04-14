@extends('layouts/contentNavbarLayout')
@section('title', 'Proses Produk Masuk')
@section('content')
<div class="container-xxl flex-grow-1">
    <h5 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Monitoring Produk /</span> Produk Keluar
    </h5>

    <div class="row">
        <!-- Form Checkout -->
        <div class="col-xxl-8 col-xl-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Produk Keluar</h5>
                </div>
                <div class="card-body">
                    <form id="form-tambah-produk" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="merek_id">Merek Produk</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <select class="form-select" id="merek_id" name="merek_id" required>
                                    <option value="" selected disabled>Pilih Merek</option>
                                    @foreach($listMerek as $merek)
                                    <option value="{{$merek->id}}">{{$merek->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Daftar Produk Keluar</h5>

                        <div id="produk-container">
                            <div class="row produk-item mb-3">
                                <div class="col-5">
                                    <label class="form-label" for="nama_produk">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk[]" placeholder="Masukkan Nama Produk" required />
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="jumlah_0">Jumlah Keluar <span class="text-dark fw-bold">[stok tersedia : 0]</span></label>
                                    <input type="number" class="form-control" id="jumlah_0" name="jumlah[]" min="1" value="1" required />
                                </div>

                                <div class="col-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-danger mb-0 btn-hapus-barang" disabled>
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="button" id="btn-tambah-barang" class="btn btn-outline-primary">
                                    <i class="bx bx-plus me-1"></i> Tambah Produk
                                </button>
                            </div>
                        </div>

                        <div class="row justify-content-end mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Barang Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-xxl-4 col-xl-12 col-lg-12">
            <!-- Recent Entry Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Barang Keluar Terakhir</h5>
                    <a href="" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        @foreach($listProduk as $produk)
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{$produk->nama}}</h6>
                                    <small class="text-muted">{{$produk->merek->nama}}</small>
                                </div>
                                <div class="user-progress">
                                    <div class="badge bg-label-primary">{{$produk->created_at}}</div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#form-tambah-produk').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/api/add-product',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                const message = xhr.responseJSON?.message || 'Terjadi kesalahan tak diketahui';

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan',
                    text: message,
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let itemCounter = 1;

        // Tambah barang baru
        document.getElementById('btn-tambah-barang').addEventListener('click', function() {
            const barangContainer = document.getElementById('produk-container');
            const newItem = document.createElement('div');
            newItem.className = 'row produk-item mb-3';
            newItem.innerHTML = `
      <div class="col-5">
        <label class="form-label" for="nama_produk_${itemCounter}">Nama Produk <span class="text-danger">[stok tersedia : 0]</span></label>
        <input type="text" class="form-control" id="nama_produk_${itemCounter}" name="nama_produk[]" placeholder="Masukkan Nama Produk" required />
      </div>
      <div class="col-3">
        <label class="form-label" for="jumlah_${itemCounter}">Jumlah</label>
        <input type="number" class="form-control" id="jumlah_${itemCounter}" name="jumlah[]" min="1" value="1" required />
      </div>
      <div class="col-1 d-flex align-items-end">
        <button type="button" class="btn btn-outline-danger mb-0 btn-hapus-barang">
          <i class="bx bx-trash"></i>
        </button>
      </div>
    `;
            barangContainer.appendChild(newItem);
            itemCounter++;


            // Enable all delete buttons
            document.querySelectorAll('.btn-hapus-barang').forEach(btn => {
                btn.disabled = document.querySelectorAll('.produk-item').length <= 1;
            });
        });

        // Hapus barang
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-hapus-barang') || e.target.parentElement.classList.contains('btn-hapus-barang')) {
                const button = e.target.classList.contains('btn-hapus-barang') ? e.target : e.target.parentElement;
                const barangItem = button.closest('.produk-item');

                if (document.querySelectorAll('.produk-item').length > 1) {
                    barangItem.remove();


                    // Disable delete button if only one item left
                    if (document.querySelectorAll('.produk-item').length <= 1) {
                        document.querySelector('.btn-hapus-barang').disabled = true;
                    }
                }
            }
        });

        // Update jumlah atau harga
        document.body.addEventListener('input', function(e) {
            if (e.target.classList.contains('harga-input') || e.target.id.startsWith('jumlah_')) {

            }
        });

        // Hitung total
        function updateSummary() {
            const items = document.querySelectorAll('.produk-item');
            let totalItems = items.length;
            let totalQuantity = 0;
            let totalNilai = 0;

            items.forEach(item => {
                const jumlah = parseInt(item.querySelector('input[id^="jumlah_"]').value) || 0;
                const harga = parseInt(item.querySelector('input[id^="harga_"]').value) || 0;

                totalQuantity += jumlah;
                totalNilai += (jumlah * harga);
            });

            document.getElementById('total-items').textContent = totalItems + (totalItems > 1 ? ' items' : ' item');
            document.getElementById('total-quantity').textContent = totalQuantity + ' pcs';
            document.getElementById('total-nilai').textContent = 'Rp ' + totalNilai.toLocaleString('id-ID');
        }

        // Initialize

    });
</script>
@endsection