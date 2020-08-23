<?php 
$request = \Config\Services::request(); 
$uri = $request->uri;
$mod = $uri->getSegment(2);
$sidebar_list = array('post','page','media','template','menu','widget','setting','files','user','users','profile');
$content_list = array('post','page','media');
$appearance_list = array('template','menu','widget');
$setting_list = array('setting','files','user','users');
$sidebar_title = '';
if(in_array($mod, $content_list)) {
    $sidebar_title = 'Contents';
} else if(in_array($mod, $appearance_list)) {
    $sidebar_title = 'Appearance';
} else if(in_array($mod, $setting_list)) {
    $sidebar_title = 'Settings';
} else if($mod == 'profile') {
    $sidebar_title = 'My Account';
}
?>
<section id="app__bar" class="app__bar" >
    <div class="app__logo">
        <a href="<?= base_url(); ?>" target="_blank">W</a>
    </div>
    <div class="app__menu">
        <ul class="app__nav">
            <li><a class="<?= ($mod == ''?'active':''); ?>" href="<?= base_url('admin'); ?>" title="Dashboard"><i class="bx bxs-dashboard"></i></a></li>
            <li><a class="<?= in_array($mod, $content_list)?'active':''; ?>" href="javascript:;" title="Content" onclick="openAppMenu(this, 'content', 'Contents');"><i class="bx bxs-book-content"></i></a></li>
            <li><a class="<?= in_array($mod, $appearance_list)?'active':''; ?>" href="javascript:;" title="Appearance" onclick="openAppMenu(this, 'appearance', 'Appearance');"><i class="bx bxs-crop"></i></a></li>
            <li><a class="<?= in_array($mod, $setting_list)?'active':''; ?>" href="javascript:;" title="Setting" onclick="openAppMenu(this, 'setting', 'Settings');"><i class="bx bxs-cog"></i></a></li>
        </ul>
    </div>
    <div class="app__user">
        <a <?= ($mod == 'profile'?'active':''); ?> href="javascript:'" title="User" onclick="openAppMenu(this, 'user', 'My Account');"><i class="bx bxs-user-circle"></i></a>
    </div>
</section>
<section id="sidebar" class="<?= in_array($mod, $sidebar_list)?'active':''; ?>">
    <div class="sidebar__wrapper">
        <a href="javascript:;" class="close__app" onclick="closeAppMenu();"><i class="bx bx-x"></i></a>
        <h3 class="sidebar__title sidebar--title"><?= $sidebar_title; ?></h3>
        <div id="content" class="sidebar__nav--wrapper <?= in_array($mod, $content_list)?'active':''; ?>">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="content__nav" class="sidebar__nav--list">
                <li><a href="<?= base_url('admin/post'); ?>" class="<?= ($mod == 'post'?'active':''); ?>">Post</a></li>
                <li><a href="<?= base_url('admin/page'); ?>" class="<?= ($mod == 'page'?'active':''); ?>">Page</a></li>
                <li><a href="<?= base_url('admin/media'); ?>" class="<?= ($mod == 'media'?'active':''); ?>">Media</a></li>
            </ul>
        </div>
        <div id="appearance" class="sidebar__nav--wrapper <?= in_array($mod, $appearance_list)?'active':''; ?>">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="appearance__nav" class="sidebar__nav--list">
                <li><a href="<?= base_url('admin/template'); ?>" class="<?= ($mod == 'template'?'active':''); ?>">Template</a></li>
                <li><a href="<?= base_url('admin/menu'); ?>" class="<?= ($mod == 'menu'?'active':''); ?>">Menu</a></li>
                <li><a href="<?= base_url('admin/widget'); ?>" class="<?= ($mod == 'widget'?'active':''); ?>">Widget</a></li>
            </ul>
        </div>
        <div id="setting" class="sidebar__nav--wrapper <?= in_array($mod, $setting_list)?'active':''; ?>">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="setting__nav" class="sidebar__nav--list">
                <li><a href="<?= base_url('admin/setting'); ?>" class="<?= ($mod == 'setting'?'active':''); ?>">General</a></li>
                <li><a href="<?= base_url('admin/files'); ?>" class="<?= ($mod == 'files'?'active':''); ?>">Files</a></li>
                <li><a href="<?= base_url('admin/users'); ?>" class="<?= ($mod == 'users'?'active':''); ?>">Users</a></li>
            </ul>
        </div>
        <div id="user" class="sidebar__nav--wrapper <?= ($mod == 'profile'?'active':''); ?>">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="user__nav" class="sidebar__nav--list">
                <li><a href="<?= base_url('admin/profile'); ?>" class="<?= ($mod == 'profile'?'active':''); ?>">My Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?= base_url('admin/logout'); ?>" onclick="return confirm('Are you want to logout?');">Logout</a></li>
            </ul>
        </div>
    </div>
</section>