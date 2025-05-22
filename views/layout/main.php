<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Challenge Magazord</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" href="/assets/img/favicon.png" type="image/png">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="navbar">
            <div class="navbar-content">
                <div class="navbar-left">
                    <img src="/assets/img/logo-braavo.png" alt="Logo" class="logo-img">
                    <span class="title">Challenge Magazord</span>
                </div>
                <nav class="nav-links">
                    <a href="/?page=home">Home</a>
                    <a href="/?page=person">People</a>
                    <a href="/?page=contact">Contacts</a>
                </nav>
            </div>
        </header>

        <!-- Conteúdo principal -->
        <main class="main-content">
            <?php if (isset($viewFile)) include $viewFile; ?>
        </main>

        <!-- Rodapé -->
        <footer class="footer">
            &copy; <?= date('Y') ?> Challenge Magazord
        </footer>
    </div>
</body>
</html>
