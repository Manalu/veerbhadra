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
                  <li><a href="<?= base_url().'customer/update/'.$customer_data[0]['customer_id']; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i>Update Customer</a></li>
                </ol>
              </div>
            
              <div class="row">
                <div class="page-heading">
                  <h3>Create New Customer</h3><hr>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <form id="update_customer_form" action="<?= base_url().'customer/save/existing'; ?>" method="post">
                      <!-- customer id hidden -->
                      <input type="hidden" name="customer_id" value="<?= $customer_data[0]['customer_id']; ?>"/>
                      <!-- customer name -->
                      <div class="form-group <?php if(strlen(form_error('customer_name')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" value="<?= set_value('customer_name', $customer_data[0]['customer_name']);  ?>" placeholder="Enter customer name" data-parsley-minlength="3" data-parsley-maxlength="100" data-parsley-required="true" required/>
                        <?php echo form_error('customer_name', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- company name -->
                      <div class="form-group <?php if(strlen(form_error('company_name')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="<?= set_value('company_name', $customer_data[0]['customer_company_name']);  ?>" placeholder="Enter company name" data-parsley-minlength="5" data-parsley-maxlength="120" data-parsley-required="true" required/>
                        <?php echo form_error('company_name', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- mobile number -->
                      <div class="form-group <?php if(strlen(form_error('mobile_number')) != 0) echo 'has-error'; ?>">
                        <label class="control-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" value="<?= set_value('mobile_number', $customer_data[0]['customer_mobile_number']);  ?>" placeholder="Enter mobile number" data-parsley-required="false"/>
                        <?php echo form_error('mobile_number', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- email address -->
                      <div class="form-group <?php if(strlen(form_error('email_address')) != 0) echo 'has-error'; ?>">
                        <label class="control-label">Email Address</label>
                        <input type="email" class="form-control" name="email_address" value="<?= set_value('email_address', $customer_data[0]['customer_email_address']);  ?>" placeholder="Enter email address" data-parsley-type="email" data-parsley-required="false"/>
                        <?php echo form_error('email_address', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- address -->
                      <div class="form-group <?php if(strlen(form_error('address')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Address</label>
                        <textarea name="address" class="form-control" rows="4" placeholder="Enter address" data-parsley-minlength="15" data-parsley-maxlength="300" data-parsley-required="true" required><?= set_value('address', $customer_data[0]['customer_address']);  ?></textarea>
                        <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- gst number -->
                      <div class="form-group <?php if(strlen(form_error('gst_number')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">GST Number</label>
                        <input type="text" name="gst_number" class="form-control" value="<?= set_value('gst_number', $customer_data[0]['customer_gst_number']); ?>" placeholder="Enter gst number" data-parsley-required="true" required/>
                        <?php echo form_error('gst_number', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- vendor code -->
                      <div class="form-group <?php if(strlen(form_error('vendor_code')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Vendor Code</label>
                        <input type="text" name="vendor_code" class="form-control" value="<?= set_value('vendor_code', $customer_data[0]['customer_vendor_code']);  ?>" placeholder="Enter vendor code" data-parsley-required="true" required/>
                        <?php echo form_error('vendor_code', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- buttons -->
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update Customer"/>
                        <input type="reset" class="btn btn-default" value="Clear"/>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>