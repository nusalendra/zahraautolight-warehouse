<?php

namespace App\Http\Controllers\API\invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayValidationRequest;
use App\Http\Services\InvoiceService;

class InvoicePay extends Controller
{
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function pay(PayValidationRequest $request)
    {
        try {
            $result = $this->invoiceService->handlePayment($request->validated());

            return response()->json([
                'status' => $result['status'] == 1 ? true : false,
                'message' => $result['message'],
                'transaction' => $result['transaction'],
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
