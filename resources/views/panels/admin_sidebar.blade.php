<a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
    <i class="fas fa-home fa-fw me-3"></i><span>Home</span>
</a>

<a href="{{ route('admin.clients.index') }}" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-user fa-fw me-3"></i><span>Clients</span>
</a>

<a href="{{ route('admin.companies.index') }}" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-square fa-fw me-3"></i><span>Companies</span>
</a>

{{-- 
    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fas fa-credit-card fa-fw me-3"></i><span>Sales</span>
    </a>

    <a href="{{ route('orders') }}" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fas fa-highlighter fa-fw me-3"></i><span>Auctions</span>
    </a> 
--}}

<a href="{{ route('admin.projects.index') }}" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-highlighter fa-fw me-3"></i><span>Projects</span>
</a>

@if(auth()->user()->role == 'admin')
    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fas fa-shield fa-fw me-3"></i><span>System Users</span>
    </a>

<a href="{{ route('admin.requirements.index') }}" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-file fa-fw me-3"></i><span>Requirements</span>
</a>
<a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-file fa-fw me-3"></i><span>Categories</span>
</a>
@endif
{{-- 
    <div class="list-group-item list-group-item-action dropdown ripple py-0 px-0 mb-auto">
        <a  class="dropdown-toggle list-group-item list-group-item-action py-2 ripple" style="border: none;" id="ProductsDropdown" data-bs-toggle="dropdown" aria-expanded="true" role="button">
            <i class="fas fa-box-open fa-fw me-3"></i><span>Products</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="ProductsDropdown">
            <a class="dropdown-item" href="{{ route('product-listing') }}">All Products</a>
            <a class="dropdown-item" href="#">Bids</a>
            <a class="dropdown-item" href="#">Transfer</a>
        </div>
    </div> 
--}}
<a href="#" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-chart-area fa-fw me-3"></i><span>Reports</span>
</a>
{{-- 
    <a href="{{ route('admin.dashboard') }}" target="_blank" class="list-group-item list-group-item-action py-2 ripple">
    <i class="fas fa-store fa-fw me-3"></i><span>Go to Platform&nbsp;<i class="fa fa-external-link fa-fw"></i></span>
</a>
--}}
<a href="#" class="list-group-item list-group-item-action py-2 ripple sidebar-bottom">
    <i class="fas fa-circle-question fa-fw me-3"></i><span>Help</span>
</a>