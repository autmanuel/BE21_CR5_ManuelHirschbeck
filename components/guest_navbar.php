<?php



$rootFolder = $_SERVER['DOCUMENT_ROOT'];
    $basePath = (basename(__DIR__) === $rootFolder) ? '' : '../';
$navbar =
    "
    <nav class='navbar navbar-expand-lg bg-dark navbar-dark'>
    <div class='container-fluid'>
        <a class='navbar-brand' href='{$basePath}index.php'>Home
        </a>
        <li class='nav-item'>
        <a class='navbar-brand' href='{$basePath}index.php?filter=senior'>Senior Pets</a>
        </li>
        <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
        <a class='nav-link' href='{$basePath}user/register.php'>Register</a>
        </li>
        <li class='nav-item'>
<a class='nav-link' href='{$basePath}user/login.php'>Login</a>
</li>
</ul>
</div>
</nav>";
