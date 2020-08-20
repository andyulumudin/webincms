<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebinCMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <!-- <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'> -->
    <link href='<?= base_url('admin/assets/css/style.css'); ?>' rel='stylesheet'>
    <style>
    <?= include('assets/css/style.css'); ?>
    </style>
</head>
<body class="bg-light">
    <?= view('appbar'); ?>
    <main id="main">
        <div id="main__content" class="main__content">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script>
        const openAppMenu = function(menu, title) {
            $('#sidebar').addClass('active');
            $('.sidebar__nav--wrapper').removeClass('active');
            $('#'+menu).addClass('active');
            $('.sidebar--title').text(title);
        }
        const closeAppMenu = function() {
            $('#sidebar').removeClass('active');
        }
    </script>
</body>
</html>