
<?= $this->extend('index') ?>

<?= $this->section('content') ?>
	<div class="page__header">
		<h1 class="page--title"><?= $title; ?></h1>
		<div class="page--subtitle"><?= $subtitle; ?></div>
	</div>
	<div class="page__content mt-10">
	<div class="widget__wrap">
		<div class="card col-6-12">
			<div class="card--header">
				News
			</div>
			<form name="updateprofile" action="" method="post" class="from-group top-label">
			<div class="card--body">
				<?php if(session()->getFlashdata('alert')) { ?>
                    <div class="alert alert-warning"><?= session()->getFlashdata('alert'); ?></div>
				<?php } ?>
				
				<div class="field-group">
					<label class="">User Name</label>
					<input type="text" class="input-text" name="user_name" value="<?= $user[0]['user_name']; ?>" />
				</div>
				<div class="field-group">
					<label class="">User Email</label>
					<input type="text" class="input-text" name="user_email" value="<?= $user[0]['user_email']; ?>" />
				</div>
				<div class="field-group">
					<label class="">User Account</label>
					<input type="text" class="input-text" value="<?= $user[0]['user_account']; ?>" readonly />
				</div>
				<div class="field-group">
					<label class="">Password</label>
					<input type="password" class="input-text" value="" name="password" />
				</div>
				<div class="field-group">
					<label class="">Retype Password</label>
					<input type="password" class="input-text" value="" name="pass_confirm" />
				</div>
			</div>
			<div class="card--footer">
				<button type="submit" class="btn btn-secondary">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			</form>
		</div>
	</div>

	</div>

	
<?= $this->endSection() ?>