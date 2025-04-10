@extends('layouts/contentNavbarLayout')
@section('title', 'Proses Barang Masuk')
@section('content')
<div class="container-xxl flex-grow-1">
    <h5 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Monitoring Barang /</span> Proses Barang Masuk
    </h5>

    <div class="row">
        <!-- Form Checkout -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Barang Masuk</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="supplier_id">Merek Barang</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <select class="form-select" id="supplier_id" name="supplier_id" required>
                                    <option value="">Pilih Merek</option>
                                    <!-- Loop through suppliers here -->
                                    <option value="1">PT Supplier Utama</option>
                                    <option value="2">CV Mitra Sejati</option>
                                    <option value="3">PT Distributor Terpercaya</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Daftar Barang</h5>

                        <div id="barang-container">
                            <div class="row barang-item mb-3">
                                <div class="col-md-5">
                                    <label class="form-label" for="barang_id_0">Nama Barang</label>
                                    <select class="form-select barang-select" id="barang_id_0" name="barang_id[]" required>
                                        <option value="">Pilih Barang</option>
                                        <!-- Loop through products here -->
                                        <option value="1">Laptop Asus A456UR</option>
                                        <option value="2">Monitor Dell 24"</option>
                                        <option value="3">Keyboard Mechanical RGB</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="jumlah_0">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah_0" name="jumlah[]" min="1" value="1" required />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="harga_0">Harga Satuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control harga-input" id="harga_0" name="harga[]" min="0" required />
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-danger mb-0 btn-hapus-barang" disabled>
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="button" id="btn-tambah-barang" class="btn btn-outline-primary">
                                    <i class="bx bx-plus me-1"></i> Tambah Barang
                                </button>
                            </div>
                        </div>

                        <div class="row justify-content-end mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Barang Masuk</button>
                                <a href="/" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-xl-4 col-lg-5">
            <!-- Recent Entry Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Barang Masuk Hari Ini</h5>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">REF-0023</h6>
                                    <small class="text-muted">PT Supplier Utama</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">12 Apr 2025</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">REF-0022</h6>
                                    <small class="text-muted">CV Mitra Sejati</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">10 Apr 2025</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">REF-0021</h6>
                                    <small class="text-muted">PT Distributor Terpercaya</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">8 Apr 2025</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let itemCounter = 1;

        // Tambah barang baru
        document.getElementById('btn-tambah-barang').addEventListener('click', function() {
            const barangContainer = document.getElementById('barang-container');
            const newItem = document.createElement('div');
            newItem.className = 'row barang-item mb-3';
            newItem.innerHTML = `
      <div class="col-md-5">
        <label class="form-label" for="barang_id_${itemCounter}">Nama Barang</label>
        <select class="form-select barang-select" id="barang_id_${itemCounter}" name="barang_id[]" required>
          <option value="">Pilih Barang</option>
          <option value="1">Laptop Asus A456UR</option>
          <option value="2">Monitor Dell 24"</option>
          <option value="3">Keyboard Mechanical RGB</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="jumlah_${itemCounter}">Jumlah</label>
        <input type="number" class="form-control" id="jumlah_${itemCounter}" name="jumlah[]" min="1" value="1" required />
      </div>
      <div class="col-md-3">
        <label class="form-label" for="harga_${itemCounter}">Harga Satuan</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="number" class="form-control harga-input" id="harga_${itemCounter}" name="harga[]" min="0" required />
        </div>
      </div>
      <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-outline-danger mb-0 btn-hapus-barang">
          <i class="bx bx-trash"></i>
        </button>
      </div>
    `;
            barangContainer.appendChild(newItem);
            itemCounter++;
            updateSummary();

            // Enable all delete buttons
            document.querySelectorAll('.btn-hapus-barang').forEach(btn => {
                btn.disabled = document.querySelectorAll('.barang-item').length <= 1;
            });
        });

        // Hapus barang
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-hapus-barang') || e.target.parentElement.classList.contains('btn-hapus-barang')) {
                const button = e.target.classList.contains('btn-hapus-barang') ? e.target : e.target.parentElement;
                const barangItem = button.closest('.barang-item');

                if (document.querySelectorAll('.barang-item').length > 1) {
                    barangItem.remove();
                    updateSummary();

                    // Disable delete button if only one item left
                    if (document.querySelectorAll('.barang-item').length <= 1) {
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
            const items = document.querySelectorAll('.barang-item');
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