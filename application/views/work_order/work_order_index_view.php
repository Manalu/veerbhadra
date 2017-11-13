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
                  <li><a href="<?= base_url(); ?>work_order"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Order</a></li>
                </ol>
              </div>
              <!-- heading -->
              <div class="row">
                <div class="page-heading">
                  <h3>Work Order Management</h3><hr>
                </div>
              </div>
              <!-- buttons -->
              <div class="row">
                <div class="page_top_buttons pull-right">
                  <a href="<?= base_url(); ?>work_order/create" class="btn btn-info btn-sm"><i class="fa fa-plus-square" aria-hidden="true"></i>New Work Order</a>
                  <div class="clearfix"></div>
                </div>
              </div>

              <!-- show feedback to user -->
              <?php if($this->session->feedback !== NULL): ?>
                <div class="row">
                  <?php if($this->session->feedback === 'WORK ORDER CREATED'): ?>
                    <div class="alert alert-success animated shake">
                      Work order created has been successfully created.
                    </div>
                  <?php elseif($this->session->feedback === 'WORK ORDER UPDATED'): ?>
                      <div class="alert alert-success animated shake">
                        Work order created has been successfully updated.
                      </div>
                  <?php endif; $this->session->unset_userdata('feedback'); ?>
                </div>
              <?php endif; ?>

              <div class="row">
                <?php if(count($work_order_data) == 0): ?>
                  <div class="alert alert-danger animated shake">
                    There is no any work order listed.
                  </div>
                <?php else: ?>
                  <h3>Work orders list</h3>
                  <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped">
                      <tr>
                        <th>Sr. No.</th>
                        <th>Work Order Number</th>
                        <th>Site Name</th>
                        <th>Action</th>
                      </tr>
                      <?php 
                        foreach ($work_order_data as $key => $value):
                      ?>
                      <tr>
                        <td><?= $key+1 ?></td>
                        <td><a href="<?= base_url().'work_order/view/'.$value['work_order_id'] ?>"><?= $value['work_order_number'] ?></a></td>
                        <td><a href="<?= base_url().'site/view/'.$value['site_id'] ?>"><?= $value['site_name'] ?></a></td>
                        <td>
                          <a href="<?= base_url().'work_order/update/'.$value['work_order_id'] ?>">Update</a>
                          <a href="<?= base_url().'work_order/delete/'.$value['work_order_id'] ?>">Delete</a>
                        </td>
                      </tr>
                      <?php
                        endforeach;
                      ?>
                    </table>
                  </div>
                <?php endif; ?>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>