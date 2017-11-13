<div id="sidebarMenu" class="hidden-xs col-sm-4 col-md-3 col-lg-3">
    <div class="row">
        <div class="list-group">
            <a href="<?= base_url(); ?>dashboard" class="list-group-item <?php if($page_name == 'dashboard') echo 'active'; ?>"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a>
            <a href="<?= base_url(); ?>customer" class="list-group-item <?php if($page_name == 'customer') echo 'active'; ?>"><i class="fa fa-users" aria-hidden="true"></i>Customer Management</a>
            <a href="<?= base_url(); ?>site" class="list-group-item <?php if($page_name == 'site') echo 'active'; ?>"><i class="fa fa-building-o" aria-hidden="true"></i>Site Management</a>
            <a href="<?= base_url(); ?>work_order" class="list-group-item <?php if($page_name == 'work_order') echo 'active'; ?>"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Order</a>
            <a href="<?= base_url(); ?>sales" class="list-group-item <?php if($page_name == 'sales') echo 'active'; ?>"><i class="fa fa-bullhorn" aria-hidden="true"></i>Sales Management</a>
            <a href="<?= base_url(); ?>logout" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </div>
    </div>
</div>