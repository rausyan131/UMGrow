<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umgrow | {{ $title }}</title>

    @livewireStyles
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- Font Aweomse --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->

    <style>
        * {
            scroll-behavior: smooth;
        }

        .link-text {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .link-text::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #f97316;
            transition: width 0.3s ease-in-out;
        }

        .group:hover .link-text::after {
            width: 100%;
        }

        @keyframes floatGlow {

            0%,
            100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-20px) rotate(180deg) scale(1.1);
                opacity: 0.9;
            }
        }

        .animate-float-glow {
            animation: floatGlow 6s ease-in-out infinite;
        }
    </style>


</head>

<body class="font-roboto bg-black w-full overflow-x-hidden">

    {{ $slot }}

    @livewireScripts

</body>

</html>
