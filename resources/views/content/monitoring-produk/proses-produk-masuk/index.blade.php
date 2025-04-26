@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')
@section('title', 'Proses Produk Masuk')
@section('content')
<style>
    .my-swal-popup {
        z-index: 1200 !important;
    }

    .swal2-backdrop-show {
        z-index: 1200 !important;
        background-color: rgba(0, 0, 0, 0.4) !important;
    }

    .navbar,
    .sidebar {
        z-index: 1200 !important;
    }
</style>
<div class="px-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <span class="badge bg-primary p-2 rounded-circle">
                    <i class="bx bx-package fs-4"></i>
                </span>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Proses Produk Masuk</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 small">
                        <li class="breadcrumb-item"><a href="#" class="text-primary">Monitoring Produk</a></li>
                        <li class="breadcrumb-item active">Proses Produk Masuk</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div>
            <span class="badge bg-label-primary p-2">
                <i class="bx bx-calendar me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>
    <div class="row">
        <!-- Form Checkout -->
        <div class="col-xxl-8 col-xl-7 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Penambahan Produk</h5>
                </div>
                <div class="card-body">
                    <form id="form-tambah-produk" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="merek_id">Merek Produk</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <select class="form-select" id="merek_select" name="merek_id" required>
                                    <option value="" selected disabled>Pilih Merek</option>
                                    @foreach($listMerek as $merek)
                                    <option value="{{$merek->id}}">{{$merek->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Detail Produk</h5>

                        <div id="produk-container">
                            <div class="row produk-item mb-4 pb-2 border-bottom">
                                <div class="col-xxl-4 mb-2">
                                    <label class="form-label" for="nama_produk">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk[]" placeholder="Masukkan Nama Produk" required />
                                </div>
                                <div class="col-xxl-2 mb-2">
                                    <label class="form-label" for="jumlah_0">Jumlah</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></i></span>
                                        <input type="number" class="form-control" id="jumlah_0" name="jumlah[]" min="1" value="1" required />
                                    </div>
                                </div>
                                <div class="col-xxl-3 mb-2">
                                    <label class="form-label" for="jumlah_0">Harga Satuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control harga-input" id="harga_0" name="harga[]" min="0" required />
                                    </div>
                                </div>
                                <div class="col-xxl-2 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-outline-danger btn-hapus-barang w-100" disabled>
                                        <i class="bx bx-trash me-1"></i> Hapus
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
                            <div class="col-xxl-4 col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-log-in me-1"></i> Simpan Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-xxl-4 col-xl-5 col-lg-5">
            <!-- Ringkasan Pengisian -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Ringkasan Produk Masuk</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="bx bx-package fs-5"></i>
                            </span>
                            <div>
                                <h6 class="mb-0">Total Produk</h6>
                                <small class="text-muted">Jumlah jenis produk</small>
                            </div>
                        </div>
                        <h5 id="total-items" class="mb-0 fs-6">1 item</h5>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-label-success rounded p-2">
                                <i class="bx bx-list-check fs-5"></i>
                            </span>
                            <div>
                                <h6 class="mb-0">Total Kuantitas</h6>
                                <small class="text-muted">Jumlah unit masuk</small>
                            </div>
                        </div>
                        <h5 id="total-quantity" class="mb-0 fs-6">0 pcs</h5>
                    </div>
                </div>
            </div>

            <!-- Recent Entry Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Barang Masuk Hari Ini</h5>
                </div>
                <div class="card-body" style="max-height: 310px; overflow-y: auto;">
                    <ul class="p-0 m-0">
                        @forelse($listProduk as $produk)
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{$produk->nama}}</h6>
                                    <small class="text-muted">
                                        {{$produk->merek->nama}} •
                                        produk masuk pukul {{ \Carbon\Carbon::parse($produk->created_at)->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="text-center py-3">
                            <span class="text-muted">Belum ada barang masuk hari ini</span>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1700
                }).then(() => {
                    location.reload();
                });
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
      <div class="col-xxl-4 mb-2">
        <label class="form-label" for="nama_produk_${itemCounter}">Nama Produk</label>
        <input type="text" class="form-control" id="nama_produk_${itemCounter}" name="nama_produk[]" placeholder="Masukkan Nama Produk" required />
      </div>
      <div class="col-xxl-2 mb-2">
        <label class="form-label" for="jumlah_${itemCounter}">Jumlah</label>
        <input type="number" class="form-control" id="jumlah_${itemCounter}" name="jumlah[]" min="1" value="1" required />
      </div>
      <div class="col-xxl-3 mb-2">
        <label class="form-label" for="harga_${itemCounter}">Harga Satuan</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="number" class="form-control harga-input" id="harga_${itemCounter}" name="harga[]" min="0" required />
        </div>
      </div>
      <div class="col-xxl-2 d-flex align-items-end mb-2">
        <button type="button" class="btn btn-outline-danger mb-0 btn-hapus-barang w-100">
          <i class="bx bx-trash"></i> Hapus
        </button>
      </div>
    `;
            barangContainer.appendChild(newItem);
            itemCounter++;
            updateSummary();

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
                    updateSummary();

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
                updateSummary();
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
        updateSummary();
    });
</script>
@endsection