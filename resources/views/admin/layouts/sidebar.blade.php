<aside id="layout-menu" class="layout-menu menu-vertical menu bg-dark">
    <div class="app-brand demo">
        <a href="{{route('admin.dashboard')}}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Online Shop</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Category</span>
        </li>
        <li class="menu-item">
            <a href="{{route('addcategory')}}" class="menu-link">
                <i class="tf-icons bx bx-plus-circle"></i>
                <div data-i18n="Analytics">Add Category</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('allcategory')}}" class="menu-link">
                <i class="tf-icons bx bx-list-ul"></i>
                <div data-i18n="Analytics">All Category</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Sub Category</span>
        </li>
        <li class="menu-item">
            <a href="{{route('addsubcategory')}}" class="menu-link">
                <i class="tf-icons bx bx-plus-circle"></i>
                <div data-i18n="Analytics">Add Sub Category</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('allsubcategory')}}" class="menu-link">
                <i class="tf-icons bx bx-category-alt"></i>
                <div data-i18n="Analytics">All Sub Category</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Product</span>
        </li>
        <li class="menu-item">
            <a href="{{route('addproduct')}}" class="menu-link">
                <i class="tf-icons bx bx-plus-circle"></i>
                <div data-i18n="Analytics">Add Product</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('allproducts')}}" class="menu-link">
                <i class="tf-icons bx bx-list-ul"></i>
                <div data-i18n="Analytics">All Product</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Orders</span>
        </li>
        <li class="menu-item">
            <a href="{{route('pendingorders')}}" class="menu-link">
                <i class="tf-icons bx bx-time"></i>
                <div data-i18n="Analytics">Pending Order</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('completeOrders')}}" class="menu-link">
                <i class="tf-icons bx bx-check-circle"></i>
                <div data-i18n="Analytics">Completed Order</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="tf-icons bx bx-x-circle"></i>
                <div data-i18n="Analytics">Cancelled Order</div>
            </a>
        </li>
        <!-- Layouts -->
    </ul>
</aside>
