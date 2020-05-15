<!-- Side bar here -->
<aside id="" class="sidebar">
    <div class="top-logo">
        JB
    </div>
    <div class="top-logo-extended">
        {{ config('app.name', 'Joy & B') }} <br/> <span class="smaller">dashboard</span>
    </div>
    <div class="scrollbar" id="scroll">
        <div class="user-info">
            <div class="opacity">
                <div class="info">
                    User Name
                    {{-- {{ Auth::user()->name }} --}}
                <div class="pen">
                    <a href="/profile" class=""><i class="mdi mdi-border-color"></i></a>
                </div>
                </div>
            </div>
        </div>
        <div class="dashboard-menu">
            <ul class="menu-list">
                <li class=active><a href="/admin" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-home"></i> &nbsp;<span class="text">Home </span></a></li>
                <li class="show-subnav" ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-grid"></i> &nbsp;<span class="text">Products</span><i class="mdi mdi-chevron-down"></i></a>
                    <ul class="sub-menu ">
                        <li ><a href="/admin/products" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">List All</span></a></li>
                        <li ><a href="/admin/products/create" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Add New</span></a></li>
                        <li ><a href="/admin/orders" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Orders</span></a></li>
                    </ul>
                </li>
                <li class="show-subnav" ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-content-paste"></i> &nbsp;<span class="text">Category</span><i class="mdi mdi-chevron-down"></i></a>
                    <ul class="sub-menu ">
                        <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">List All</span></a></li>
                        <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Add New</span></a></li>
                    </ul>
                </li>
                <li class="show-subnav" ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-account-multiple-plus"></i> &nbsp;<span class="text">Users</span><i class="mdi mdi-chevron-down"></i></a>
                    <ul class="sub-menu ">
                        <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">List All</span></a></li>
                        <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Add New</span></a></li>
                        <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Manage Roles</span></a></li>
                    </ul>
                </li>
                <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-message"></i> &nbsp;<span class="text"> Inbox</span></a></li>
                <li ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-facebook-messenger"></i> &nbsp;<span class="text"> Social Links</span></a></li>
                <li ><a href="/profile" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-account"></i> &nbsp;<span class="text"> Profile</span></a></li>
                <li ><a href="/logout" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-logout"></i> &nbsp;<span class="text"> Logout</span></a></li>
            </ul>
        </div>
    </div>
</aside>
