
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div class="page__toolbar--left">
			<h1 class="mods--title"><?= $title; ?></h1>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div class="">
			<a href="<?= base_url('admin/menu'); ?>" onclick="return confirm('Are you want to cancel this form?');" class="btn btn-sm btn-secondary">Cancel</a>
			<a class="btn btn-sm btn-primary" onclick="$('#addmenu').submit();">Add</a>
		</div>
	</div>
	

	<div class="page__content mt-10">

		<?php if(session()->getFlashdata('alert')) { ?>
			<div class="alert alert-warning">
			<?= session()->getFlashdata('alert'); ?>
			</div>
		<?php } ?>
		
		<form id="addmenu" name="addmenu" action="" method="post" class="form-group top-label">
		<input type="hidden" name="publish" id="publish" value="1" />
		<div class="d-flex justify-center">
			<div class="col-8-12">
			<div class="card mb-20">
				<div class="card--body">
					<div class="field-group">
						<label class="">Name</label>
						<input type="text" class="input-text input-block" name="name" value="" />
					</div>
					<div class="field-group">
						<label class="">Description</label>
						<textarea class="input-text input-block" name="description"></textarea>
					</div>
				</div>
			</div>

			</div>
		</div>
		</form>
	</div>
<?= $this->endSection() ?>
