<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Personal Task Manager' }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f7f9;
            color: #252525;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #e8e8e8;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            margin-bottom: 35px;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #e93f1a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }

        .logo-text {
            font-size: 18px;
            font-weight: bold;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            color: #999;
            text-transform: uppercase;
            padding: 0 12px;
            margin-bottom: 10px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border-radius: 10px;
            font-size: 14px;
            color: #666;
            transition: 0.2s;
        }

        .nav a:hover {
            background: #f1f2ff;
            color: #e93f1a;
        }

        .nav a.active {
            background: #bcc4f2;
            color: #222;
            font-weight: bold;
        }

        .nav-icon {
            width: 22px;
            text-align: center;
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: bold;
        }

        .page-subtitle {
            color: #777;
            margin-top: 5px;
            font-size: 14px;
        }

        .add-button {
            background: #e93f1a;
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .add-button:hover {
            background: #c93213;
        }

        /* CONTENT */

        .content {
            max-width: 1200px;
            margin: auto;
        }

        /* MOBILE */

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 20px 10px;
            }

            .logo-text,
            .menu-title,
            .nav span {
                display: none;
            }

            .logo {
                justify-content: center;
            }

            .nav a {
                justify-content: center;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="app">

    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">✓</div>

            <div class="logo-text">
                Task Manager
            </div>
        </div>

        <div class="menu-title">
            Menu
        </div>

        <nav class="nav">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <div class="nav-icon">⌂</div>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('tasks.create') }}"
               class="{{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                <div class="nav-icon">＋</div>
                <span>Add Task</span>
            </a>

            <a href="{{ route('tasks.index') }}"
               class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                <div class="nav-icon">☷</div>
                <span>Tasks</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <div class="content">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>