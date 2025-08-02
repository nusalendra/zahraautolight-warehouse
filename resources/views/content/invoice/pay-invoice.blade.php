@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'Detail Invoice')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-3" style="background-color: #696cff; border-radius: .75rem .75rem 0 0; border-bottom: none;">
                <h5 class="mb-0 text-white fw-bold fs-5"><i class="bx bx-receipt me-2"></i> Detail Invoice</h5>
            </div>

            <div class="card-body p-5 bg-white">
                <div class="row mb-5 pb-4 border-bottom">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <p class="mb-1 text-dark fw-bold fs-5">CV. Zahra Automotive Lighting</p>
                        <p class="mb-1 text-muted small">Jl. Raya Petiken Ruko No.3, Mulung, GWK, <br>Kec. Driyorejo, Kabupaten Gresik, Jawa Timur 6177</p>
                        <p class="mb-0 text-muted small">Email: <a href="mailto:zahraautolight@gmail.com" class="text-decoration-none text-muted">zahraautolight@gmail.com</a> | Telp: +62 812 3456 7890</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6 class="text-dark fw-bold fs-3 mb-2">#{{$invoice->nomor_invoice}}</h6>
                        <p class="mb-2">
                            @php
                            $statusBadgeClass = '';
                            $statusText = '';

                            if ($invoice->status == 'unpaid'){
                            $statusBadgeClass='bg-danger text-dark' ;
                            $statusText='UNPAID' ;
                            } elseif ($invoice->status == 'partially_paid') {
                            $statusBadgeClass='bg-warning text-dark' ;
                            $statusText='PARTIALLY PAID' ;
                            } elseif ($invoice->status == 'paid') {
                            $statusBadgeClass='bg-success text-dark' ;
                            $statusText='PAID' ;
                            }
                            @endphp
                            <span class="badge {{ $statusBadgeClass }} text-white rounded-pill px-3 py-2 fw-bold" style="font-size: .9em; letter-spacing: 0.5px;">{{ $statusText }}</span>
                        </p>
                        <p class="mb-1 text-dark fw-bold fs-5">{{ $invoice->mitra->nama }}</p>
                        <p class="mb-0 text-muted small">Email: budi.santoso@email.com</a></p>
                        <p class="mb-0 text-muted small">Telp: +62 878 1234 5678</p>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <p class="mb-1 text-dark"><strong class="text-secondary small me-2 text-uppercase">Tanggal Invoice:</strong> <span class="small">{{ \Carbon\Carbon::parse($invoice->tanggal_invoice)->translatedFormat('d F Y') }}</span></p>
                    </div>
                </div>

                <div class="table-responsive mb-5">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 text-secondary small text-uppercase fw-bold" style="border-bottom: 2px solid #eee;">#</th>
                                <th class="py-3 text-secondary small text-uppercase fw-bold" style="border-bottom: 2px solid #eee;">Deskripsi Item</th>
                                <th class="py-3 text-end text-secondary small text-uppercase fw-bold" style="border-bottom: 2px solid #eee;">Kuantitas</th>
                                <th class="py-3 text-end text-secondary small text-uppercase fw-bold" style="border-bottom: 2px solid #eee;">Harga Satuan</th>
                                <th class="py-3 text-end text-secondary small text-uppercase fw-bold" style="border-bottom: 2px solid #eee;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->invoiceItem as $index => $item)
                            <tr>
                                <td class="py-2 medium text-dark">{{ $index + 1 }}</td>
                                <td class="py-2 medium text-dark">{{ $item->description }}</td>
                                <td class="py-2 text-end medium text-dark">{{ $item->qty }} pcs </td>
                                <td class="py-2 text-end medium text-dark">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                                <td class="py-2 text-end fw-bold text-dark">Rp {{ number_format($item->amount * $item->qty, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="height: 20px;"></tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2" class="p-4" style="background-color: #f7f9fc; border: 1px solid #e0e6ed; border-radius: .5rem; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-secondary fw-bold text-uppercase fs-6">TOTAL TAGIHAN:</span>
                                        <span class="text-primary fw-bold fs-4">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top" style="border-color: #e0e6ed !important;">
                                        <span class="{{ $invoice->sisa_tagihan == 0 ? 'text-dark' : 'text-danger' }} fw-bold text-uppercase fs-6">SISA TAGIHAN:</span>
                                        <span class="{{ $invoice->sisa_tagihan == 0 ? 'text-dark' : 'text-danger' }} fw-bold fs-4">
                                            Rp {{ number_format($invoice->sisa_tagihan, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if($invoice->transaksi->isNotEmpty())
                <div class="mt-5 pt-3 border-top" style="border-color: #eee !important;">
                    <h6 class="mb-3 text-secondary fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Riwayat Pembayaran:</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-2 small text-center text-uppercase">Tanggal</th>
                                    <th class="py-2 small text-center text-uppercase">Id Transaksi</th>
                                    <th class="py-2 text-center small text-uppercase">Jumlah Dibayar</th>
                                    <th class="py-2 small text-center text-uppercase">Metode Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->transaksi as $transaksi)
                                <tr>
                                    <td class="py-2 small text-center text-dark">{{ \Carbon\Carbon::parse($transaksi->transaction_date)->translatedFormat('d F Y') }}</td>
                                    <td class="py-2 small text-center text-dark">{{ $transaksi->trx_id }}</td>
                                    <td class="py-2 small text-center text-dark fw-bold">Rp {{ number_format($transaksi->amount_transaction, 0, ',', '.') }}</td>
                                    <td class="py-2 small text-center text-dark">{{ $transaksi->payment_method }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between py-3 bg-light" style="border-radius: 0 0 .75rem .75rem; border-top: none;">
                <a href="/invoice" class="btn btn-secondary d-flex align-items-center">
                    <i class="bx bx-arrow-back me-1"></i> Kembali
                </a>
                @if(!$invoice->sisa_tagihan == 0)
                <button type="button" class="btn btn-dark d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#paymentModal">
                    <i class="bx bx-dollar me-1"></i> Bayar
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Input Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                    <div class="mb-3">
                        <label for="amount_transaction" class="form-label">Nominal Pembayaran (Rp)</label>
                        <input type="number" class="form-control" id="amount_transaction" name="amount_transaction" placeholder="Contoh: 100000" min="1" step="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="" selected disabled>Pilih Metode</option>
                            <option value="Cash">Cash</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                        </select>
                    </div>
                    <div id="paymentMessage" class="mt-3"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="submitPaymentBtn">Bayar Sekarang</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitPaymentBtn').on('click', function(e) {
            e.preventDefault();

            let form = $('#paymentForm');
            let formData = form.serialize();
            let paymentMessage = $('#paymentMessage');

            // Simple client-side validation
            let amount = $('#amount_transaction').val();
            let method = $('#payment_method').val();

            if (!amount || amount <= 0 || !method) {
                paymentMessage.html('<div class="alert alert-danger">Harap lengkapi semua bidang dengan benar.</div>');
                return;
            }

            $.ajax({
                url: '/api/pay-transaction',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#submitPaymentBtn').prop('disabled', true).text('Memproses...');
                    paymentMessage.html('');
                },
                success: function(response) {
                    if (response.status) {
                        paymentMessage.html('<div class="alert alert-success">' + response.message + '</div>');
                        setTimeout(function() {
                            $('#paymentModal').modal('hide');
                            window.open('/transaction/' + response.transaction.id + '/kwitansi', '_blank');
                            location.reload();
                        }, 1500);
                    } else {
                        paymentMessage.html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    paymentMessage.html('<div class="alert alert-danger">' + xhr.responseJSON.error + '</div>');
                    console.error("AJAX Error: ", status, error, xhr.responseText);
                },
                complete: function() {
                    $('#submitPaymentBtn').prop('disabled', false).text('Bayar Sekarang');
                }
            });
        });
    });
</script>
@endsection