    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{ asset('assets') }}/img/profile/{{$instansi->logo}}" alt="instansi-logo" class="d-block rounded" width="50" />

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">WASBID</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Wasbid</span>
          </li>
          <li class="menu-item {{ Str::startsWith(request()->url(), url('/pengawasan')) ? 'active' : '' }}">
              <a href="{{ url('/pengawasan') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pengawasan">Pengawasan</div>
              </a>
          </li>            
          @if(auth()->user()->role == 1)
        <!-- Menu hanya untuk user role 1 -->
        <li class="menu-item {{ Str::startsWith(request()->url(), url('/config')) ? 'active' : '' }}">
            <a href="{{ url('/config') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Config">Config</div>
            </a>
        </li>
    @endif            
      </ul>
            
      </aside>
      <!-- / Menu -->