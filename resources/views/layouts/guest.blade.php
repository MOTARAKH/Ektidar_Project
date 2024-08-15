<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>اقتدار</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
    <style>
        /* Body and General Styles */
body {
    font-family: 'Figtree', sans-serif;
    color: #1a202c;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.font-sans {
    font-family: sans-serif;
}

.text-gray-900 {
    color: #1a202c;
}

.antialiased {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Full Screen Height */
.min-h-screen {
    min-height: 100vh;
}

/* Flexbox and Alignment */
.flex {
    display: flex;
}

.flex-col {
    flex-direction: column;
}

.sm\:justify-center {
    justify-content: center;
}

.items-center {
    align-items: center;
}

.pt-6 {
    padding-top: 1.5rem;
}

.sm\:pt-0 {
    padding-top: 0;
}

.bg-gray-100 {
    background-color: #f7fafc;
}

/* Logo Styling */
.w-20 {
    width: 5rem;
}

.h-20 {
    height: 5rem;
}

.fill-current {
    fill: currentColor;
}

.text-gray-500 {
    color: #6b7280;
}

/* Container Styling */
.w-full {
    width: 100%;
}

.sm\:max-w-md {
    max-width: 28rem;
}

.mt-6 {
    margin-top: 1.5rem;
}

.px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.py-4 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.bg-white {
    background-color: #ffffff;
}

.shadow-md {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.overflow-hidden {
    overflow: hidden;
}

.sm\:rounded-lg {
    border-radius: 0.5rem;
}

    </style>
</html>
