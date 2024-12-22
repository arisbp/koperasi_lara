<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Background of the whole page */
            body {
                background-color: #497449; /* Dark Green background for the entire page */
                font-family: 'Figtree', sans-serif;
                color: #4b5563; /* Darker text color */
                margin: 0;
                padding: 0;
            }

            /* Center the login form */
            .min-h-screen {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            /* Logo */
            .w-20.h-20 {
                fill: #ffffff; /* White color for the logo */
            }

            /* Form container styling */
            .w-full.sm\\:max-w-md {
                background-color: #ffffff; /* White background for the form */
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
            }

            /* Button styling */
            .btn-primary {
                background-color: #34d399; /* Green background for the button */
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                text-align: center;
                cursor: pointer;
                font-size: 16px;
                border: none;
                width: 100%;
                margin-top: 20px;
            }

            /* Input fields styling */
            .form-control {
                background-color: #f9fafb; /* Light gray background for inputs */
                border: 2px solid #497449; /* Dark green border for the input fields */
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 15px;
                width: 100%;
            }

            .form-control:focus {
                border-color: #6a8c3c; /* Darker green on focus */
                outline: none;
            }

            /* Label text */
            .text-gray-600 {
                color: #4b5563; /* Darker gray text for labels */
            }

            /* Error message styling */
            .text-danger {
                color: #ef4444; /* Red color for error messages */
            }

            /* Link styling for forgot password */
            .text-sm {
                color: #000000;
            }

            .text-sm:hover {
                text-decoration: underline;
                color: #000000;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#497449]">
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
</html>
