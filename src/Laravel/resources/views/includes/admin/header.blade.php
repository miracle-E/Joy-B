<header class="mdl-layout__header navbar shadow">
    <div class="mdl-layout__header-row">
        <!-- Hamburger -->
        <button class="c-hamburger c-hamburger--htla">
            <span>toggle menu</span>
        </button>
        <div class="responsive-logo">
            {{ config('app.name', 'Joy & B') }} <br><span class="smaller">Dashboard</span>
        </div>
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            <!-- Left aligned menu below button -->
            <button id="demo-menu-lower-left" class="mdl-button mdl-js-button mdl-button--icon">
                <i class="mdi mdi-brightness-1 text-primary"></i>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect zero-padding"
                for="demo-menu-lower-left">
                <table class="color-picker">
                    <tr>
                        <td><a href="#" id="blue" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                        <td><a href="#" id="red" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                    </tr>
                    <tr>
                        <td><a href="#" id="grey" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                        <td><a href="#" id="green" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                    </tr>
                    <tr>
                        <td><a href="#" id="purple" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                        <td><a href="#" id="cyan" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                    </tr>
                </table>
            </ul>

        </nav>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        @guest
        @else
        <nav class="mdl-navigation mdl-layout--large-screen-only">
            <span class="relative">
                <button id="demo-menu-lower-right2" class="mdl-button mdl-js-button nav-button">
                    <div class="mdl-badge" data-badge="6"><i class="mdi mdi-email"></i></div>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right2">
                    <li class="mdl-menu__item"><a href="#">Inbox</a></li>
                    <li class="mdl-menu__item"><a href="#">New Orders</a></li>
                </ul>
            </span>
            <span class="relative">
                <button id="demo-menu-lower-right3" class="mdl-button mdl-js-button nav-button">
                   <div class="mdl-badge" data-badge="4"><i class="mdi mdi-keyboard"></i></div>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right3">
                    <li class="mdl-menu__item" onclick="changeLanguage('en')">English</li>
                    <li class="mdl-menu__item" onclick="changeLanguage('fr')">French</li>
                </ul>
            </span>
            <span class="relative">
                <button id="demo-menu-lower-right" class="mdl-button mdl-js-button nav-button">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
                    <li class="mdl-menu__item"><a href="/logout">Logout</a></li>
                    <li class="mdl-menu__item"><a href="/profile">Profile</a></li>
                </ul>
            </span>
        </nav>
        @endguest
    </div>
</header>
