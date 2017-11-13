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
                  <li><a href="<?= base_url().'work_order/view/'.$work_order_data[0]['work_order_id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i><?= $work_order_data[0]['work_order_number'] ?></a></li>
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
                  <a href="<?= base_url().'work_order/update/'.$work_order_data[0]['work_order_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modify Work Order</a>                  
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

              <div class="row">
                <?php if(count($work_order_data) == 0): ?>
                  <div class="alert alert-danger animated shake">
                    You have try to access invalid work order...
                  </div>
                <?php else: ?>
                  <h4>Work order <?= $work_order_data[0]['work_order_number'] ?></h4>
                <?php endif; ?>
              </div>

              <?php if($work_order_data): ?>
                
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                      <tr>
                        <td><strong>Work Order Number:</strong> <?= $work_order_data[0]['work_order_number']; ?></td>
                        <td><strong>Work Order Date:</strong> <?= user_date_convert($work_order_data[0]['work_order_date']); ?></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Site Name:</strong> <?= $work_order_data[0]['site_name']; ?></td>                        
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Building Name:</strong> <?= $work_order_data[0]['work_order_building_name']; ?></td>
                      </tr>
                      <tr>
                        <td colspan="2"><strong>Work Type:</strong> <?= $work_order_data[0]['work_order_type']; ?></td>
                      </tr>
                    </table>
                  </div>  
                </div>
                
                <?php if($work_order_list_data): ?>
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                      <tr class="active">
                        <th>Sr. No</th>
                        <th>Flat Number</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Bill Paid</th>
                        <th>Bill Unpaid</th>
                      </tr>

                      <?php foreach($work_order_list_data as $key => $value): ?>
                      
                      <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= $value['work_order_item_flat_number'] ?></td>
                        <td><?= $value['work_order_item_desc'] ?></td>
                        <td><?= $value['work_order_item_quantity'] ?></td>
                        <td><?= $value['work_order_item_unit'] ?></td>
                        <td><?= $value['work_order_item_rate'] ?></td>                        
                        <td><?= $value['work_order_item_amount'] ?></td>
                        <td><?= $value['work_order_item_bill_paid'] ?></td>
                        <td><?= $value['work_order_item_bill_unpaid'] ?></td>
                      </tr>
                      
                      <?php endforeach; ?>

                    </table>
                  </div>
                </div>
                <?php else: ?>
                  <div class="row">
                    <div class="well well-sm">
                      <p>There is no any work order item listed in database.</p>
                    </div>
                  </div>

                <?php endif; // $work_order_list_data - check endif ?>                

              <?php endif; // $work_order_data - check endif ?>

              <div class="row">
                <?php 
                  // echo '<pre>';
                  // print_r($work_order_list_data);
                  // echo '</pre>';

                ?>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>