
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			
		</div>
		<div>
			<a href="<?= base_url('admin/user/add'); ?>" class="btn btn-sm btn-primary">Add User</a>
		</div>
	</div>

	<div class="page__header">
		<h1 class="page--title"><?= $title; ?></h1>
		<div class="page--subtitle"><?= $subtitle; ?></div>
	</div>
	<div class="page__content mt-0">
	<?php if(session()->getFlashdata('info')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('info'); ?>
		</div>
	<?php } ?>
	<table class="card-table">
		<tbody>
			<?php foreach($users as $user) { ?>
			<tr>
				<td width="40"><img src="<?= base_url('admin/assets/img/pexels-pixabay-220453.jpg'); ?>" class="avatar avatar-sm" /></td>
				<td width="150"><strong><?= $user['user_name']; ?></strong></td>
				<td><span class="label label-secondary">Admin</span> <?= $user['user_email']; ?></td>
				<td width="10">
					<div class="dropdown">
						<a href="#" class="dropdown-link action-link"><i class='bx bx-dots-vertical-rounded'></i></a>
						<div class="dropdown-menu right">
							<a class="dropdown-item" href="<?= base_url('admin/user/edit/'.$user['user_id']); ?>">Edit</a>
							<a class="dropdown-item" href="<?= base_url('admin/user/delete/'.$user['user_id']); ?>" onclick="return confirm('Are you want to delete this data?');">Hapus</a>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>

	
<?= $this->endSection() ?>