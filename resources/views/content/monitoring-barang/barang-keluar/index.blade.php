@extends('layouts/contentNavbarLayout')
@section('title', 'Proses Barang Keluar')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Inventaris /</span> Proses Barang Keluar
    </h4>

    <div class="row">
        <!-- Form Barang Keluar -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Barang Keluar</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('barang-keluar.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nomor_referensi">Nomor Referensi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-hash"></i></span>
                                    <input type="text" class="form-control" id="nomor_referensi" name="nomor_referensi" placeholder="OUT-001" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="tanggal">Tanggal Keluar</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="tujuan">Tujuan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-building"></i></span>
                                    <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Departemen/Customer" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="jenis_keluar">Jenis Pengeluaran</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-purchase-tag"></i></span>
                                    <select class="form-select" id="jenis_keluar" name="jenis_keluar" required>
                                        <option value="">Pilih Jenis</option>
                                        <option value="penjualan">Penjualan</option>
                                        <option value="penggunaan_internal">Penggunaan Internal</option>
                                        <option value="retur">Retur ke Supplier</option>
                                        <option value="rusak">Barang Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="penanggung_jawab">Penanggung Jawab</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" placeholder="Nama penanggung jawab" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="catatan">Catatan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-notepad"></i></span>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Catatan tambahan tentang barang keluar ini"></textarea>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Daftar Barang</h5>

                        <div id="barang-container">
                            <div class="row barang-item mb-3">
                                <div class="col-md-5">
                                    <label class="form-label" for="barang_id_0">Nama Barang</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-package"></i></span>
                                        <select class="form-select barang-select" id="barang_id_0" name="barang_id[]" required>
                                            <option value="">Pilih Barang</option>
                                            <!-- Loop through products here -->
                                            <option value="1" data-stok="15">Laptop Asus A456UR (Stok: 15)</option>
                                            <option value="2" data-stok="24">Monitor Dell 24" (Stok: 24)</option>
                                            <option value="3" data-stok="50">Keyboard Mechanical RGB (Stok: 50)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="jumlah_0">Jumlah</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-duplicate"></i></span>
                                        <input type="number" class="form-control" id="jumlah_0" name="jumlah[]" min="1" value="1" required />
                                    </div>
                                    <div class="form-text stok-info" id="stok-info-0">Stok tersedia: 0</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="keterangan_0">Keterangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                                        <input type="text" class="form-control" id="keterangan_0" name="keterangan[]" placeholder="Keterangan" />
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
                                <button type="submit" id="btn-submit" class="btn btn-primary">Proses Barang Keluar</button>
                                <a href="{{ route('barang-keluar.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-1 border-bottom">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Jenis Barang</span>
                            <span id="total-jenis">1 jenis</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Total Jumlah</span>
                            <span id="total-quantity">1 pcs</span>
                        </div>
                    </div>

                    <div class="alert alert-warning mb-3" id="stok-warning" style="display: none;">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error-circle me-2 fs-4"></i>
                            <div>
                                Jumlah barang melebihi stok tersedia!
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-info-circle me-2 fs-4"></i>
                            <div>
                                Pastikan semua data barang keluar sudah sesuai sebelum memproses.
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label" for="dokumen">Upload Dokumen (Opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-file"></i></span>
                            <input type="file" class="form-control" id="dokumen" name="dokumen" />
                        </div>
                        <div class="form-text">Format: PDF, JPG, PNG (Maks. 2MB)</div>
                    </div>
                </div>
            </div>

            <!-- Recent Entry Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Barang Keluar Terakhir</h5>
                    <a href="{{ route('barang-keluar.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">OUT-0045</h6>
                                    <small class="text-muted">Departemen IT</small>
                                </div>
                                <div class="user-progress">
                                    <div class="badge bg-label-primary">12 Apr 2025</div>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-2 border-bottom">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">OUT-0044</h6>
                                    <small class="text-muted">PT Customer Setia</small>
                                </div>
                                <div class="user-progress">
                                    <div class="badge bg-label-primary">11 Apr 2025</div>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-package"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">OUT-0043</h6>
                                    <small class="text-muted">Departemen Marketing</small>
                                </div>
                                <div class="user-progress">
                                    <div class="badge bg-label-primary">10 Apr 2025</div>
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

        // Update stok info saat pilihan barang berubah
        document.body.addEventListener('change', function(e) {
            if (e.target.classList.contains('barang-select')) {
                const select = e.target;
                const itemId = select.id.split('_').pop();
                const stokInfoEl = document.getElementById('stok-info-' + itemId);

                if (select.selectedIndex > 0) {
                    const option = select.options[select.selectedIndex];
                    const stok = option.getAttribute('data-stok');
                    stokInfoEl.textContent = 'Stok tersedia: ' + stok;
                } else {
                    stokInfoEl.textContent = 'Stok tersedia: 0';
                }

                validateStok();
            }
        });

        // Tambah barang baru
        document.getElementById('btn-tambah-barang').addEventListener('click', function() {
            const barangContainer = document.getElementById('barang-container');
            const newItem = document.createElement('div');
            newItem.className = 'row barang-item mb-3';
            newItem.innerHTML = `
      <div class="col-md-5">
        <label class="form-label" for="barang_id_${itemCounter}">Nama Barang</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-package"></i></span>
          <select class="form-select barang-select" id="barang_id_${itemCounter}" name="barang_id[]" required>
            <option value="">Pilih Barang</option>
            <option value="1" data-stok="15">Laptop Asus A456UR (Stok: 15)</option>
            <option value="2" data-stok="24">Monitor Dell 24" (Stok: 24)</option>
            <option value="3" data-stok="50">Keyboard Mechanical RGB (Stok: 50)</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="jumlah_${itemCounter}">Jumlah</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-duplicate"></i></span>
          <input type="number" class="form-control" id="jumlah_${itemCounter}" name="jumlah[]" min="1" value="1" required />
        </div>
        <div class="form-text stok-info" id="stok-info-${itemCounter}">Stok tersedia: 0</div>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="keterangan_${itemCounter}">Keterangan</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
          <input type="text" class="form-control" id="keterangan_${itemCounter}" name="keterangan[]" placeholder="Keterangan" />
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
                    validateStok();

                    // Disable delete button if only one item left
                    if (document.querySelectorAll('.barang-item').length <= 1) {
                        document.querySelector('.btn-hapus-barang').disabled = true;
                    }
                }
            }
        });

        // Update jumlah
        document.body.addEventListener('input', function(e) {
            if (e.target.id.startsWith('jumlah_')) {
                updateSummary();
                validateStok();
            }
        });

        // Validasi stok
        function validateStok() {
            let isValid = true;
            const submitBtn = document.getElementById('btn-submit');
            const stokWarning = document.getElementById('stok-warning');
            const items = document.querySelectorAll('.barang-item');

            items.forEach(item => {
                const select = item.querySelector('select[id^="barang_id_"]');

                if (select.selectedIndex > 0) {
                    const option = select.options[select.selectedIndex];
                    const stok = parseInt(option.getAttribute('data-stok'));
                    const jumlah = parseInt(item.querySelector('input[id^="jumlah_"]').value) || 0;

                    if (jumlah > stok) {
                        isValid = false;
                    }
                }
            });

            submitBtn.disabled = !isValid;
            stokWarning.style.display = isValid ? 'none' : 'block';
            return isValid;
        }

        // Hitung total
        function updateSummary() {
            const items = document.querySelectorAll('.barang-item');
            let totalJenis = items.length;
            let totalQuantity = 0;

            items.forEach(item => {
                const jumlah = parseInt(item.querySelector('input[id^="jumlah_"]').value) || 0;
                totalQuantity += jumlah;
            });

            document.getElementById('total-jenis').textContent = totalJenis + (totalJenis > 1 ? ' jenis' : ' jenis');
            document.getElementById('total-quantity').textContent = totalQuantity + ' pcs';
        }

        // Initialize
        updateSummary();
        validateStok();

        // Inisialisasi stok info untuk item pertama
        const firstSelect = document.querySelector('.barang-select');
        if (firstSelect) {
            firstSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection