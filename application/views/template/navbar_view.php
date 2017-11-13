<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">        
        <div class="row">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?= base_url(); ?>dashboard">Veerbhadra Infra</a>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li class="hidden-xs"><a href="#" id="sidebarToggle"><i class="fa fa-eye-slash" aria-hidden="true"></i>Hide Sidebar</a></li>
                <li class="visible-xs"><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a></li>
                <li class="visible-xs"><a href="<?= base_url(); ?>customer"><i class="fa fa-users" aria-hidden="true"></i>Customer Management</a></li>
                <li class="visible-xs"><a href="<?= base_url(); ?>site"><i class="fa fa-building-o" aria-hidden="true"></i>Site Management</a></li>
                <li class="visible-xs"><a href="<?= base_url(); ?>work_order"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Order</a></li>
                <li class="visible-xs"><a href="<?= base_url(); ?>sales"><i class="fa fa-bullhorn" aria-hidden="true"></i>Sales Management</a></li>
                <li><a href="<?= base_url(); ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
              </ul>
            </div>
        </div>
    </div>
</nav>