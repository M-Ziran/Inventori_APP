<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <style>
        /* Custom Sidebar Appearance */
        .main-sidebar {
            background: linear-gradient(180deg, #1e2125 0%, #2c3136 100%) !important;
        }

        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 1.2rem 0.5rem !important;
        }

        .brand-text {
            font-weight: 700 !important;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: linear-gradient(to right, #ffffff, #007bff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-panel {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 1.2rem 0 !important;
        }

        /* Nav Item Styling */
        .nav-sidebar .nav-item .nav-link {
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s ease;
        }

        .nav-sidebar .nav-link.active {
            background-color: #007bff !important;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3) !important;
            color: #fff !important;
        }

        .nav-sidebar .nav-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05) !important;
            transform: translateX(5px);
        }

        /* Icon Styling */
        .nav-icon {
            font-size: 0.9rem !important;
            margin-right: 10px !important;
        }

        /* Treeview (Submenu) styling */
        .nav-treeview {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 0 10px !important;
        }

        .nav-treeview .nav-link {
            margin: 0 !important;
            font-size: 0.9rem;
        }
    </style>

    <a href="/dashboard" class="brand-link text-center">
        <span class="brand-text">{{ env('APP_NAME') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <div class="bg-primary d-flex align-items-center justify-content-center img-circle elevation-2"
                    style="width: 35px; height: 35px;">
                    <i class="fas fa-user-tie text-white" style="font-size: 1.1rem;"></i>
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold" style="color: rgba(255,255,255,0.9);">
                    {{ auth()->user()->name }}
                </a>
                <small class="text-success"><i class="fas fa-circle font-size-xs mr-1" style="font-size: 8px;"></i>
                    Online</small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($routes as $route)
                    @if (!$route['is_dropdown'])
                        <li class="nav-item">
                            <a href="{{ route($route['route_name']) }}"
                                class="nav-link {{ request()->routeIs($route['route_active']) ? 'active' : '' }}">
                                <i class="nav-icon {{ $route['icon'] }}"></i>
                                <p>{{ $route['label'] }}</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item {{ request()->routeIs($route['route_active']) ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->routeIs($route['route_active']) ? 'active' : '' }}">
                                <i class="nav-icon {{ $route['icon'] }}"></i>
                                <p>
                                    {{ $route['label'] }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($route['dropdown'] as $item)
                                    <li class="nav-item">
                                        <a href="{{ route($item['route_name']) }}"
                                            class="nav-link {{ request()->routeIs($item['route_active']) ? 'active' : '' }}">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>{{ $item['label'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
