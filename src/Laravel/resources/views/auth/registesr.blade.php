<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>JoyB Admin | Register
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
                    Sign Up
                </div>
            </div>

            <div class="inputs">

                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    @csrf
                    @if ($errors->has('name') || $errors->has('email') || $errors->has('password'))
                    <p class="mg-b-0 hidden" style="color: red;" id="error-password-mismatch">
                        {{ $errors->first('name') }}
                    </p>
                    <p class="mg-b-0 hidden" style="color: red;" id="error-submission">
                        {{ $errors->first('email') }}
                    </p>
                    <p class="mg-b-0 hidden" style="color: red;" id="error-submission">
                        {{ $errors->first('password') }}
                    </p>
                    @endif
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
                        <input required class="mdl-textfield__input" type="text" name="name" id="name" />
                        <label class="mdl-textfield__label" for="sample3">full name</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
                        <input required class="mdl-textfield__input" type="email" name="email" id="email" />
                        <label class="mdl-textfield__label" for="sample3">email</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
                        <input required class="mdl-textfield__input" type="password" name="password" id="password" />
                        <label class="mdl-textfield__label" for="sample3">password</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
                        <input required class="mdl-textfield__input" type="password" name="password_confirmation"
                            id="password-confirm" />
                        <label class="mdl-textfield__label" for="sample3">retype password</label>
                    </div>
                    <div class="buttons">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
                            <input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" />
                            <span class="mdl-checkbox__label">Remember me</span>
                        </label>
                        <span class="signup">
                            <a href="/login">Login here</a>
                        </span>
                        <div class="link">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="index.html">
                                {{ __('Register') }}
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
