<section id="app__bar" class="app__bar" >
    <div class="app__logo">
        <a href="#">W</a>
    </div>
    <div class="app__menu">
        <ul class="app__nav">
            <li><a href="#" title="Dashboard"><i class="bx bxs-dashboard"></i></a></li>
            <li><a href="#" title="Content" onclick="openAppMenu('content', 'Contents');"><i class="bx bxs-book-content"></i></a></li>
            <li><a href="#" title="Appearance" onclick="openAppMenu('appearance', 'Appearance');"><i class="bx bxs-crop"></i></a></li>
            <li><a href="#" title="Setting" onclick="openAppMenu('setting', 'Settings');"><i class="bx bxs-cog"></i></a></li>
        </ul>
    </div>
    <div class="app__user">
        <a href="#" title="User" onclick="openAppMenu('user', 'User Profile');"><i class="bx bxs-user-circle"></i></a>
    </div>
</section>
<section id="sidebar">
    <div class="sidebar__wrapper">
        <a href="#" class="close__app" onclick="closeAppMenu();"><i class="bx bx-x"></i></a>
        <h3 class="sidebar__title sidebar--title"></h3>
        <div id="content" class="sidebar__nav--wrapper">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="content__nav" class="sidebar__nav--list">
                <li><a href="#">Post</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Media</a></li>
                <li><a href="#">Banner</a></li>
            </ul>
        </div>
        <div id="appearance" class="sidebar__nav--wrapper">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="appearance__nav" class="sidebar__nav--list">
                <li><a href="#">Template</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Widget</a></li>
            </ul>
        </div>
        <div id="setting" class="sidebar__nav--wrapper">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="setting__nav" class="sidebar__nav--list">
                <li><a href="#">General</a></li>
                <li><a href="#">Users</a></li>
            </ul>
        </div>
        <div id="user" class="sidebar__nav--wrapper">
            <div class="sidebar__nav--title">
                ACTION
            </div>
            <ul id="user__nav" class="sidebar__nav--list">
                <li><a href="#">Edit Profile</a></li>
                <li><a href="<?= base_url('admin/logout'); ?>" onclick="return confirm('Are you want to logout?');">Logout</a></li>
            </ul>
        </div>
    </div>
</section>