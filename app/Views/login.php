<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebinCMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style>
    <?= include('assets/css/login.css'); ?>
    </style>
</head>
<body>
    <div class="form-container">
        <div class="banner-wrapper" style="background-image:url('<?= base_url('admin/assets/img/pexels-athena-2582937.jpg'); ?>');">
            
        </div>
        <div class="form-wrapper">
            <div class="registration-form">
                <h3 class="form-title">WebinCMS</h3>
                <p class="form-text">Login to your admin account.</p>
                <?php if(session()->getFlashdata('alert')) { ?>
                    <div class="alert alert-warning"><?= session()->getFlashdata('alert'); ?></div>
                <?php } ?>
                <form name="logingorm" action="<?= base_url('admin/auth'); ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" name="username" class="input-text" placeholder="Username" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="input-text" placeholder="Password" value="" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-submit">Login</button>
                    </div>
                    <div class="form-group">
                        <p class="fw-light"><small>If you have a problem, please contact administrator.</small></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>