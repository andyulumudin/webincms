
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div class="page__toolbar--left">
			<h1 class="mods--title"><?= $title; ?></h1>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div class="">
			<a class="btn btn-sm btn-primary" onclick="$('#savesetting').submit();">Save</a>
		</div>
	</div>
	

	<div class="page__content mt-10">

		<?php if(session()->getFlashdata('alert')) { ?>
			<div class="alert alert-warning">
			<?= session()->getFlashdata('alert'); ?>
			</div>
		<?php } ?>
		
		<form id="savesetting" name="savesetting" action="<?= base_url(ADMINURL.'/setting/save'); ?>" method="post" class="form-group top-label">
		<div class="d-flex justify-between">
			<div class="col-8-12">
			<div class="card mb-20">
				<div class="card--body">
					<div class="field-group">
                        <label class="">Admin URL</label>
                        <div class="input-group">
                            <span><?= BASEURL; ?></span>
                            <input type="text" class="input-text input-block" required name="admin_url" value="<?= ADMINURL; ?>" />
                        </div>
					</div>
				</div>
			</div>
			<div class="card mb-20">
				<div class="card--body">
					<div class="field-group">
						<label class="">Website Title</label>
						<input type="text" class="input-text input-block" name="website_title" value="<?= setting('website_title'); ?>" />
					</div>
					<div class="field-group">
						<label class="w-100">Website Description</label>
						<textarea class="input-text input-block" name="website_description"><?= setting('website_description'); ?></textarea>
					</div>
				</div>
			</div>

			<div class="card mb-30">
				<div class="card--body">
					<div class="field-group">
						<label class="">Website Meta Title</label>
						<input type="text" class="input-text input-block" name="website_meta_title" value="<?= setting('website_meta_title'); ?>" />
					</div>
					<div class="field-group">
						<label class="w-100">Website Meta Description</label>
						<textarea class="input-text input-block" name="website_meta_desc"><?= setting('website_meta_desc'); ?></textarea>
					</div>
				</div>
			</div>

			<div class="card mb-30">
				<div class="card--body">
					<div class="field-group">
						<label class="">Footer Copyright</label>
						<input type="text" class="input-text input-block" name="footer_copyright" value="<?= setting('footer_copyright'); ?>" />
					</div>
					<div class="field-group">
						<label class="w-100">Footer Description</label>
						<textarea class="input-text input-block" name="footer_description"><?= setting('footer_description'); ?></textarea>
					</div>
				</div>
			</div>
			</div>
			<div class="col-4-12 pl-20">
				<div class="card mb-20">
					<div class="card--header">
						Default Language
					</div>
					<div class="card--body">
						<select class="input-text" name="default_language">
                            <option value="en">English</option>
                            <option value="id">Indonesia</option>
                        </select>
					</div>
				</div>
				<div class="card mb-20">
					<div class="card--header">
						Default Image
					</div>
					<div class="card--body align-center">
						<a href="#" class="btn btn-sm btn-info">Select Image</a>
					</div>
				</div>
				<div class="card mb-20">
					<div class="card--header">
						Contact Information
					</div>
					<div class="card--body">
						<div><input type="text" class="input-text mb-10" name="contact_hotline" placeholder="Hotline Number" value="<?= setting('contact_hotline'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="contact_phone" placeholder="Phone Number" value="<?= setting('contact_phone'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="contact_fax" placeholder="Fax Number" value="<?= setting('contact_fax'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="contact_email" placeholder="Email Address" value="<?= setting('contact_email'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="contact_address" placeholder="Address" value="<?= setting('contact_address'); ?>" /></div>
					</div>
				</div>
				<div class="card mb-20">
					<div class="card--header">
						Social Media
					</div>
					<div class="card--body">
						<div><input type="text" class="input-text mb-10" name="social_facebook" placeholder="Facebook" value="<?= setting('social_facebook'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="social_twitter" placeholder="Twitter" value="<?= setting('social_twitter'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="social_instagram" placeholder="Instagram" value="<?= setting('social_instagram'); ?>" /></div>
						<div><input type="text" class="input-text mb-10" name="social_youtube" placeholder="Youtube" value="<?= setting('social_youtube'); ?>" /></div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>

<?= $this->endSection() ?>

<?= $this->section('head') ?>

<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>