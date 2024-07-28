<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #333;
            color: #fff;
            padding: 15px;
            height: 100vh;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #444;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="/dashboard">Home</a>
        <a href="/books">Books</a>
        <a href="/categories">Categories</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>

        <!-- Add more sidebar links as needed -->
    </div>
    <div class="content">
        

        <div class="container">
            @yield('content')
        </div>
    </div>
    @yield('footer_scripts')

</body>

</html>
