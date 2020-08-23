
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__header">
		<h1 class="page--title"><?= $title; ?></h1>
		<div class="page--subtitle"><?= $subtitle; ?></div>
	</div>

	<div class="page__content mt-10">

		<?php if(session()->getFlashdata('info')) { ?>
			<div class="alert alert-warning">
			<?= session()->getFlashdata('info'); ?>
			</div>
		<?php } ?>

		<div class="card col-6-12">
			<div class="card--header">
				Add User
			</div>
			<form name="adduser" action="" method="post" class="form-group top-label">
			<div class="card--body">
				<div class="field-group">
					<label class="">User Name</label>
					<input type="text" class="input-text" name="user_name" value="<?= set_value('user_name'); ?>" />
				</div>
				<div class="field-group">
					<label class="">User Email</label>
					<input type="text" class="input-text" name="user_email" value="<?= set_value('user_email'); ?>" />
				</div>
				<div class="field-group">
					<label class="">User Account</label>
					<input type="text" class="input-text" name="user_account" value="<?= set_value('user_account'); ?>" />
				</div>
				<div class="field-group">
					<label class="">User Password</label>
					<input type="password" class="input-text" name="password" />
				</div>
				<div class="field-group">
					<label class="">Retype Password</label>
					<input type="password" class="input-text" name="pass_confirm" />
				</div>
			</div>
			<div class="card--footer">
				<a href="<?= base_url('admin/users'); ?>" onclick="return confirm('Are you want to cancel this form?');" class="btn btn-secondary">Cancel</a>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
		</div>
	</div>

	
<?= $this->endSection() ?>