<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\LogStokProdukRepo;
use App\Repositories\ProdukRepo;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $product = new ProdukRepo();
    $totalProduct = $product->fetchTotalProduct();
    $fetchLowStockProducts = $product->fetchLowStockProducts();

    $logProduct = new LogStokProdukRepo();
    $getTotalProductStockOut = $logProduct->getTotalProductStockOut();

    $revenueData = $logProduct->getMonthlyIncomeProductOut();

    return view('content.dashboard.dashboards-analytics', compact('totalProduct', 'fetchLowStockProducts', 'getTotalProductStockOut', 'revenueData'));
  }
}
