<!-- sidebar.blade.php -->
<div class="sidebar p-4">
    <h1 class="text-lg font-bold">My Application</h1>
    <ul class="mt-4">
        <!-- Home link (future route implementation) -->
        <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Home</a></li>

        <!-- Dashboard link (future route implementation) -->
        <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Dashboard</a></li>

        <!-- Search link (future route implementation) -->
        <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Search</a></li>

        <!-- Portfolio link (future route implementation) -->
        <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Portfolio</a></li>

        <!-- Profile link (only for logged-in users, future route implementation) -->
        @if (Auth::check())
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Profile</a></li>
        @else
            <!-- Login link (future route implementation) -->
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Login</a></li>

            <!-- Register link (future route implementation) -->
            <li><a href="#" class="block py-2 px-4 hover:bg-gray-200">Register</a></li>
        @endif
    </ul>
</div>

<style>
    /* Custom styles */
    .sidebar {
        background-color: #E3E3E3;
        width: 250px; /* Fixed width for the sidebar */
        border-top-right-radius: 24px;
        border-bottom-right-radius: 24px;
        position: sticky;
        top: 0; /* Stick to the top of the viewport */
        height: 100vh; /* Full height of the viewport */
        overflow-y: auto; /* Allow scrolling if content overflows */
    }
</style>
