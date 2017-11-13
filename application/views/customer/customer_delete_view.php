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
                  <li><a href="<?= base_url().'customer/delete/'.$customer_data[0]['customer_id']; ?>"><i class="fa fa-remove" aria-hidden="true"></i>Delete "<?= $customer_data[0]['customer_name'] ?>"</a></li>
                </ol>
              </div>

              <div class="row">
                <div class="page-heading">
                  <h3>Delete Existing Customer</h3><hr>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="row">
                    <form id="delete_customer_form" action="<?= base_url().'customer/delete/'.$customer_data[0]['customer_id']; ?>" method="post">
                      <!-- customer id hidden -->
                      <input type="hidden" name="customer_id" value="<?= $customer_data[0]['customer_id'] ?>"/>
                      <!-- customer name -->
                      <div class="form-group">
                        <label class="control-label">Selected Customer &amp; Company Name </label>
                        <input type="text" class="form-control" value="<?= $customer_data[0]['customer_name'].' - '.$customer_data[0]['customer_company_name']; ?>" disabled/>
                      </div>
                      <!-- reason -->
                      <div class="form-group <?php if(strlen(form_error('reason')) != 0) echo 'has-error'; ?>">
                        <label class="control-label label-required">Reason</label>
                        <select name="reason" class="form-control">
                          <?php
                            $options = array('Wrongly Customer Created', 'Other Reason');
                              if(strlen(set_value('reason')) == 0){
                                echo "<option value='' selected>- Select Reason -</option>";
                              }else{
                                echo "<option value=''>- Select Reason -</option>";
                              }
                              foreach ($options as $key => $value) {
                                if(set_value('reason') != $value){
                                  echo "<option value=''>". $value ."</option>";
                                }else if(set_value('reason') == $value){
                                  echo "<option value='' selected>". $value ."</option>";
                                }
                              }
                          ?>                          
                        </select>
                        <?php echo form_error('reason', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- remark -->
                      <div class="form-group <?php if(strlen(form_error('remark')) != 0) echo 'has-error'; ?>">
                        <label class="control-label">Remark</label>
                        <textarea name="remark" class="form-control" rows="4" placeholder="Enter address" data-parsley-minlength="15" data-parsley-maxlength="300" data-parsley-required="false"><?= set_value('remark'); ?></textarea>
                        <?php echo form_error('remark', '<p class="text-danger">', '</p>'); ?>
                      </div>
                      <!-- buttons -->
                      <div class="form-group">
                        <input type="submit" class="btn btn-danger" value="Delete Customer"/>
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