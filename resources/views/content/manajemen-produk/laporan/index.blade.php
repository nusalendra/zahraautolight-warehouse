@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'List Produk')

@section('content')
<div class="px-5">
    <div class="d-flex justify-content-between mb-5">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <span class="badge bg-primary p-2 rounded-circle">
                    <i class="bx bxs-report fs-4"></i>
                </span>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Laporan</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 small">
                        <li class="breadcrumb-item"><a href="#" class="text-primary">Manajemen Produk</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card p-7">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive text-nowrap p-0">
                    <table id="myTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">No</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Merek</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Produk</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Harga</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Stok Keluar</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Total Harga</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Tanggal Keluar</th>
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
                                            <h6 class="mb-0 text-sm">{{ $item->produk->merek->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->produk->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->stok }} pcs</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                Rp. {{ number_format($item->produk->harga * $item->stok, 0, ',', '.') }}
                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">
                                                {{ $item->created_at->format('d F Y / H:i:s') }}
                                            </h6>
                                        </div>
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
</div>
@endsection