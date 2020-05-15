<div class="kt-sideleft">
    <label class="kt-sidebar-label">Navigation</label>
    <ul class="nav kt-sideleft-menu">
        <li class="nav-item">
            <a href="/admin/content" class="nav-link">
                <i class="icon ion-ios-home-outline"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- nav-item -->
        <li class="nav-item" id="content-category">
            <a href="#" class="nav-link with-sub">
                <i class="icon ion-ios-list-outline"></i>
                <span>Content Manager</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="/admin/content" class="nav-link">View All</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/content/create" class="nav-link">Add New</a>
                </li>
            </ul>
        </li>
        <!-- nav-item -->
        <li class="nav-item" id="content-category">
            <a href="#" class="nav-link with-sub">
                <i class="icon ion-ios-box-outline"></i>
                <span>Categories</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="/admin/category" class="nav-link">View All</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/category/create" class="nav-link">Add New</a>
                </li>
            </ul>
        </li>
        <!-- nav-item -->
        {{-- <li class="nav-item" id="topic">
            <a href="#" class="nav-link with-sub">
                <i class="icon ion-ios-briefcase"></i>

                <span>Topics</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="/admin/topic" class="nav-link">All Topics</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/topic/create" class="nav-link">Add New</a>
                </li>
            </ul>
        </li> --}}
        <!-- nav-item -->
        <!-- nav-item -->
        <li class="nav-item" id="subject">
            <a href="#" class="nav-link with-sub">
                <i class="icon ion-ios-briefcase"></i>

                <span>Subjects</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="/admin/subject" class="nav-link">All Subjects</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/subject/create" class="nav-link">Add New</a>
                </li>
            </ul>
        </li>
        <!-- nav-item -->
        <!-- nav-item -->
        <li class="nav-item" id="tag">
            <a href="#" class="nav-link with-sub">
                <i class="fa fa-tag"></i>

                <span>Tags</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item">
                    <a href="/admin/tag" class="nav-link">All Tags</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/tag/create" class="nav-link">Add New</a>
                </li>
            </ul>
        </li>
        <!-- nav-item -->
        <li class="nav-item">
            <a href="/admin/profile" class="nav-link">
                <i class="icon ion-ios-person-outline"></i>
                <span>Profile</span>
            </a>
        </li>
        <!-- nav-item -->
        <li class="nav-item" id="logout">
            <a href="#" class="nav-link">
                <i class="icon ion-power"></i>
                <span>Logout</span>
            </a>
        </li>
        <!-- nav-item -->
    </ul>
</div>
<!-- kt-sideleft -->
<script>
    // Logout Handler
    let logout_btn = document.getElementById("logout");
    logout_btn
        ?
        logout_btn.addEventListener("click", e => {
            e.preventDefault();
            API.logout();
        }) :
        null;

</script>
