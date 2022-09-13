<?php

$section = $_GET['section'] ?? 'home';


if ($section === 'about-us') {
    include 'controller/AboutUsPage.php';
} else if ($section === 'contact') {
    include 'controller/ContactPage.php';
} else {
    include 'controller/HomePage.php';
}



