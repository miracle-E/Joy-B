<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from material-admin.strapui.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Apr 2020 22:55:23 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>{{ config('app.name', 'Joy & B') }}</title>

    <link rel="stylesheet" href="{{ URL::asset('css/vendor.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/app-blue.css') }}" />
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">

</head>

<body class="small-sidebar   ">

    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

        @include('includes.admin.header')


        <!-- Side bar here -->
        @include('includes.admin.sidebar')



        <main class="mdl-layout__content content-holder">
            <div class=" page-content remodal-bg animsition">
                <!-- Your content goes here -->
                @include('includes.admin.messages')
                @yield('content')

            </div>
        </main>
    </div>


    <script src="{{ URL::asset('js/vendor.js') }}" type="text/javascript"></script>





    <script>

        $(function () {

            if ($(window).width() < 840) {

                if ($('body').hasClass('extended') == 1) {
                    $('body').removeClass('extended')
                }
            }

            var sessionLayout = "";

            if (!sessionLayout && $(window).width() > 1600) {

                $('.c-hamburger').addClass('is-active');
                $('body').addClass('extended');
                $('.sidebar').perfectScrollbar();

            };

            // $(".thisRTL").click(function () {
            //     $('body').toggleClass('rtl');
            //     var hasClass = $('body').hasClass('rtl');
            //     $.get('/api/set-rtl?rtl=' + (hasClass ? 'rtl' : ''));
            //     setTimeout(function () {
            //         window.location.reload(true);
            //     }, 0);
            // });



            $(".c-hamburger").click(function () {

                $(this).toggleClass('is-active');
                $('body').toggleClass('extended');

                var hasClass = $('body').hasClass('extended');

                $.get('/api/change-layout?layout=' + (hasClass ? 'extended' : 'collapsed'));

            });

            if ($('body').hasClass('extended') == 1) {
                $(".c-hamburger").addClass('is-active');
                $('.sidebar').perfectScrollbar();
            };
            $(".show-menu").click(function () {
                $(this).parent().find('.sub-menu').toggleClass('visible');
            });

            $(".animsition").animsition({

                inClass: 'zoom-in-sm',
                outClass: 'zoom-out-sm',
                inDuration: 350,
                outDuration: 500,
                linkElement: '.animsition-link',
                // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
                loading: 0,
                loadingParentElement: 'body', //animsition wrapper element
                loadingClass: 'animsition-loading',
                unSupportCss: ['animation-duration',
                    '-webkit-animation-duration',
                    '-o-animation-duration'
                ],
                //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
                //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

                overlay: false,
                overlayClass: 'animsition-overlay-slide',
                overlayParentElement: 'body'
            });


            $(window).resize(function () {

                if ($(window).width() > 1600) {
                    $('.c-hamburger').addClass('is-active');
                    $('body').addClass('extended');
                    $('.sidebar').perfectScrollbar();

                };
                if ($(window).width() < 1200) {
                    $('.c-hamburger').removeClass('is-active');
                    $('body').removeClass('extended');
                };
                if ($('body').hasClass('extended') == 1) {
                    $('.sidebar').addClass('ps-container');
                    $('.sidebar').perfectScrollbar();
                    $('.sidebar').perfectScrollbar('update');
                }
                else if ($('body').hasClass('extended') == 0) {
                    $('.sidebar').removeClass('ps-container');
                }
            });

            $(".c-hamburger").click(function () {

                if ($('body').hasClass('extended') == 1) {
                    $('.sidebar').addClass('ps-container');
                    $('.sidebar').perfectScrollbar();
                    $('.sidebar').perfectScrollbar('update');
                }
                else if ($('body').hasClass('extended') == 0) {
                    $('.sidebar').removeClass('ps-container');
                }
            });
            $('.theme-picker').click(function () {
                changeTheme($(this).attr('id'));
            });

            // function changeTheme(theme) {

            //     $('<link>')
            //         .appendTo('head')
            //         .attr({ type: 'text/css', rel: 'stylesheet' })
            //         .attr('href', '/css/app-' + theme + '.css');

            //     $.get('api/change-theme?theme=' + theme);
            // }


        });
        // function changeLanguage(lang) {
        //     console.log(lang);
        //     $.get('api/lang?lang=' + lang);
        //     setTimeout(function () {
        //         window.location.reload(true);

        //     }, 550);
        // }
    </script>



    <script>
        $(function () {
            // $.growl({ title: "Hello", message: "Welcome to {{ config('app.name', 'Joy & B') }} admin!" });
            if ($(window).width() < 600) {
                $('#drag').removeAttr('id');
                $('#drag2').removeAttr('id');
            };


            dragula([document.getElementById('drag2')], {
                revertOnSpill: true
            });



        });
    </script>

</body>

<!-- Mirrored from material-admin.strapui.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Apr 2020 22:55:53 GMT -->

</html>
