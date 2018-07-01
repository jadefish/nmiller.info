<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - nmiller.info</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a class="brand" href="/" rel="nofollow">nmiller.info</a></li>
                <li class="hidden-xs"><a href="/projects">Projects</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <hr>
    <footer>
        <div class="footer-left">
            <span>&copy; 2017 - {{ date('Y') }} Nick Miller</span>
        </div>
        <div class="footer-right">
            <a href="https://github.com/jadefish/nmiller.info" class="github-link"><img src="/images/github.png" alt="GitHub logo"></a>
        </div>
    </footer>
</body>
</html>