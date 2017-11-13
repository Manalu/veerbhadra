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
                  <li><a href="<?= base_url().'sales'; ?>"><i class="fa fa-bullhorn" aria-hidden="true"></i>Sales Management</a></li>
                </ol>
              </div>
              <!-- heading -->
              <div class="row">
                <div class="page-heading">
                  <h3>Sales Management</h3><hr>
                </div>
              </div>
              <!-- buttons -->
              <div class="row">
                <div class="page_top_buttons pull-right">
                  <a href="<?= base_url(); ?>sales/create/invoice" class="btn btn-info btn-sm">New Sales Invoice</a>
                  <a href="<?= base_url(); ?>sales/master" class="btn btn-warning btn-sm">Sales Master</a>
                  <a href="<?= base_url(); ?>sales/letter_head" class="btn btn-default btn-sm">Letter Head</a>
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
                <?php if(sizeof($sales_data) == 0): ?>
                  <div class="alert alert-danger animated shake">
                    There is no any work order listed.
                  </div>
                <?php else: ?>
                  <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped">
                      <tr>
                        <th>Invoice Number</th>
                        <th>W/O Number</th>
                        <th>Invoice Amount</th>
                        <th>Paid Amount</th>
                        <th>Unpaid Amount</th>                        
                        <th>Action</th>
                      </tr>
                      <?php 
                        foreach ($sales_data as $key => $value):
                      ?>
                      <tr>
                        <td><a href="<?= base_url().'sales/view/invoice/'.$value['sales_invoice_system_id']; ?>"><?= $value['sales_invoice_user_id']; ?></a></td>
                        <td><?= $value['sales_invoice_work_order_number'] ?></td>
                        <td><?= $value['sales_invoice_sub_total_with_tax'] ?></td>
                        <td><?= $value['sales_invoice_paid_amount'] ?></td>
                        <td><?= $value['sales_invoice_unpaid_amount'] ?></td>
                        
                        <td>
                          <a href="<?= base_url().'work_order/update/'; ?>">Update</a>
                          <a href="<?= base_url().'work_order/delete/'; ?>">Delete</a>
                        </td>
                      </tr>
                      <?php
                        endforeach;
                      ?>
                    </table>
                  </div>
                <?php endif; ?>
              </div>

              
              <div class="row">
                <?php
                  echo '<pre>';
                  print_r($sales_data);
                  echo '</pre>';
                ?>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>