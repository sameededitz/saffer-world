<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.html" class="sidebar-logo">
            <img src="{{ asset('admin_assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('admin_assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('admin_assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('admin-home') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Application</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="uil:server" class="menu-icon"></iconify-icon>
                    <span>Servers</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('all-servers') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            VPN Servers</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ri:user-line" class="menu-icon"></iconify-icon>
                    <span>Account</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('all-users') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Customer Accounts</a>
                    </li>
                    <li>
                        <a href="{{ route('all-admins') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Admin Accounts</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:bill-list-linear" class="menu-icon"></iconify-icon>
                    <span>Billing</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('all-plans') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Plans</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('all-options') }}">
                    <iconify-icon icon="solar:settings-broken" class="menu-icon"></iconify-icon>
                    <span>Settings</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('all-notifications') }}">
                    <iconify-icon icon="ant-design:notification-outlined" class="menu-icon"></iconify-icon>
                    <span>Notifications</span>
                </a>
            </li> --}}
        </ul>
    </div>
</aside>
