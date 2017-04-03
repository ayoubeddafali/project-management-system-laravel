<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

</head>


    <style>
        *, *:before, *:after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            font-size: 62.5%;
            height: 100%;
            overflow: hidden;
        }
        @media (max-width: 768px) {
            html, body {
                font-size: 50%;
            }
        }

        svg {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            overflow: visible;
        }

        .svg-icon {
            cursor: pointer;
        }
        .svg-icon path {
            stroke: rgba(255, 255, 255, 0.9);
            fill: none;
            stroke-width: 1;
        }

        input, button {
            outline: none;
            border: none;
        }

        .cont {
            position: relative;
            height: 100%;
            background-image: url("/img/slider-2.jpg");
            background-size: cover;
            overflow: auto;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
        }

        .demo {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -15rem;
            margin-top: -26.5rem;
            width: 30rem;
            height: 53rem;
            overflow: hidden;
        }

        .login {
            position: relative;
            height: 100%;
            background: -webkit-linear-gradient(top, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
            background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
            -webkit-transition: opacity 0.1s, -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
            transition: opacity 0.1s, -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
            transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
            transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25), -webkit-transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        .login.inactive {
            opacity: 0;
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
        .login__check {
            position: absolute;
            top: 16rem;
            left: 13.5rem;
            width: 14rem;
            height: 2.8rem;
            background: #fff;
            -webkit-transform-origin: 0 100%;
            transform-origin: 0 100%;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        .login__check:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 100%;
            width: 2.8rem;
            height: 5.2rem;
            background: #fff;
            box-shadow: inset -0.2rem -2rem 2rem rgba(0, 0, 0, 0.2);
        }
        .login__form {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 50%;
            padding: 1.5rem 2.5rem;
            text-align: center;
        }
        .login__row {
            height: 5rem;
            padding-top: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login__icon {
            margin-bottom: -0.4rem;
            margin-right: 0.5rem;
        }
        .login__icon.name path {
            stroke-dasharray: 73.50196075439453;
            stroke-dashoffset: 73.50196075439453;
            -webkit-animation: animatePath 2s 0.5s forwards;
            animation: animatePath 2s 0.5s forwards;
        }
        .login__icon.pass path {
            stroke-dasharray: 92.10662841796875;
            stroke-dashoffset: 92.10662841796875;
            -webkit-animation: animatePath 2s 0.5s forwards;
            animation: animatePath 2s 0.5s forwards;
        }
        .login__input {
            display: inline-block;
            width: 22rem;
            height: 100%;
            padding-left: 1.5rem;
            font-size: 1.5rem;
            background: transparent;
            color: #FDFCFD;
        }
        .login__submit {
            position: relative;
            width: 100%;
            height: 4rem;
            margin: 5rem 0 2.2rem;
            color: rgba(255, 255, 255, 0.8);
            background: #FF3366;
            font-size: 1.5rem;
            border-radius: 3rem;
            cursor: pointer;
            overflow: hidden;
            -webkit-transition: width 0.3s 0.15s, font-size 0.1s 0.15s;
            transition: width 0.3s 0.15s, font-size 0.1s 0.15s;
        }
        .login__submit:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -1.5rem;
            margin-top: -1.5rem;
            width: 3rem;
            height: 3rem;
            border: 2px dotted #fff;
            border-radius: 50%;
            border-left: none;
            border-bottom: none;
            -webkit-transition: opacity 0.1s 0.4s;
            transition: opacity 0.1s 0.4s;
            opacity: 0;
        }
        .login__submit.processing {
            width: 4rem;
            font-size: 0;
        }
        .login__submit.processing:after {
            opacity: 1;
            -webkit-animation: rotate 0.5s 0.4s infinite linear;
            animation: rotate 0.5s 0.4s infinite linear;
        }
        .login__submit.success {
            -webkit-transition: opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
            transition: opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
            transition: transform 0.3s 0.1s ease-out, opacity 0.1s 0.3s, background-color 0.1s 0.3s;
            transition: transform 0.3s 0.1s ease-out, opacity 0.1s 0.3s, background-color 0.1s 0.3s, -webkit-transform 0.3s 0.1s ease-out;
            -webkit-transform: scale(30);
            transform: scale(30);
            opacity: 0.9;
        }
        .login__submit.success:after {
            -webkit-transition: opacity 0.1s 0s;
            transition: opacity 0.1s 0s;
            opacity: 0;
            -webkit-animation: none;
            animation: none;
        }
        .login__signup {
            font-size: 1.2rem;
            color: #ABA8AE;
        }
        .login__signup a {
            color: #fff;
            cursor: pointer;
        }



    </style>
<body>



    <div class="cont">
        <div class="demo">
            <div class="login">
                <div class="login__check"></div>
                <div class="errors">
                    @if($errors->any())
                        <ul class="alert" style="color: darkred; width: inherit;  background-color: transparent;" >
                            @foreach($errors->all() as $error)
                                <li style="font-size: 13px;"> <b>{{ $error }}</b> </li>
                            @endforeach
                        </ul>

                    @endif
                </div>
                <form action="{{ url('/login') }}" method="post">
                    {{ csrf_field() }}
                <div class="login__form">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                        </svg>

                        {{--<input type="text" class="login__input name" placeholder="Username"/>--}}
                        <input type="email" name="email" class="login__input name" placeholder="Email" value="{{ old('email') }}">



                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                        </svg>
                        {{--<input type="password" class="login__input pass" placeholder="Password"/>--}}
                        <input type="password" name="password" class="login__input pass" placeholder="Password">


                    </div>
                    {{--<button type="button" class="login__submit">Sign in</button>--}}
                    <button type="submit" class="login__submit">
                     Login
                    </button>
                    <p class="login__signup">Don't have an account? &nbsp;<a href="/register">Sign up</a></p>
                </div>
            </form>
            </div>



    </div>
    </div>


    <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script>
        $(document).ready(function() {

            var animating = false,
                    submitPhase1 = 1100,
                    submitPhase2 = 400,
                    logoutPhase1 = 800,
                    $login = $(".login"),
                    $app = $(".app");

            function ripple(elem, e) {
                $(".ripple").remove();
                var elTop = elem.offset().top,
                        elLeft = elem.offset().left,
                        x = e.pageX - elLeft,
                        y = e.pageY - elTop;
                var $ripple = $("<div class='ripple'></div>");
                $ripple.css({top: y, left: x});
                elem.append($ripple);
            };

            $(document).on("click", ".login__submit", function(e) {
                if (animating) return;
                animating = true;
                var that = this;
                ripple($(that), e);
                $(that).addClass("processing");
                setTimeout(function() {
                    $(that).addClass("success");
                    setTimeout(function() {
                        $app.show();
                        $app.css("top");
                        $app.addClass("active");
                    }, submitPhase2 - 70);
                    setTimeout(function() {
                        $login.hide();
                        $login.addClass("inactive");
                        animating = false;
                        $(that).removeClass("success processing");
                    }, submitPhase2);
                }, submitPhase1);
            });

            $(document).on("click", ".app__logout", function(e) {
                if (animating) return;
                $(".ripple").remove();
                animating = true;
                var that = this;
                $(that).addClass("clicked");
                setTimeout(function() {
                    $app.removeClass("active");
                    $login.show();
                    $login.css("top");
                    $login.removeClass("inactive");
                }, logoutPhase1 - 120);
                setTimeout(function() {
                    $app.hide();
                    animating = false;
                    $(that).removeClass("clicked");
                }, logoutPhase1);
            });

        });
    </script>


</body>
</html>