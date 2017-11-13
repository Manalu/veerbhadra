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
                  <li><a href="<?= base_url().'site/update/'.$site_data[0]['site_id']; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i>Update Site</a></li>
                </ol>
              </div>
            
              <div class="row">
                <div class="page-heading">
                  <h3>Update Site</h3><hr>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <form id="create_site_form" action="<?= base_url().'site/save/existing'; ?>" method="post">
                      <!-- site id -->
                      <input type="hidden" name="site_id" value="<?= $site_data[0]['site_id'] ?>"/>

                      <!-- customer names -->
                      <div class="form-group <?php if(strlen(form_error('customer_id')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Customer Name</label>
                        <select name="customer_id" class="form-control" data-parsley-required="true" data-parsley-type="integer" required>
                          <option value="" selected>- Select Customer Name -</option>
                          <?php foreach ($customer_data as $key => $value): ?>
                              <?php if($value['customer_id'] === set_value('customer_id', $site_data[0]['customer_id'])): ?>
                                <option value="<?= $value['customer_id'] ?>" selected><?= $value['customer_name'] ?></option>  
                              <?php else: ?>
                                <option value="<?= $value['customer_id'] ?>"><?= $value['customer_name'] ?></option>
                              <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('customer_id', '<p class="text-danger">', '</p>'); ?>
                      </div>

                      <!-- site name -->
                      <div class="form-group <?php if(strlen(form_error('site_name')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Site Name</label>
                        <input type="text" class="form-control" name="site_name" value="<?= set_value('site_name', $site_data[0]['site_name']);  ?>" placeholder="Enter site name" data-parsley-minlength="3" data-parsley-maxlength="100" data-parsley-required="true" required/>
                        <?php echo form_error('site_name', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      
                      <!-- site address -->
                      <div class="form-group <?php if(strlen(form_error('site_address')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Site Address</label>
                        <textarea name="site_address" class="form-control" rows="4" placeholder="Enter address" data-parsley-minlength="15" data-parsley-maxlength="300" data-parsley-required="true" required><?= set_value('site_address', $site_data[0]['site_address']);  ?></textarea>
                        <?php echo form_error('site_address', '<p class="text-danger">', '</p>'); ?>
                      </div>

                      <!-- site description -->
                      <div class="form-group <?php if(strlen(form_error('site_desc')) != 0) echo 'has-error'; ?>">
                        <label class="control-label">Site Description</label>
                        <textarea name="site_desc" class="form-control" rows="4" placeholder="Enter address" data-parsley-minlength="15" data-parsley-maxlength="300" data-parsley-required="false"><?= set_value('site_desc', $site_data[0]['site_desc']);  ?></textarea>
                        <?php echo form_error('site_desc', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      
                      <!-- buttons -->
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Create Site"/>
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