
<?= $this->extend('index') ?>

<?= $this->section('content') ?>
	<div class="page__header">
		<h1 class="page--title"><?= $title; ?></h1>
		<div class="page--subtitle"><?= $subtitle; ?></div>
	</div>
	<div class="page__content d-flex justify-between">
		<div class="card">
			<div class="card--header">
				News
			</div>
			<div class="card--body">
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
			</div>
		</div>
		<div class="card">
			<div class="card--header">
				News
			</div>
			<div class="card--body">
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
			</div>
		</div>
		<div class="card">
			<div class="card--header">
				News
			</div>
			<div class="card--body">
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
				News list<br/>
			</div>
		</div>
	</div>
<?= $this->endSection() ?>