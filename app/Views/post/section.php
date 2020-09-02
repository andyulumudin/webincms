<?= $this->extend('modal') ?>

<?= $this->section('content') ?>
<table class="table table-border">
	<?php 
	if($sections) {
	foreach($sections as $section) {
	?>
	<tr>
		<td><?= $section['role_name'] ?></td>
		<td width="30"><a href="javascript:;">Edit</a></td>
		<td width="30"><a href="<?= base_url(ADMINURL.'/post/deletesection/'.$section['role_id']); ?>" onclick="return confirm('Are you sure want to delete this section?');">Delete</a></td>
	</tr>
	<?php }} ?>
</table>

<form class="mt-20" action="<?= base_url(ADMINURL.'/post/addsection'); ?>" method="post">
	<div class="mt-10 input-group">
		<input type="text" name="name" class="input-text input-fblock" placeholder="Name" value="" required />
		<button type="submit" class="btn btn-primary">ADD</button>
	</div>
</form>
<?= $this->endSection() ?>