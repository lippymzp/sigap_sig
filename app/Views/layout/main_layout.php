<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'SIGAP' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/">SIGAP</a>
    </div>
</nav>

<!-- CONTENT -->
<?= $this->renderSection('content') ?>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3 mt-5">
    © <?= date('Y') ?> SIGAP
</footer>

</body>
</html>