<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - Confirmación de Email</title>
    <style>
        .i-mail:after,
        .i-mail .mail-anim:after {
            content: "";
            position: absolute;
            bottom: 5px;
            left: 5px;
            width: 15px;
            height: 4px;
            border-bottom: 2px solid black;
            border-top: 2px solid black;
        }

        .i-mail:before,
        .i-mail .mail-anim:before {
            content: "";
            position: absolute;
            top: 5px;
            right: 5px;
            width: 7px;
            height: 6px;
            background: black;
        }

        .i-success:after,
        .i-success .success-anim:after {
            content: "";
            position: absolute;
            bottom: 12px;
            left: 11px;
            width: 15px;
            height: 8px;
            border-bottom: 2px solid #e0b341;
            border-left: 2px solid #e0b341;
            transform: rotate(-45deg);
        }

        .container {
            position: absolute;
            top: 50%;
            left: calc(50% - 240px);
            width: 540px;
        }

        .animation {
            width: 540px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .i-mail,
        .i-mail .mail-anim {
            width: 40px;
            height: 30px;
            border-radius: 5% 5%;
            border: 2px solid black;
            position: relative;
            animation: transformS 0.3s linear;
        }

        @keyframes transformS {
            50% {
                transform: scale(0.5, 0.5);
                opacity: 0.5;
            }
        }

        .i-mail .mail-anim {
            margin: -2px 0 0 -2px;
            animation: moveL 0.8s linear;
        }

        @keyframes moveL {
            100% {
                transform: translateX(220px) rotateY(90deg);
            }
        }

        .line {
            padding: 1px 210px;
            background-image: linear-gradient(to right, #000 30%, rgba(255, 255, 255, 0) 0%);
            background-position: top;
            background-size: 15px 2px;
            background-repeat: repeat-x;
        }

        .i-success,
        .i-success .success-anim {
            width: 40px;
            height: 30px;
            border-radius: 5% 5%;
            border: 2px solid #e0b341;
            position: relative;
            animation: transformB 0.3s 1.4s linear forwards;
        }

        .i-success:after,
        .i-success .success-anim:after {
            animation: transformBA 0.3s 1.4s linear forwards;
        }

        @keyframes transformB {
            50% {
                transform: scale(1.5, 1.5);
                background: #e0b341;
            }

            100% {
                background: #e0b341;
            }
        }

        @keyframes transformBA {
            100% {
                border-bottom: 2px solid #fff;
                border-left: 2px solid #fff;
            }
        }

        .i-success .success-anim {
            margin: -2px 0 0 -2px;
            animation: moveR 0.8s 1s linear;
        }

        @keyframes moveR {
            0% {
                transform: translateX(-220px) rotateY(90deg);
            }

            50% {
                transform: translateX(0) rotateY(0);
            }
        }

        .message {
            text-align: center;
            margin-top: 10px;
            font-family: Roboto, sans-serif;
        }

        .button {
            border: 1px solid #111111; 
            background: #fff; 
            height: 40px; 
            padding: 10px; 
            font-weight: bold; 
            cursor: pointer; 
            margin-top: 15px;
            text-transform: uppercase;
            transition: 0.5s;
        }

        .button:hover {
            border: 1px solid #fff;
            background: #111111; 
            color: #fff;
        }

        .link {
            cursor: pointer;
            text-decoration-line: underline;
            margin-top: 15px;
            font-size: 15px;
            background: transparent;
            border: none;
        }

        .link:hover {            
            text-decoration-line: none;           
        }

        @media (max-width: 767px) { 
            .container {
                position: absolute;
                top: 30%;
                left: calc(50% - 174px);
                width: 200px;
            }
            .animation {
                width: 200px;
                height: 34px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .message {
                text-align: center;
                margin-top: 10px;
                font-family: Roboto, sans-serif;
                margin-left: 70px;
                width: 100%;
            }
            
            .line {
                padding: 1px 130px;
                background-image: linear-gradient(to right, #000 30%, rgba(255, 255, 255, 0) 0%);
                background-position: top;
                background-size: 15px 2px;
                background-repeat: repeat-x;
            }
        }
    </style>
</head>

<body>
    <div class='container'>
        <div class='animation'>
            <div class='i-mail'>
                <div class='mail-anim'></div>
            </div>
            <div class='line'></div>
            <div class='i-success'>
                <div class='success-anim'></div>
            </div>
        </div>
        <div class='message'>
            Tú email de confirmación fue enviado, verifica tú bandeja de entrada o spam.
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="button">{{ __('envíar de nuevo') }}</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="link">{{ __('Cerrar Sesión') }}</button>
            </form>
        </div>
    </div>


</body>

</html>