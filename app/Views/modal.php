<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?= isset($title)?$title:'Detail Link'; ?></title>
    <style>
    <?= include('assets/css/style.css'); ?>
    </style>
	<style>
    body {
        margin: 0;
        max-width: 400px;
        padding: 0;
    }
	</style>
</head>

<body>
	<div class="modal--wrapper">
		<h3 class="modal--header"><?= isset($title)?$title:'Detail Link'; ?></h3>
		<div class="modal--body">
        <?= $this->renderSection('content') ?>
		</div>
	</div>
</body>
</html>