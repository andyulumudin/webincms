<?= $this->extend('modal') ?>

<?= $this->section('content') ?>
<form name="updatemenuitem" action="<?= base_url(ADMINURL.'/menu/updateitem'); ?>" method="post">
	<input type="hidden" name="menu_id" value="<?= $menu['menu_id']; ?>" />
	<div class="mt-10">
		<label><small>MENU TITLE</small></label>
		<input type="text" name="menu_item_title" class="input-text input-block" placeholder="Title" value="<?= $menu['menu_title']; ?>" required />
	</div>
	<div class="mt-10">
	<label><small>MENU DESCRIPTION</small></label>
	<textarea name="menu_item_description" class="input-text input-block" placeholder="Description"><?= $menu['menu_description']; ?></textarea></div>
	<div class="mt-10">
		<label><small>MEDIA</small></label>
		<select name="menu_item_url" class="input-text input-block">
			<option value="">Select Media</option>
			<?php 
			if($medias) {
			foreach($medias as $media) {
			?>
			<option value="<?= $media['content_slug'] ?>" <?= $media['content_slug'] == $menu['menu_url']?'selected':''; ?>><?= $media['content_title'] ?></option>
			<?php }} ?>
		</select>
	</div>
	<div class="mt-10 align-right">
		<button type="button" class="btn btn-secondary" onclick="parent.jQuery.fancybox.close();">CANCEL</button>
		<button type="submit" class="btn btn-primary">UPDATE ITEM</button>
	</div>
</form>
<?= $this->endSection() ?>