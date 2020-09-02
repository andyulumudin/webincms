
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div class="page__toolbar--left">
			<h1 class="mods--title"><?= $title; ?></h1>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div class="">
			<a onclick="return confirm('Are you want to cancel this form?');" class="btn btn-sm btn-secondary" onclick="$('#publish').val(0);$('#addmedia').submit();">Draft</a>
			<a class="btn btn-sm btn-primary" onclick="$('#addmedia').submit();">Save</a>
		</div>
	</div>
	

	<div class="page__content mt-10">

		<?php if(session()->getFlashdata('alert')) { ?>
			<div class="alert alert-warning">
			<?= session()->getFlashdata('alert'); ?>
			</div>
		<?php } ?>
		
		<form id="addmedia" name="addmedia" action="" method="post" class="form-group top-label">
		<input type="hidden" name="publish" id="publish" value="1" />
		<div class="d-flex justify-between">
			<div class="col-8-12">
			<div class="card mb-20">
				<div class="card--body">
					<div class="field-group">
						<label class="">Title</label>
						<input type="text" class="input-text input-block" name="title" value="" />
					</div>
					<div class="field-group">
						<label class="">Body</label>
						<textarea id="summernote" class="input-text editor" name="body"></textarea>
					</div>
				</div>
			</div>

			</div>
			<div class="col-4-12 pl-20">
				<div class="card mb-20">
					<div class="card--header">
						Language
					</div>
					<div class="card--body">
						<select class="input-text" name="language">
							<option value="">All Language</option>
							<option value="id">Indonesia</option>
							<option value="en">English</option>
						</select>
					</div>
				</div>
				<div class="card mb-20">
					<div class="card--header">
						Featured Image
					</div>
					<div class="card--body align-center">
						<a href="#" class="btn btn-sm btn-info">Select Image</a>
					</div>
				</div>
				<div class="card mb-20">
					<div class="card--header">
						Tags
					</div>
					<div class="card--body">
					<input type="text" class="input-text input-block" name="tags" value="" />
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote({
        placeholder: 'Write your media here',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
<?= $this->endSection() ?>