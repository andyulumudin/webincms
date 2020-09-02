
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			<h3 class="mods--title"><?= $title; ?></h3>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div>
		<form class="invisible" name="uploadfiles" action="<?= base_url(ADMINURL.'/files/upload'); ?>" method="post" enctype="multipart/form-data">
		<input type="file" class="file-upload" name="webfile" onchange="this.form.submit();" />
		</form>
		<a href="javascript:;" class="btn btn-sm btn-primary btn-upload">Upload</a>
		</div>
	</div>

	<div class="d-flex">
	<div class="page__content mt-10 flex-grow">
	<?php if(session()->getFlashdata('alert')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('alert'); ?>
		</div>
	<?php } ?>
	<div class="d-flex flex-wrap">
		<?php foreach($files as $file) { ?>
		<div class="col-4-12 mb-30 px-10">
		<div class="card">
		<div class="card--body align-center">
			<div>
				<?php if($file['file_type'] == 'image') { ?>
				<img src="<?= base_url('upload/'.$file['file_name']); ?>" class="img-fluid" />
				<?php } else { ?>
					<img src="<?= base_url('document.svg'); ?>" class="img-fluid" />
				<?php } ?>
			</div>
			<div><span class="label label-secondary"><?= $file['file_type']; ?></span></div>
			<div class=""><a href="?id=<?= $file['file_id']; ?>"><?= ellipsize($file['file_name'], 20, .5); ?></a></div>
		</div>
		</div>
		</div>
		<?php } ?>
	</div>
	</div>
	<?php if(isset($detail)) { ?>
	<div class="file__detail">
		<h3><?= $detail['file_name']; ?></h3>
		<div class="mt-20">
			<div>
			<div><small>UPLOADED AT</small></div>
			<h4><?= $detail['created_at']; ?></h4>
			</div>
			<div class="mt-10">
			<div><small>FILE TYPE</small></div>
			<h4><?= strtoupper($detail['file_type']); ?></h4>
			</div>
			<div class="mt-10">
			<div><small>MIME TYPE</small></div>
			<h4><?= strtoupper($detail['file_mime_type']); ?></h4>
			</div>
		</div>
	</div>
	<?php } ?>
	</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$().ready(function() {
	$('.btn-upload').on('click', function() {
		$('.file-upload').click();
	})
})
</script>
<?= $this->endSection() ?>