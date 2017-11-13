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
                  <li><a href="<?= base_url().'customer'; ?>"><i class="fa fa-users" aria-hidden="true"></i>Customer Management</a></li>                
                  <?php if(count($customer_data)>0): ?>
                    <li><a href="<?= base_url().'customer/view/'.$customer_data[0]['customer_id'];?>"><i class="fa fa-user" aria-hidden="true"></i><?= $customer_data[0]['customer_name']; ?></a></li>
                  <?php endif; ?>
                </ol>
              </div>
            
              <div class="row">
                <div class="page-heading">
                  <h3>Customer Management</h3><hr>
                </div>
              </div>

              <?php if(count($customer_data) < 1): ?>
                <div class="row">
                  <div class="alert alert-success animated shake">
                    Blackhole
                  </div>
                </div>
              <?php else: ?>
                <div class="row">
                  <div class="table-responsive">
                    <h4>Customer Information</h4>
                    <table class="table table-bordered table-condensed">                      
                      <tr>
                        <td>ID</td>
                        <td><?= $customer_data[0]['customer_id'] ?></td>
                      </tr>
                      <tr>
                        <td>Customer Name</td>
                        <td><?= $customer_data[0]['customer_name'] ?></td>
                      </tr>
                      <tr>
                        <td>Company Name</td>
                        <td><?= $customer_data[0]['customer_company_name'] ?></td>
                      </tr>
                      <tr>
                        <td>Mobile Number</td>
                        <td><?= $customer_data[0]['customer_mobile_number'] ?></td>
                      </tr>
                      <tr>
                        <td>Email Address</td>
                        <td><?= $customer_data[0]['customer_email_address'] ?></td>
                      </tr>
                      <tr>
                        <td>Customer Address</td>
                        <td><?= $customer_data[0]['customer_address'] ?></td>
                      </tr>
                      <tr>
                        <td>GST Number</td>
                        <td><?= $customer_data[0]['customer_gst_number'] ?></td>
                      </tr>
                      <tr>
                        <td>Vendor Code</td>
                        <td><?= $customer_data[0]['customer_vendor_code'] ?></td>
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