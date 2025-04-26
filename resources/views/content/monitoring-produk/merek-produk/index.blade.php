@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'Merek')

@section('content')
<style>
    .my-swal-popup {
        z-index: 1060 !important;
    }

    .swal2-backdrop-show {
        z-index: 1059 !important;
        background-color: rgba(0, 0, 0, 0.4) !important;
    }

    .navbar,
    .sidebar {
        z-index: 1000 !important;
    }
</style>
<div class="px-5">
    <div class="d-flex justify-content-between mb-5">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <span class="badge bg-primary p-2 rounded-circle">
                    <i class="bx bx-package fs-4"></i>
                </span>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Merek</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 small">
                        <li class="breadcrumb-item"><a href="#" class="text-primary">Monitoring Produk</a></li>
                        <li class="breadcrumb-item active">Merek</li>
                    </ol>
                </nav>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInputMerek">
            <i class="bx bx-plus me-1"></i> Tambah Merek
        </button>
    </div>
    <div class="card">
        <div class="card p-7">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive text-nowrap p-0">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Merek Produk</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-warning me-2" onclick="editMerek({{ $item->id }}, '{{ $item->nama }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                            </svg>
                                        </button>
                                        <form id="delete-form-{{ $item->id }}" method="POST" data-id="{{ $item->id }}" class="form-delete-merek">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                    <script>
                        let table = new DataTable('#myTable');
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input Merek -->
    <div class="modal fade" id="modalInputMerek" tabindex="-1" aria-labelledby="modalInputMerekLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-tambah-merek" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputMerekLabel">Tambah Merek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="bx bx-info-circle me-1"></i>
                                    Gunakan form ini untuk menambahkan banyak merek sekaligus.
                                </div>
                            </div>
                        </div>

                        <div id="merek-container">
                            <div class="row mb-3 merek-item">
                                <div class="col-md-10">
                                    <label class="form-label" for="merek_0">Nama Merek</label>
                                    <input type="text" class="form-control" name="merek[]" placeholder="Masukkan nama merek" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-danger btn-hapus-merek mb-0" disabled>
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <button type="button" id="btn-tambah-merek" class="btn btn-outline-primary">
                                    <i class="bx bx-plus me-1"></i> Tambah Merek Lain
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Merek -->
    <div class="modal fade" id="modalEditMerek" tabindex="-1" aria-labelledby="modalEditMerekLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-edit-merek" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_merek_id" name="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditMerekLabel">Edit Merek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label" for="edit_merek_nama">Nama Merek</label>
                                <input type="text" class="form-control" id="edit_merek_nama" name="merek" placeholder="Masukkan nama merek" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#form-tambah-merek').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/api/add-merek',
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

        $('#form-edit-merek').on('submit', function(e) {
            e.preventDefault();
            const id = $('#edit_merek_id').val();

            $.ajax({
                url: '/api/update-merek/' + id,
                method: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    $('#modalEditMerek').modal('hide');
                    const message = xhr.responseJSON?.message || 'Terjadi kesalahan tak diketahui';

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memperbarui',
                        text: message,
                    });
                }
            });
        });

        $('.form-delete-merek').on('submit', function(e) {
            e.preventDefault();

            const id = $(this).data('id');

            Swal.fire({
                title: "Hapus Merek ?",
                text: "Merek akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/api/delete-merek/' + id,
                        method: 'DELETE',
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
                                title: 'Aksi Dihentikan',
                                text: message,
                            });
                        }
                    });
                }
            });
        });
    });

    function editMerek(id, nama) {
        $('#edit_merek_id').val(id);
        $('#edit_merek_nama').val(nama);

        const editModal = new bootstrap.Modal(document.getElementById('modalEditMerek'));
        editModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        let merekCounter = 1;

        // Tambah merek baru
        document.getElementById('btn-tambah-merek').addEventListener('click', function() {
            const merekContainer = document.getElementById('merek-container');
            const newItem = document.createElement('div');
            newItem.className = 'row mb-3 merek-item';
            newItem.innerHTML = `
                <div class="col-md-10">
                    <label class="form-label" for="merek_${merekCounter}">Nama Merek</label>
                    <input type="text" class="form-control" name="merek[]" placeholder="Masukkan nama merek" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger btn-hapus-merek mb-0">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            `;
            merekContainer.appendChild(newItem);
            merekCounter++;

            // Enable all delete buttons
            document.querySelectorAll('.btn-hapus-merek').forEach(btn => {
                btn.disabled = document.querySelectorAll('.merek-item').length <= 1;
            });
        });

        // Hapus merek
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-hapus-merek') || e.target.parentElement.classList.contains('btn-hapus-merek')) {
                const button = e.target.classList.contains('btn-hapus-merek') ? e.target : e.target.parentElement;
                const merekItem = button.closest('.merek-item');

                if (document.querySelectorAll('.merek-item').length > 1) {
                    merekItem.remove();

                    // Disable delete button if only one item left
                    if (document.querySelectorAll('.merek-item').length <= 1) {
                        document.querySelector('.btn-hapus-merek').disabled = true;
                    }
                }
            }
        });
    });
</script>
@endsection