@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')
@section('title', 'Tambah Stok Produk')
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
        z-index: 1000 !important;
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
                <h5 class="fw-bold mb-0">Tambah Stok Produk</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 small">
                        <li class="breadcrumb-item"><a href="#" class="text-primary">Monitoring Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Stok Produk</li>
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
        <!-- Form Tambah Stok -->
        <div class="col-xxl-8 col-xl-7 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Penambahan Stok</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger font-bold">
                        <i class="bx bx-info-circle me-1"></i>
                        Klik tombol "+ Tambah Produk" dulu, lalu tentukan jumlah produk sebelum memilih merek!
                    </div>
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
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-3">Detail Produk</h5>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <button type="button" id="btn-tambah-barang" class="btn btn-outline-primary">
                                        <i class="bx bx-plus me-1"></i> Tambah Produk
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="produk-container">
                            <div class="row produk-item mb-4 pb-2 border-bottom">
                                <div class="col-xxl-5 mb-2">
                                    <label class="form-label" for="nama_produk">Nama Produk</label>
                                    <select class="form-select nama_produk_select" name="produk_id[]" required>
                                        <option value="" selected disabled>Pilih Produk</option>
                                    </select>
                                </div>
                                <div class="col-xxl-4 mb-2">
                                    <label class="form-label" for="jumlah_0">Jumlah</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"></i></span>
                                        <input type="number" class="form-control" id="jumlah_0" name="jumlah[]" min="1" value="1" required />
                                    </div>
                                </div>
                                <div class="col-xxl-2 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-outline-danger btn-hapus-barang w-100" disabled>
                                        <i class="bx bx-trash me-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end mt-4">
                            <div class="col-xxl-4 col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-save me-1"></i> Simpan Stok
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
                    <h5 class="mb-0">Ringkasan Stok Produk</h5>
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
                    <h5 class="mb-0">Stok Masuk Hari Ini</h5>
                </div>
                <div class="card-body" style="max-height: 310px; overflow-y: auto;">
                    <ul class="p-0 m-0">
                        @forelse($logStokProduk as $logProduk)
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{$logProduk->produk->nama}}</h6>
                                    <small class="text-muted">
                                        {{$logProduk->produk->merek->nama}} •
                                        ditambahkan pukul {{ \Carbon\Carbon::parse($logProduk->created_at)->format('H:i') }}
                                    </small>
                                </div>
                                <div class="user-progress">
                                    <span class="badge bg-label-dark font-bold">{{$logProduk->stok}} pcs</span>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="text-center py-3">
                            <span class="text-muted">Belum ada stok masuk hari ini</span>
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

        // Validasi form
        let isValid = true;
        $(this).find('[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Form Tidak Lengkap',
                text: 'Harap isi semua field yang diperlukan',
            });
            return;
        }

        // Loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="bx bx-loader-alt bx-spin me-1"></i> Menyimpan...');
        submitBtn.attr('disabled', true);

        $.ajax({
            url: '/api/process-stock-product?type_stock=add_stock',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data stok produk berhasil disimpan',
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
                submitBtn.html(originalText);
                submitBtn.attr('disabled', false);
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
            newItem.className = 'row produk-item mb-4 pb-2 border-bottom';
            newItem.innerHTML = `
                <div class="col-xxl-5 mb-2">
                    <label class="form-label" for="nama_produk_${itemCounter}">Nama Produk</label>
                    <div class="input-group input-group-merge">
                        <select class="form-select nama_produk_select" id="nama_produk_${itemCounter}" name="produk_id[]" required>
                            <option value="" selected disabled>Pilih Produk</option>
                        </select>
                    </div>
                </div>
                <div class="col-xxl-4 mb-2">
                    <label class="form-label" for="jumlah_${itemCounter}">Jumlah</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"></span>
                        <input type="number" class="form-control" id="jumlah_${itemCounter}" name="jumlah[]" min="1" value="1" required />
                    </div>
                </div>
                <div class="col-xxl-2 d-flex align-items-end mb-2">
                    <button type="button" class="btn btn-outline-danger btn-hapus-barang w-100">
                        <i class="bx bx-trash me-1"></i> Hapus
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

            items.forEach(item => {
                const jumlah = parseInt(item.querySelector('input[id^="jumlah_"]').value) || 0;
                totalQuantity += jumlah;
            });

            document.getElementById('total-items').textContent = totalItems + (totalItems > 1 ? ' items' : ' item');
            document.getElementById('total-quantity').textContent = totalQuantity + ' pcs';
        }

        // Initialize
        updateSummary();
    });

    document.getElementById('merek_select').addEventListener('change', function() {
        const merekId = this.value;

        fetch(`/api/get-product-by-merek/${merekId}`)
            .then(response => response.json())
            .then(data => {
                const selectElements = document.querySelectorAll('.nama_produk_select');
                selectElements.forEach(select => {
                    select.innerHTML = '<option value="" selected disabled>Pilih Produk</option>';
                    data.data.forEach(produk => {
                        const option = document.createElement('option');
                        option.value = produk.id;
                        option.text = produk.nama;
                        select.appendChild(option);
                    });
                });
            })
            .catch(error => console.error('Error fetching produk:', error));
    });
</script>
@endsection