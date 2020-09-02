
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			<h3 class="mods--title"><?= $title; ?></h3>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div>
		<div class="d-flex">
		<select class="input-text input-sm mt-5" name="menu" onchange="menuselect(this.value);">
			<?php foreach($menus as $menu) { ?>
			<option value="<?= $menu['role_id'] ?>" <?= $menu['role_id'] == setting('default_menu')?'selected':''; ?>><?= $menu['role_name'] ?></option>
			<?php } ?>
			<option value="new">Create New Menu</option>
		</select>
		<a href="<?= base_url(ADMINURL.'/menu/delete/'.$menu['role_id']); ?>" class="btn btn-sm btn-secondary btn-menu-select ml-5" onclick="return confirm('Are you sure want to delete this menu?');">DELETE</a>
		<a href="javascript:;" class="btn btn-sm btn-primary btn-menu-select ml-5" onclick="savemenu()">SAVE</a>
		</div>
		</div>
	</div>

	<div class="page__content mt-10">

	<?php if(session()->getFlashdata('alert')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('alert'); ?>
		</div>
	<?php } ?>

	
	<form class="menuupdate" name="menuupdate" action="<?= base_url(ADMINURL.'/menu/update'); ?>" method="post">
	<input type="hidden" name="role_id" value="<?= $detail['role_id']?>" />
	<div class="d-flex">
	<div class="col-4-12">
	<div class="card">
	<div class="card--body">
		<h3>Detail Menu</h3>
		<?php if(isset($detail)) { ?>
		<div class="mt-20">
			<div>
			<div><small>MENU NAME</small></div>
			<div>
				<input type="text" name="menu_name" class="input-text" value="<?= $detail['role_name']; ?>" />
			</div>
			</div>
			<div class="mt-10">
			<div><small>MENU DESCRIPTION</small></div>
			<div>
				<textarea name="menu_description" class="input-text"><?= $detail['role_description']; ?></textarea>
			</div>
			</div>
			<div class="mt-10">
			<div><small>MENU POSITION</small></div>
			<div class="mt-10">
				<?php 
				if(isset($positions)) { 
				foreach($positions as $position) {
				?>
				<label class="d-block mt-5"><input type="checkbox" name="menu_position[]" value="<?= $position['position_value']; ?>" <?= in_array($position['position_value'], $relations)?'checked':''; ?> /> <?= $position['position_name']; ?></label>
				<?php }} ?>
			</div>
			</div>
		</div>
		<?php } ?>
	</div>
	</div>
	</div>

	<div class="col-8-12 pl-10">
	<div class="sortable-wrapper nested nested-sortable">
		<?php
		if($items && count($items) > 0) {
		foreach($items as $item) {
		$parent = $item['menu_parent'];
		$data[$parent][] = $item;
		}
		echo menuItem($data, 0);
		} ?>
		<div class="additem-wrap">
			<a class="add-menu-item" data-fancybox="additem" data-src="#additem" href="javascript:;"><i class='bx bxs-plus-circle'></i></a>
		</div>
	</div>
	</div>
	</div>
	</form>

	</div>

	<form id="additem" class="modal--wrapper" action="<?= base_url(ADMINURL.'/menu/additem'); ?>" method="post" style="display: none;width:100%;max-width:400px;padding:0px;">
	<input type="hidden" name="role_id" value="<?= setting('default_menu'); ?>" />
		<h2 class="mb-10 modal--header">Add Menu Item</h2>
		<div class="modal--body">
        <div>
			<select class="input-text input-block" name="menu_item_type" required>
				<option value="">Select Type</option>
				<option value="link">Custom Link</option>
				<option value="post">Post</option>
				<option value="page">Page</option>
				<option value="media">Media</option>
			</select>
		</div>
        <div class="mt-10"><input type="text" name="menu_item_title" class="input-text input-fblock" placeholder="Title" value="" required /></div>
		<div class="mt-10"><textarea name="menu_item_description" class="input-text input-fblock" placeholder="Description"></textarea></div>
		<div class="mt-10 align-right">
			<button type="button" class="btn btn-secondary" data-fancybox-close>CANCEL</button>
			<button type="submit" class="btn btn-primary">ADD ITEM</button>
		</div>
		</div>
    </form>

<?= $this->endSection() ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<style>
.sortable-wrapper {
	display: block;
}
.sortable-item {
    position: relative;
	display: flex;
	align-items: center;
	justify-content: space-between;
	width: 300px;
	background-color: #ffffff;
	border-radius: 3px;
	border: 1px solid #cccccc;
	height: 40px;
	padding: 0 10px;
}
.sortable-subgroup {
	padding-top: 10px;
	margin-left: 30px;
	display: block;
}
.sortable-chosen {
	
}
.sortable-ghost .sortable-item {
	border: 2px dashed #aaaaaa;
}
.sortable-ghost .sortable-item,
.sortable-ghost .sortable-item a {
	color: transparent;
	background: transparent;
}
.sortable-handle {
	font-size: 1.3rem;
	padding-right: 5px;
}
.sortable-name {
	
}
.add-menu-item {
    border: 1px dashed #999999;
    display: flex;
    width: 300px;
	height: 40px;
	justify-content: center;
	align-items: center;
	font-size: 1.7rem;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://sortablejs.github.io/Sortable/Sortable.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
function savemenu() {
	$('.menuupdate').submit();
}
function menuselect(v) {
	if(v == 'new') {
		window.location.href = "<?= base_url(ADMINURL.'/menu/add'); ?>";
	} else {
		window.location.href = "<?= base_url(ADMINURL.'/menu/default'); ?>/"+v;
	}
}
function menuparent() {
	$('.sortable-item').each(function(index){
		$par = $(this).closest('.sortable-subgroup');
		$id = $par.length > 0?$par.attr('data-id'):0;
		$(this).find('.menu-parent').val($id);
	});
}
function menuorder() {
	$('.sortable-item').each(function(index){
		$(this).find('.menu-order').val(index);
	});
}
// Nested demo
var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));

// Loop through each nested sortable element
for (var i = 0; i < nestedSortables.length; i++) {
	new Sortable(nestedSortables[i], {
		handle: '.sortable-handle',
		group: 'nested',
		animation: 150,
		fallbackOnBody: true,
		swapThreshold: 0.65,
		// Element dragging ended
		onEnd: function (/**Event*/evt) {
			// var itemEl = evt.item;  // dragged HTMLElement
			// evt.to;    // target list
			// evt.from;  // previous list
			// evt.oldIndex;  // element's old index within old parent
			// evt.newIndex;  // element's new index within new parent
			// evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
			// evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
			// evt.clone // the clone element
			// evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
			// console.log(evt);
			menuorder();
			menuparent();
		},
	});
}
</script>
<?= $this->endSection() ?>