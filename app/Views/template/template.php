
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			<h3 class="mods--title"><?= $title; ?></h3>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div>

		</div>
	</div>

	<div class="d-flex">
	<div class="page__content mt-10 flex-grow">
	<?php if(session()->getFlashdata('alert')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('alert'); ?>
		</div>
	<?php } ?>
	<div class="d-flex">
		<?php foreach($themes as $theme) { ?>
		<div class="col-4-12 mb-10 px-10">
		<div class="card">
		<div class="card--body align-center">
			<div class="theme-image"><img src="<?= base_url('asset/'.$theme.'/preview.png'); ?>" class="img-fluid" /></div>
			<div class="theme-info d-flex justify-between">
				<h4><?= themeInfo($theme, 'name'); ?></h4>
				<div><a class="btn btn-primary btn-sm" href="<?= base_url(ADMINURL.'/template/'.$theme); ?>">Customize</a></div>
			</div>
		</div>
		</div>
		</div>
		<?php } ?>
	</div>
	</div>
	<?php if(isset($detail)) { ?>
	<div class="file__detail">
		<h3>Customize</h3>
		<div class="mt-20">
			<form name="customize" action="<?= base_url(ADMINURL.'/template/update'); ?>" method="post">
			<input type="hidden" name="theme" value="<?= $detail['theme']; ?>" />
			<div>
			<div><small>HEADER (before &lt;/head&gt;)</small></div>
			<div><textarea class="input-text" name="header" rows="8"><?= $detail['header']; ?></textarea></div>
			</div>
			<div class="mt-10">
			<div><small>FOOTER (before &lt;/body&gt;)</small></div>
			<div><textarea class="input-text" name="footer" rows="8"><?= $detail['footer']; ?></textarea></div>
			</div>
			<button type="submit" class="btn btn-sm btn-primary">Save</button>
			</form>
		</div>
	</div>
	<?php } ?>
	</div>

<?= $this->endSection() ?>