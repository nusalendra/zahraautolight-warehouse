<aside id="layout-menu" class="layout-menu menu-vertical menu bg-dark">
  <!-- Commented style section -->
  <!-- <style>
    .layout-wrapper .layout-container .menu,
    .layout-wrapper .layout-container .sidebar,
    .layout-wrapper .layout-container .verticalMenu,
    .layout-wrapper .layout-container .layout-menu {
      z-index: 1050 !important;
    }
  </style> -->

  <!-- App brand section with custom styles for dark theme -->
  <div class="app-brand demo bg-dark-subtle py-3 px-2 mb-2">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="/assets/img/icons/brands/logo-product.jpeg" alt="Logo" class="img-fluid"
          style="max-height: 42px; border-radius: 6px; box-shadow: 0 3px 8px rgba(0,0,0,0.3);">
      </span>
      <div class="ms-2 d-flex flex-column justify-content-center">
        <span class="app-brand-text demo menu-text fw-bolder text-light"
          style="font-size: 1rem; letter-spacing: 0.5px;">ZAHRA</span>
        <span class="text-light-emphasis"
          style="font-size: 0.65rem; margin-top: -5px; letter-spacing: 0.5px; opacity: 0.7;">AUTO LIGHT</span>
      </div>
    </a>
  </div>

  <div class="menu-inner-shadow bg-dark-subtle"></div>

  <ul class="menu-inner py-1">
    @php
    $role = auth()->user()?->role->name ?? 'Guest'; // asumsi user memiliki kolom 'role'
    $menuData = [];

    if ($role === 'Admin') {
    $menuData = $menuAdminData[0]->menu ?? [];
    } elseif ($role === 'Karyawan') {
    $menuData = $menuKaryawanData[0]->menu ?? [];
    }
    @endphp

    @foreach ($menuData as $menu)

    {{-- menu headers --}}
    @if (isset($menu->menuHeader))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text text-light-emphasis">{{ __($menu->menuHeader) }}</span>
    </li>
    @else
    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();

    if ($currentRouteName === $menu->slug) {
    $activeClass = 'active';
    } elseif (isset($menu->submenu)) {
    if (is_array($menu->slug)) {
    foreach ($menu->slug as $slug) {
    if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
    $activeClass = 'active open';
    }
    }
    } else {
    if (str_contains($currentRouteName, $menu->slug) && strpos($currentRouteName, $menu->slug) === 0) {
    $activeClass = 'active open';
    }
    }
    }
    @endphp

    {{-- main menu --}}
    <li class="menu-item {{ $activeClass }}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }} text-light"
        @if (!empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }} text-primary"></i>
        @endisset
        <div>{{ $menu->name ?? '' }}</div>
        @isset($menu->badge)
        <div class="badge rounded-pill bg-{{ $menu->badge[0] }} text-uppercase ms-auto">{{ $menu->badge[1] }}</div>
        @endisset
      </a>

      {{-- submenu --}}
      @isset($menu->submenu)
      @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
      @endisset
    </li>
    @endif
    @endforeach
  </ul>
</aside>

<style>
  /* Dark theme for sidebar */
  .bg-dark {
    background-color: #232333 !important;
  }

  .bg-dark-subtle {
    background-color: #2b2c40 !important;
  }

  .menu-vertical .menu-inner>.menu-item.active>.menu-link {
    background-color: rgba(124, 125, 182, 0.16) !important;
    box-shadow: 0 0 0.25rem 0.05rem rgba(124, 125, 182, 0.2);
  }

  .menu-vertical .menu-inner>.menu-item.active:before {
    background: #696cff;
  }

  .menu-item.active>.menu-link:not(.menu-toggle) {
    color: #fff !important;
  }

  .menu-vertical .menu-item .menu-link:hover {
    background-color: rgba(124, 125, 182, 0.1) !important;
  }

  .menu-vertical .menu-sub .menu-item .menu-link {
    color: #a3a4cc !important;
  }

  .menu-vertical .menu-sub .menu-item .menu-link:hover {
    color: #fff !important;
  }

  .menu-vertical .menu-sub .menu-item.active>.menu-link {
    color: #fff !important;
  }

  /* Fix untuk tombol burger menu */
  .layout-menu-toggle {
    background-color: transparent !important;
    /* Menghilangkan warna biru */
    color: #e5e5e5 !important;
    /* Warna ikon yang sesuai dengan tema dark */
    border: none;
    box-shadow: none;
  }

  .layout-menu-toggle:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    /* Efek hover yang subtle */
    color: #fff !important;
  }

  .layout-menu-toggle i {
    color: #e5e5e5 !important;
    /* Memastikan ikon juga memiliki warna yang konsisten */
  }

  /* Pastikan tombol burger menu tidak terpengaruh oleh style lain */
  .menu-link.d-block.d-xl-none {
    background-color: transparent !important;
    box-shadow: none !important;
  }

  /* Jika perlu, tambahkan spesifikasi untuk mengatasi style lain */
  #layout-menu .layout-menu-toggle.menu-link {
    background-color: transparent !important;
    color: #e5e5e5 !important;
  }
</style>