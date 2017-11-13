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
                  <li><a href="<?= base_url(); ?>customer"><i class="fa fa-users" aria-hidden="true"></i>Customer Management</a></li>                
                </ol>
              </div>
              <!-- heading -->
              <div class="row">
                <div class="page-heading">
                  <h3>Customer Management</h3><hr>
                </div>
              </div>
              <!-- buttons -->
              <div class="row">
                <div class="page_top_buttons pull-right">
                  <a href="<?= base_url(); ?>customer/create" class="btn btn-info btn-sm"><i class="fa fa-plus-square" aria-hidden="true"></i>New Customer</a>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- show feedback to user -->
              <?php if($this->session->feedback !== NULL): ?>
                <div class="row">
                  <?php if($this->session->feedback === 'CUSTOMER CREATED'): ?>
                    <div class="alert alert-success animated shake">
                      Customer has been successfully created.                    
                    </div>
                  <?php elseif($this->session->feedback === 'CUSTOMER UPDATED'): ?>
                      <div class="alert alert-success animated shake">
                        Customer has been successfully updated.                    
                      </div>
                         
                  <?php endif; $this->session->unset_userdata('feedback'); ?>
                </div>
              <?php endif; ?>
              <!-- retrieve customer data into tables -->
              <?php if(count($customer_data) < 1): ?>
                <div class="row"><div class="alert alert-warning animated shake">There is no any customer listed.</div></div>
              <?php else: ?>
              <div class="row">
                <div class="customer-list-table table-responsive">
                  <h4>Registered Customer List</h4>
                    <table class="table table-hover table-bordered table-condensed">
                      <tr class="active">
                        <th>Sr. No.</th>
                        <th>Customer Name</th>
                        <th>Company Name</th>
                        <th>Action</th>
                      </tr>
                      
                      <?php foreach($customer_data as $key => $value): ?>
                        <tr>
                            <td><?= $key+1; ?></td>
                            <td><a href="<?php echo base_url()."customer/view/".$value['customer_id']; ?>"><?= $value['customer_name'] ?></a></td>
                            <td><?= $value['customer_company_name'] ?></td>
                            <td>
                                <a href="<?php echo base_url()."customer/update/".$value['customer_id']; ?>">Update</a>
                                <a href="<?php echo base_url()."customer/delete/".$value['customer_id']; ?>">Delete</a>
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