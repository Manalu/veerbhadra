<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');

  echo $header_view.$navbar_view;
?>
  <div class="container">
    <div class="row row-no-padding">
      <?= $sidebar_view; ?>
        <div id="page_content_wrapper" class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
          <div class="page_content">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
              <div class="row">
                <ol class="breadcrumb">
                  <li><a href="<?= base_url().'dashboard'; ?>"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a></li>
                  <li><a href="<?= base_url().'site'; ?>"><i class="fa fa-building" aria-hidden="true"></i>Site Management</a></li>                
                  <?php if(count($site_data) > 0): ?>
                    <li><a href="<?= base_url().'site/view/'.$site_data[0]['site_id'];?>"><i class="fa fa-building-o" aria-hidden="true"></i><?= $site_data[0]['site_name']; ?></a></li>
                  <?php endif; ?>
                </ol>
              </div>
            
              <div class="row">
                <div class="page-heading">
                  <h3>Site Management</h3><hr>
                </div>
              </div>

              <?php if(count($site_data) < 1): ?>
                <div class="row">
                  <div class="alert alert-success animated shake">
                    Blackhole
                  </div>
                </div>
              <?php else: ?>
                <div class="row">
                  <div class="table-responsive">
                    <h4>Site Information</h4>
                    <table class="table table-bordered table-condensed">                      
                      <tr>
                        <td>ID</td>
                        <td><?= $site_data[0]['site_id'] ?></td>
                      </tr>
                      <tr>
                        <td>Site Name</td>
                        <td><?= $site_data[0]['site_name'] ?></td>
                      </tr>
                      <tr>
                        <td>Site Address</td>
                        <td><?= $site_data[0]['site_address'] ?></td>
                      </tr>
                      <tr>
                        <td>Site Description</td>
                        <td><?= $site_data[0]['site_desc'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              <?php endif; ?>
              
          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>