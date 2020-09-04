<div class="sidebar">
    <div class="sidebar-inner">
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-30 actived"><a class="sidebar-link" href="{{route('admin.home')}}"><span class="icon-holder"><i class="fas fa-home"></i> </span><span class="title">Dashboard</span></a></li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="fas fa-sitemap"></i> </span><span class="title">Categories</span> <span class="arrow"><i class="fas fa-chevron-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="{{route('admin.categories.home')}}">All Categories</a></li>
                    <li><a class="sidebar-link" href="{{route('admin.categories.getNew')}}">New Category</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="fas fa-shopping-basket"></i> </span><span class="title">Products</span> <span class="arrow"><i class="fas fa-chevron-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="{{route('admin.products.home')}}">All Products</a></li>
                    <li><a class="sidebar-link" href="{{route('admin.products.getNew')}}">New Product</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('admin.system.home')}}"><span class="icon-holder"><i class="fas fa-cogs"></i> </span><span class="title">System Settings</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('admin.users.home')}}"><span class="icon-holder"><i class="fas fa-users"></i> </span><span class="title">Users</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('admin.discount.home')}}"><span class="icon-holder"><i class="fas fa-percent"></i> </span><span class="title">Discounts</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('admin.coupoun.home')}}"><span class="icon-holder"><i class="fas fa-ticket-alt"></i> </span><span class="title">Coupon Codes</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('admin.shippingCosts.home')}}"><span class="icon-holder"><i class="fas fa-truck"></i> </span><span class="title">Shipping Costs</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="{{route('admin.orders.home')}}"><span class="icon-holder"><i class="fas fa-file"></i> </span><span class="title">Orders</span></a></li>
        </ul>
    </div>
</div>
