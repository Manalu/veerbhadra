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
                  <li><a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a></li>
                  <li><a href="<?= base_url(); ?>site"><i class="fa fa-building" aria-hidden="true"></i>Site Management</a></li>
                </ol>
              </div>
              <!-- heading -->
              <div class="row">
                <div class="page-heading">
                  <h3>Site Management</h3><hr>
                </div>
              </div>
              <!-- buttons -->
              <div class="row">
                <div class="page_top_buttons pull-right">
                  <a href="<?= base_url(); ?>site/create" class="btn btn-info btn-sm"><i class="fa fa-plus-square" aria-hidden="true"></i>New Site</a>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- show feedback to user -->
              <?php if($this->session->feedback !== NULL): ?>
                <div class="row">
                  <?php if($this->session->feedback === 'SITE CREATED'): ?>
                    <div class="alert alert-success animated shake">
                      Site has been successfully created.
                    </div>
                  <?php elseif($this->session->feedback === 'SITE UPDATED'): ?>
                      <div class="alert alert-success animated shake">
                        Site has been successfully updated.
                      </div>
                  <?php endif; $this->session->unset_userdata('feedback'); ?>
                </div>
              <?php endif; ?>
              <!-- retrieve customer data into tables -->
              <?php if(count($site_data) < 1): ?>
                <div class="row">
                  <div class="alert alert-warning animated shake">
                    There is no any site listed.
                  </div>
                </div>
              <?php else: ?>
              <div class="row">
                <div class="customer-list-table table-responsive">
                  <h4>Registered Site List</h4>
                    <table class="table table-hover table-bordered table-condensed">
                      <tr class="active">
                        <th>Sr. No.</th>
                        <th>Site Name</th>
                        <th>Site Address</th>
                        <td>Site Description</td>
                        <th>Action</th>
                      </tr>

                      <?php foreach($site_data as $key => $value): ?>
                        <tr>
                            <td><?= $key+1; ?></td>
                            <td><a href="<?php echo base_url()."site/view/".$value['site_id']; ?>"><?= $value['site_name'] ?></a></td>
                            <td><?= $value['site_address'] ?></td>
                            <td><?= $value['site_desc']; ?></td>
                            <td>
                                <a href="<?php echo base_url()."site/update/".$value['site_id']; ?>">Update</a>
                                <a href="<?php echo base_url()."site/delete/".$value['site_id']; ?>">Delete</a>
                            </td>
                        </tr>
                      <?php endforeach; ?>

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