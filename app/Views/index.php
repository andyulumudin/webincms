<?php 
$request = \Config\Services::request(); 
$uri = $request->uri;
$mod = $uri->getSegment(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebinCMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <?= $this->renderSection('head') ?>
    <style>
    <?= include('assets/css/style.css'); ?>
    </style>
</head>
<body class="bg-light">
    <?= view('appbar'); ?>
    <main id="main" class="<?= in_array($mod, array('post','page','media','template','menu','widget','setting','files','users','user','profile'))?'active':''; ?>">
        <div id="main__content" class="main__content">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script>
        const openAppMenu = function(t, menu, title) {
            $('.app__menu a').removeClass('active');
            $('.app__user a').removeClass('active');
            $(t).addClass('active');
            $('#sidebar').addClass('active');
            $('#main').addClass('active');
            $('.sidebar__nav--wrapper').removeClass('active');
            $('#'+menu).addClass('active');
            $('.sidebar--title').text(title);
        }
        const closeAppMenu = function() {
            $('#sidebar').removeClass('active');
            $('#main').removeClass('active');
            $('.app__menu a').removeClass('active');
            $('.app__user a').removeClass('active');
        }
        $(document).ready(function() {
            $('.dropdown-link').on('click', function() {
                var top = $(this).parent();
                var menu = top.children('.dropdown-menu');

                if(menu.hasClass('active')) {
                    menu.removeClass('active');
                } else {
                    $('.dropdown-menu').removeClass('active');
                    menu.addClass('active');
                }
                return false;
            })
        });
    </script>
    <?= $this->renderSection('script') ?>
</body>
</html>