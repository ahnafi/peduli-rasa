<?php
$title = $model["title"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title . " | " ?? "" ?>PeduliRasa</title>
    <!-- sweat alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php use PeduliRasa\App\Flasher; Flasher::FLASH(); ?>