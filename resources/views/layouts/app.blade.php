<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Nothing' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,600;6..72,700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0a;
            --bg-soft: #10141a;
            --surface: #11161d;
            --surface-2: #17202a;
            --ink: #ecf5ff;
            --ink-muted: #a6bfd6;
            --line: #243241;
            --primary: #5cb6ff;
            --primary-soft: #132432;
            --accent: #4be58f;
            --ok-bg: #10261c;
            --ok-text: #87f0b7;
            --card-shadow: 0 14px 42px rgba(0, 0, 0, 0.35);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Space Grotesk", "Avenir Next", "Segoe UI", sans-serif;
            color: var(--ink);
            background: var(--bg);
            min-height: 100vh;
            line-height: 1.6;
        }

        .shell {
            width: min(1080px, 92vw);
            margin: 26px auto 44px;
            animation: shell-enter .45s ease;
        }

        @keyframes shell-enter {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .topbar {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--card-shadow);
            padding: 14px;
            margin-bottom: 12px;
        }

        .brand {
            display: inline-block;
            text-decoration: none;
            color: var(--ink);
            font-family: "Newsreader", Georgia, serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-right: 10px;
        }

        .top-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .top-nav a,
        .top-nav button {
            border: 1px solid var(--line);
            background: var(--surface-2);
            color: #dceeff;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: .88rem;
            text-decoration: none;
            cursor: pointer;
            transition: transform .18s ease, border-color .18s ease, background-color .18s ease;
        }

        .top-nav a:hover,
        .top-nav button:hover {
            transform: translateY(-1px);
            border-color: #2f5e85;
            background: #1c3043;
        }

        .top-nav .spacer {
            flex: 1 1 auto;
        }

        .user-chip {
            border-radius: 999px;
            padding: 6px 12px;
            background: var(--primary-soft);
            color: #98ffd0;
            border: 1px solid #215240;
            font-size: .9rem;
        }

        .content {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--card-shadow);
            padding: 24px;
        }

        .status {
            border: 1px solid #bde1cb;
            background: var(--ok-bg);
            color: var(--ok-text);
            border-radius: 12px;
            padding: 11px 14px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        h1, h2, h3 {
            font-family: "Newsreader", Georgia, serif;
            line-height: 1.2;
            margin: 0 0 10px;
        }

        h1 {
            font-size: clamp(1.9rem, 3.2vw, 2.7rem);
            color: #8acbff;
        }

        h2 {
            font-size: clamp(1.35rem, 2.4vw, 1.8rem);
            color: #95efc0;
            margin-top: 20px;
        }

        p {
            margin: 0 0 14px;
            color: var(--ink-muted);
        }

        a {
            color: var(--primary);
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        li {
            background: var(--bg-soft);
            border: 1px solid #233244;
            border-radius: 10px;
            padding: 12px 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--bg-soft);
            border: 1px solid #223243;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #1f2c39;
            vertical-align: top;
        }

        th {
            background: #112131;
            color: #b9ddff;
            font-size: .88rem;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        form {
            display: grid;
            gap: 12px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #cbe7ff;
            margin-bottom: 6px;
        }

        input,
        textarea,
        select,
        button {
            font: inherit;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #2b3f53;
            border-radius: 10px;
            padding: 10px 12px;
            background: #0d141c;
            color: #dff0ff;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3d7faf;
            box-shadow: 0 0 0 3px rgba(92, 182, 255, 0.22);
        }

        button {
            width: fit-content;
            border: 1px solid #1d6f56;
            background: linear-gradient(135deg, #3b95d8 0%, #38d381 100%);
            color: #08121a;
            border-radius: 10px;
            padding: 9px 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .16s ease, filter .16s ease;
        }

        button:hover {
            transform: translateY(-1px);
            filter: brightness(1.07);
        }

        @media (max-width: 720px) {
            .shell {
                margin-top: 14px;
                margin-bottom: 18px;
            }

            .content {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <a class="brand" href="{{ route('home') }}">Nothing</a>

            <nav class="top-nav">
                <a href="{{ route('certificates.index') }}">Certificates</a>
                <a href="{{ route('nfts.index') }}">NFTs</a>
                <a href="{{ route('donations.create') }}">Donate</a>
                <a href="{{ route('payments.index') }}">Payments</a>
                <a href="{{ route('my-nothing.show') }}">My Nothing</a>
                <a href="{{ route('subscriptions.index') }}">Subscriptions</a>
                <a href="{{ route('admin.stats.index') }}">Admin</a>
                <a href="{{ route('about-nothing') }}">About</a>
                <span class="spacer"></span>

                @auth
                    <span class="user-chip">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </header>

        <main class="content">
            @if (session('status'))
                <p class="status">{{ session('status') }}</p>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
