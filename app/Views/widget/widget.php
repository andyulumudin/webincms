
<?= $this->extend('index') ?>

<?= $this->section('content') ?>

	<div class="page__toolbar">
		<div>
			<h3 class="mods--title"><?= $title; ?></h3>
			<div class="mods--subtitle"><?= $subtitle; ?></div>
		</div>
		<div>

		</div>
	</div>

	<div class="page__content mt-10">

	<?php if(session()->getFlashdata('alert')) { ?>
		<div class="alert alert-warning">
		<?= session()->getFlashdata('alert'); ?>
		</div>
	<?php } ?>

	<div class="d-flex">

	<div class="col-7-12">
		<div class="card">
			<div class="card--header d-flex justify-between">
				<h5 class="pt-10 mb-0">Widget Position</h5>
				<select class="input-text input-sm mt-5" name="position" onchange="positionselect(this.value);">
					<?php foreach($positions as $position) { ?>
					<option value="<?= $position['value'] ?>" <?= $position['value'] == setting('widget_position')?'selected':''; ?>><?= $position['name'] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="divider"></div>
			<div class="card--body">
			<div id="widget-sortable" class="sortable-wrapper">
				<?php
				if(isset($items) && count($items) > 0) {
				foreach($items as $item) {
				?>
				<div class="sortable-group mb-10">
                <div class="sortable-item">
                    <a href="javascript:;" class="sortable-handle"><i class="bx bx-grid-vertical"></i></a> 
                    <a href="<?= base_url(ADMINURL.'/widget?id='.$item['widget_id']); ?>" class="flex-grow sortable-name"><?= $item['widget_title']; ?></a> 
                    <a href="<?= base_url(ADMINURL.'/widget/delete/'.$item['widget_id']); ?>" onclick="return confirm('Are you sure want to delete this item?');" class="sortable-delete"><i class="bx bxs-trash"></i></a>

                    <input type="hidden" class="widget-id" name="widget-id" value="<?= $item['widget_id'] ?>">
                    <input type="hidden" class="widget-order" name="widget-order" value="<?= $item['widget_order'] ?>">
                </div>
            	</div>
				<?php }} ?>
			</div>
			</div>
			<div class="divider"></div>
			<div class="card--footer">
			<form class="" name="addwidget" action="<?= base_url(ADMINURL.'/widget/add'); ?>" method="post">
			<div class="d-flex">
				<select name="widget" class="input-text" required>
					<option value="">Select Widget Item</option>
					<?php foreach($widgets as $widget) { ?>
					<option value="<?= $widget['value'] ?>"><?= $widget['name'] ?></option>
					<?php } ?>
				</select>
				<button type="submit" class="btn btn-primary mt-0 mb-0">ADD</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	
	<?php if(isset($detail)) { ?>
	<div class="col-5-12 pl-10">
	<div class="card">
	<div class="card--body">
		<h3><?= $detail_title; ?></h3>
		<div class="mt-20">
		<form name="updatemenuitem" action="<?= base_url(ADMINURL.'/widget/edit'); ?>" method="post">
			<input type="hidden" name="widget_id" value="<?= $detail['widget_id']; ?>" />
			<?php
			if (array_key_exists("inputs",$widgets[$key])) {
			$inputs = $widgets[$key]['inputs'];
			$widget_value = unserialize($detail['widget_value']);
			foreach($inputs as $input) {
			$label = strtoupper($input['label']);
			$type = $input['type'];
			$name = $input['name'];
			$value = array_key_exists($name,$widget_value)?$widget_value[$name]:'';
			?>
			<div class="mt-10">
				<label class="d-block"><small><?= $label; ?></small></label>
				<?php if($type == 'text') { ?>
				<input type="<?= $type; ?>" name="<?= $name; ?>" class="input-text input-block" placeholder="<?= $input['label']; ?>" value="<?= $value; ?>" required />
				<?php } ?>
				<?php if($type == 'file') { ?>
				<div class="mt-10">
					<a class="btn btn-sm btn-info">Select File</a>
				</div>
				<?php } ?>
				<?php if($type == 'textarea') { ?>
				<textarea name="<?= $name; ?>" class="input-text input-block" placeholder="<?= $input['label']; ?>"><?= $value; ?></textarea>
				<?php } ?>
			</div>
			<?php }} ?>
			<div class="mt-10 align-right">
				<a href="<?= base_url(ADMINURL.'/widget'); ?>" class="btn btn-secondary">CANCEL</a>
				<button type="submit" class="btn btn-primary">UPDATE</button>
			</div>
		</form>
		</div>
	</div>
	</div>
	</div>
	<?php } ?>

	</div>

	</div>

<?= $this->endSection() ?>

<?= $this->section('head') ?>
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
	background-color: #f7f7f7;
	border-radius: 3px;
	border: 1px solid #cccccc;
	height: 40px;
	padding: 0 10px;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://sortablejs.github.io/Sortable/Sortable.js"></script>
<script>
function positionselect(v) {
	window.location.href = "<?= base_url(ADMINURL.'/widget/default'); ?>/"+v;
}

function widgetorder() {
	$('.sortable-item').each(function(index){
		$(this).find('.widget-order').val(index);
	});
}

function setorder() {
	$('.sortable-item').each(function(){
		$id = $(this).find('.widget-id').val();
		$order = $(this).find('.widget-order').val();
		
		$.ajax({
			type: "POST",
			url: "<?= base_url(ADMINURL.'/widget/setorder'); ?>",
			data: {id:$id, order:$order}
		})
		.done(function(data) {
			
		});
	});
}

var widgetposition = document.getElementById('widget-sortable');
new Sortable(widgetposition, {
	handle: '.sortable-handle',
	group: 'nested',
	animation: 150,
	fallbackOnBody: true,
	swapThreshold: 0.65,
	// Element dragging ended
	onEnd: function (evt) {
		widgetorder();
		setorder();
	},
});
</script>
<?= $this->endSection() ?>