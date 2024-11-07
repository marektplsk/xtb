<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Landing Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100 text-gray-900 font-sans leading-normal tracking-normal">

<!-- Header -->
<header class="bg-white shadow">
    <div class="container mx-auto flex justify-between items-center py-6 px-8">
        <div class="text-3xl font-bold text-indigo-600">YourBrand</div>
        <nav class="space-x-4">
            <a href="#features" class="text-gray-600 hover:text-indigo-600">Features</a>
            <a href="#about" class="text-gray-600 hover:text-indigo-600">About</a>
            <a href="#contact" class="text-gray-600 hover:text-indigo-600">Contact</a>

            @if (Auth::check())  <!-- Check if the user is logged in -->
            <span class="text-gray-600">Welcome, {{ Auth::user()->name }}</span> <!-- Show username -->

            <!-- Form to log out -->
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="text-white bg-red-600 px-4 py-2 rounded-lg">Log Out</button>
            </form>
            @else
                <a href="{{ route('register') }}" class="text-white bg-indigo-600 px-4 py-2 rounded-lg">Sign Up</a>
                <a href="{{ route('login') }}" class="text-white bg-indigo-600 px-4 py-2 rounded-lg">Log In</a>
            @endif

        </nav>
    </div>
</header>


<!-- Hero Section -->
<section class="bg-indigo-600 text-white text-center py-20">
    <div class="container mx-auto px-8">
        <h1 class="text-5xl font-bold leading-tight mb-6">Welcome to Your Dream App</h1>
        <p class="text-xl mb-8">Build amazing web experiences with ease and confidence.</p>
        <a href="#features" class="text-indigo-600 bg-white font-semibold px-6 py-3 rounded-lg hover:bg-gray-200">
            Learn More
        </a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-white">
    <div class="container mx-auto px-8">
        <h2 class="text-4xl font-bold text-center mb-12">Features</h2>
        <div class="grid md:grid-cols-3 gap-12">
            <div class="text-center">
                <div class="bg-indigo-100 p-4 rounded-full w-16 h-16 mx-auto mb-4">
                    <i class="fas fa-bolt text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-semibold">Fast Performance</h3>
                <p class="mt-4">Experience blazing fast load times and a smooth interface.</p>
            </div>
            <div class="text-center">
                <div class="bg-indigo-100 p-4 rounded-full w-16 h-16 mx-auto mb-4">
                    <i class="fas fa-shield-alt text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-semibold">Secure</h3>
                <p class="mt-4">Your data is safe with our state-of-the-art security measures.</p>
            </div>
            <div class="text-center">
                <div class="bg-indigo-100 p-4 rounded-full w-16 h-16 mx-auto mb-4">
                    <i class="fas fa-cogs text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-semibold">Customizable</h3>
                <p class="mt-4">Easily adjust settings to make the app work for you.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-gray-100">
    <div class="container mx-auto px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">About Us</h2>
        <p class="text-lg max-w-2xl mx-auto">We are committed to helping you build the tools you need to succeed in a digital world. Our team of experts has decades of experience in software and design.</p>
    </div>
</section>

<!-- Footer -->
<footer class="bg-indigo-600 text-white py-8">
    <div class="container mx-auto px-8 text-center">
        <p>&copy; {{ date('Y') }} YourBrand. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
