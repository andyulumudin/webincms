
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			<h3 class="mods--title"><?= $title; ?></h3>
		</div>
		
	</div>

	<div class="page__content">
		<?php if(session()->getFlashdata('alert')) { ?>
			<div class="alert alert-warning">
			<?= session()->getFlashdata('alert'); ?>
			</div>
		<?php } ?>

		<div class="card col-6-12">
			<div class="card--header">
				Add User
			</div>
			<form name="edituser" action="" method="post" class="form-group top-label">
			<input type="hidden" name="user_id" value="<?= $user['user_id']; ?>" />
			<div class="card--body">
				<div class="field-group">
					<label class="">User Name</label>
					<input type="text" class="input-text" name="user_name" value="<?= $user['user_name']; ?>" />
				</div>
				<div class="field-group">
					<label class="">User Email</label>
					<input type="text" class="input-text" name="user_email" value="<?= $user['user_email']; ?>" />
				</div>
				<div class="field-group">
					<label class="">User Account</label>
					<input type="text" class="input-text" readonly value="<?= $user['user_account']; ?>" />
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