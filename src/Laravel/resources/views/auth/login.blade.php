<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>JoyB Admin | Login
    </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="JoyB Limited" name="description" />
    <meta content="EkFinbarr" name="author" />

    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app-blue.css') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>

<body class="small-sidebar   ">

    <div class="login-overlay">
        <div class="logo">
            JOY & B <br> <span class="smaller">Projects Limited</span>
        </div>
        <div class="form-container shadow">
            <div class="icon">
                <i class="mdi mdi-account-circle"></i>
                <div class="header">
                    Login
                </div>
            </div>
            @include('includes.admin.messages')
            @if ($errors->has('email') || $errors->has('password'))
            <p class="mg-b-0 hidden" style="color: red;" id="error-submission">
                {{ $errors->first('email') }}
            </p>
            <p class="mg-b-0 hidden" style="color: red;" id="error-submission">
                {{ $errors->first('password') }}
            </p>
            @endif
            <div class="inputs">
                <form id="login-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
                        <input class="mdl-textfield__input" type="email" name="email" id="email" required />
                        <label class="mdl-textfield__label" for="sample3">username or email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
                        <input class="mdl-textfield__input" type="password" name="password" id="password" required />
                        <label class="mdl-textfield__label" for="sample3">password</label>
                    </div>
                    <div class="buttons">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
                            <input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
                            <span class="mdl-checkbox__label">Remember me</span>
                        </label>
                        <span class="signup">
                            <a href="/register">Sign up here</a>
                        </span>
                        <div class="link">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"
                                type="submit">
                                Login
                            </button>
                        </div>
                    </div>
                </form>




            </div>
        </div>
    </div>
    <footer class="mdl-mini-footer login-footer">
        <div class="mdl-mini-footer__left-section">
            <div class="mdl-logo">&copy;Joy & B Projects Limited </div>
            </ul>
        </div>
    </footer>

    <script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>

</body>

</html>
