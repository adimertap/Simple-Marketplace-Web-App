<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/admin')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li> <a href="{{url('/admin')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span></a>
            <ul>
                <li><a href="{{url('/admin/product_cat')}}">List Kategori</a></li>
                <li><a href="{{url('/admin/product_cat/create')}}">Add New Category</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span></a>
            <ul>
                <li><a href="{{url('/admin/product')}}">List Products</a></li>
                <li><a href="{{url('/admin/product/create')}}">Add New Product</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Courier</span></a>
            <ul>
                <li><a href="{{url('/admin/courier')}}">List Courier</a></li>
                <li><a href="{{url('/admin/courier/create')}}">Add New Courier</a></li>
            </ul>
        </li>
        <li> <a href="/admin/transactionAdmin"><i class="icon icon-money"></i> <span>Transaction</span></a> </li>
        <li> <a href="/admin/response"><i class="icon icon-envelope"></i> <span>Response</span></a> </li>
    </ul>
</div>
<!--sidebar-menu-->