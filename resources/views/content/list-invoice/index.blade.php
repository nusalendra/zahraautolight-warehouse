@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'List Invoice')

@section('content')
<div class="px-5">
    <div class="d-flex justify-content-between mb-5">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <span class="badge bg-primary p-2 rounded-circle">
                    <i class="bx bx-list-plus fs-4"></i>
                </span>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Invoice</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0 small">
                        <li class="breadcrumb-item"><a href="#" class="text-primary">List</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Invoice</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Mitra</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Tanggal Invoice</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Total Bayar</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Sisa Tagihan</th>
                                <th class="text-uppercase text-xs font-weight-bolder text-start">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->nomor_invoice }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->mitra->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ \Carbon\Carbon::parse($item->tanggal_invoice)->translatedFormat('d F Y') }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Rp. {{ number_format($item->total) }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Rp. {{ number_format($item->sisa_tagihan) }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            @if($item->status == 'unpaid')
                                            <h6 class="mb-0 text-sm text-danger">UNPAID</h6>
                                            @elseif($item->status == 'partially_paid')
                                            <h6 class="mb-0 text-sm text-warning">PARTIALLY PAID</h6>
                                            @elseif($item->status == 'paid')
                                            <h6 class="mb-0 text-sm text-success">UNPAID</h6>
                                            @endif
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