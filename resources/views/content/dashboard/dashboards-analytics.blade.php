@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp
@extends('layouts/contentNavbarLayout')
@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
@endsection

@section('content')
<div class="row">
  <!-- Kartu Selamat Datang dengan Gradient -->
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->username }}!</h5>
            <p class="mb-4">Dashboard menyajikan berbagai informasi terkait produk, seperti total produk yang ditambahkan, total stok produk yang keluar, notifikasi stok hampir habis, serta pendapatan bulanan dari produk yang terjual.</p>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop.png')}}" height="140"
              alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik Utama dengan Ikon -->
  <div class="col-12 mb-4">
    <div class="row">
      <!-- Total Stok Produk Keluar -->
      <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="bx bx-cart"></i>
                </span>
              </div>
              <span class="fw-semibold d-block">Total Stok Produk Keluar</span>
            </div>
            <h3 class="card-title mb-2">{{ number_format($getTotalProductStockOut, 0, ',', '.') }}</h3>
          </div>
        </div>
      </div>

      <!-- Total Produk -->
      <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-info">
                  <i class="bx bx-cube"></i>
                </span>
              </div>
              <span class="fw-semibold d-block">Total Produk</span>
            </div>
            <h3 class="card-title mb-2">{{ number_format($totalProduct, 0, ',', '.') }}</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik & Statistik Tambahan -->
    <div class="col-12">
      <div class="row">
        <!-- Grafik Aktivitas -->
        <div class="col-md-8 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0">Pendapatan Perbulan</h5>
            </div>
            <div class="card-body pb-0">
              <div id="activityChart" style="height: 300px;" class="mb-3"></div>
            </div>
          </div>
        </div>

        <!-- Barang dengan Stok Menipis -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0">Stok Hampir Habis</h5>
            </div>
            <div class="card-body">
              <div style="max-height: 300px; overflow-y: auto;">
                <ul class="p-0 m-0">
                  @foreach($fetchLowStockProducts as $product)
                  <li class="d-flex mb-3 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2 me-3">
                      <div class="me-2">
                        <h6 class="mb-0">{{ $product->nama }}</h6>
                        <small class="text-muted">{{ $product->merek->nama }}</small>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">{{ $product->stok }} tersisa</small>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex mb-3 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2 me-3">
                      <div class="me-2">
                        <h6 class="mb-0">{{ $product->nama }}</h6>
                        <small class="text-muted">{{ $product->merek->nama }}</small>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">{{ $product->stok }} tersisa</small>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  @endsection

  @section('page-script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var options = {
        series: [{
          name: 'Pendapatan',
          data: @json($revenueData)
        }],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false
          }
        },
        colors: ['#28C76F'], // Hijau untuk pendapatan
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        },
        tooltip: {
          shared: true,
          y: {
            formatter: function(val) {
              return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
              }).format(val);
            }
          }
        },
        legend: {
          position: 'top'
        },
        grid: {
          borderColor: '#f1f1f1',
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "vertical",
            shadeIntensity: 0.3,
            opacityFrom: 0.4,
            opacityTo: 0.1,
            stops: [0, 100]
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#activityChart"), options);
      chart.render();
    });
  </script>
  @endsection