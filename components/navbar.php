
<?php

if (isset($_SESSION["adm"])) {
    $basePath = (basename(__DIR__) === 'products') ? '' : '../';

    $navbar = "
<nav class='navbar navbar-expand-lg bg-dark navbar-dark'>
    <div class='container-fluid'>
        <a class='navbar-brand' href='{$basePath}user/updateprofile.php'>
        <img src='{$basePath}pictures/{$row['picture']}' alt='profile-img' width='30' height='24'>
        </a>
        <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
            <li class='nav-item'>
                <a class='navbar-brand' href='{$basePath}products/dashboard.php'>
                    Animal CRUD
                </a>
            </li>
            <li class='nav-item'>
                <a class='navbar-brand' href='{$basePath}products/create.php'>
                    Create
                </a>
            </li>
            <li class='nav-item'>
                <a class='navbar-brand' href='{$basePath}products/dashboard.php?filter=senior'>
                    Senior animals
                </a>
            </li>
            <li class='nav-item'>
                <a class='navbar-brand' href='{$basePath}user/updateprofile.php'>
                    Update profile
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='{$basePath}user/logout.php?logout'>Logout</a>
            </li>
        </ul>
    </div>
</nav>";
} else if (isset($_SESSION["user"])) {
    $basePath = (basename(__DIR__) === 'user') ? '' : '../';
    $navbar = "
    <nav class='navbar navbar-expand-lg bg-dark navbar-dark'>
    <div class='container-fluid'>
    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <a class='navbar-brand' href='{$basePath}user/updateprofile.php'>
        <img src='{$basePath}pictures/{$row['picture']}' alt='profile-img' width='30' height='24'>
        </a>
    <li class='nav-item'>
        <a class='navbar-brand' href='{$basePath}user/home.php'>
        Pets
        </a>
    </li>
    
<li class='nav-item'>
    <a class='navbar-brand' href='{$basePath}user/home.php?filter=senior'>Senior Pets</a>
</li>
    <li class='nav-item'>
        <a class='navbar-brand' href='{$basePath}user/updateprofile.php'>
                Update profile
        </a> 
    </li>
<li class='nav-item'>
    <a class='nav-link' href='{$basePath}user/logout.php?logout'>Logout</a>
</li>
</ul>
</div>
</nav>
<h2 class='text-center'>Logged in as {$row['email']}</h2>";

} else {
    $rootFolder = $_SERVER['DOCUMENT_ROOT'];
    $basePath = (basename(__DIR__) === $rootFolder) ? '' : '../';
    $navbar = "
    <nav class='navbar navbar-expand-lg bg-dark navbar-dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='/index.php'>
            Pet Adoption
            </a>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
            <li class='nav-item'>
    <a class='nav-link' href='{$basePath}user/login.php'>Login</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='{$basePath}user/register.php'>Register</a>
    </li>
    
    <a class='nav-link' href='{$basePath}index.php?filter=senior'>Senior</a>


    </ul>
</div>
</nav>";
}


$login_register_nav =
    "
    <nav class='navbar navbar-expand-lg bg-dark navbar-dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='../index.php'>
            Home
            </a>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
            <li class='nav-item'>
    <a class='nav-link' href='login.php'>Login</a>
    </li>
    <li class='nav-item'>
    <li class='nav-item'>
    <a class='nav-link' href='home.php?filter=senior'>Senior</a>
</li>
    <a class='nav-link' href='register.php'>Register</a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='./index.php?filter=senior'>Senior pets</a>
</li>
    </ul>
</div>
</nav>";
// if (isset($_SESSION["adm"])) {
// $nav_adm_in_user = "
// <nav class='navbar navbar-expand-lg bg-dark navbar-dark'>
//         <div class='container-fluid'>
//             <a class='navbar-brand' href='#'>
//             <img src='../pictures/{$row['picture']}' alt='profile-img' width='30' height='24'>
//             </a>
//             <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
//     <a class='navbar-brand' href='../dashboard.php'>
//     Product Dashboard</a>
//     <a class='navbar-brand' href='../create.php'>
//     Add Product</a>
//     <a class='nav-link' href='../dashboard.php?filter=senior'>Senior</a>

//     <a class='navbar-brand' href='updateprofile.php'>
//                 Update profile
//             </a>
//     <li class='nav-item'>
//     <a class='nav-link' href='logout.php?logout'>Logout</a>
// </li>
// </ul>
// </div>
// </nav>
// ";
// }