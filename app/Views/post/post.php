
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			<h3 class="mods--title"><?= $title; ?></h3>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div>
			<a data-fancybox data-type="iframe" href="<?= base_url(ADMINURL.'/post/section'); ?>" class="btn btn-sm btn-secondary">Section</a>
			<a href="<?= base_url('admin/post/add'); ?>" class="btn btn-sm btn-primary ml-5">Add Post</a>
		</div>
	</div>

	<div class="page__header">
		
	</div>
	<div class="page__content mt-10">
	<?php if(session()->getFlashdata('info')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('info'); ?>
		</div>
	<?php } ?>
	<table class="card-table">
		<tbody>
			<?php foreach($posts as $post) { ?>
			<tr>
				<td width="40"><img src="<?= base_url('admin/assets/img/pexels-pixabay-220453.jpg'); ?>" class="avatar avatar-sm" /></td>
				<td width="150"><strong><?= $post['content_publish_date']; ?></strong></td>
				<td><span class="label label-secondary">Post</span> <?= $post['content_title']; ?></td>
				<td width="10">
					<div class="dropdown">
						<a href="#" class="dropdown-link action-link"><i class='bx bx-dots-vertical-rounded'></i></a>
						<div class="dropdown-menu right">
							<a class="dropdown-item" href="<?= base_url('admin/post/edit/'.$post['content_id']); ?>">Edit</a>
							<a class="dropdown-item" href="<?= base_url('admin/post/delete/'.$post['content_id']); ?>" onclick="return confirm('Are you want to delete this data?');">Hapus</a>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
	
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<?= $this->endSection() ?>