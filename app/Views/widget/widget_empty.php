
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

	<div class="page__content mt-10">

	<?php if(session()->getFlashdata('alert')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('alert'); ?>
		</div>
	<?php } ?>

	<div class="col-6-12 mx-auto">
		<div class="card">
			<div class="card--body align-center">
				<h3>Please select widget position</h3>
				<div class="mt-20">
				<?php foreach($positions as $position) { ?>
				<a class="btn btn-block btn-warning mb-10 d-block" href="<?= base_url(ADMINURL.'/widget/default/'.$position['value']); ?>"><?= $position['name'] ?></a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>

	</div>

<?= $this->endSection() ?>