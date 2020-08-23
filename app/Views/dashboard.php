
<?= $this->extend('index') ?>

<?= $this->section('content') ?>
	<div class="page__header">
		<h1 class="page--title"><?= $title; ?></h1>
		<div class="page--subtitle"><?= $subtitle; ?></div>
	</div>
	<div class="page__content">
	<div class="widget__wrap d-flex justify-between flex-wrap">
		<div class="card col-4-12">
			<div class="card--header">
				Post
			</div>
			<div class="card--body">
				Post list<br/>
				Post list<br/>
				Post list<br/>
				Post list<br/>
				Post list<br/>
				Post list<br/>
			</div>
		</div>
		<div class="card col-3-12">
			<div class="card--header">
				Page
			</div>
			<div class="card--body">
				Page list<br/>
				Page list<br/>
				Page list<br/>
				Page list<br/>
				Page list<br/>
				Page list<br/>
			</div>
		</div>
		<div class="card col-4-12">
			<div class="card--header">
				Media
			</div>
			<div class="card--body">
				Media list<br/>
				Media list<br/>
				Media list<br/>
				Media list<br/>
				Media list<br/>
				Media list<br/>
			</div>
		</div>
	</div>

	<div class="page__header mt-30">
		<h3 class="mods--title">Users</h3>
		<div class="mods--subtitle">list of admin users</div>
	</div>
	<table class="card-table mt-20">
		<tbody>
			<?php for($i=0;$i<=5;$i++) { ?>
			<tr>
				<td width="40"><img src="<?= base_url('admin/assets/img/pexels-pixabay-220453.jpg'); ?>" class="avatar avatar-sm" /></td>
				<td width="150"><strong>User Name</strong></td>
				<td><span class="label label-secondary">Supervisor</span> Lorem ipsum dolor sit amet visudus or empio</td>
				<td width="10">
					<div class="dropdown">
						<a href="#" class="dropdown-link action-link"><i class='bx bx-dots-vertical-rounded'></i></a>
						<div class="dropdown-menu right">
							<a class="dropdown-item active" href="#">Text</a>
							<a class="dropdown-item" href="#">Text</a>
							<a class="dropdown-item" href="#">Text</a>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>

	
<?= $this->endSection() ?>