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
                  <li><a href="<?= base_url().'work_order'; ?>"><i class="fa fa-briefcase" aria-hidden="true"></i>Work Order</a></li>
                  <li><a href="<?= base_url().'work_order/update/'.$work_order_data[0]['work_order_id']; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i>Update Work Order</a></li>
                </ol>
              </div>
              <!-- heading -->
              <div class="row">
                <div class="page-heading">
                  <h3>Update Work Order</h3><hr>
                </div>
              </div>

              <?php if(form_error('work_order_desc[]') OR form_error('quantity[]') OR form_error('unit[]') OR form_error('rate[]') OR form_error('amount[]')): ?>
                <div class="row">
                  
                  <?php if(form_error('work_order_desc[]')): ?>
                    <?= form_error('work_order_desc[]', '<div class="alert alert-danger animated shake">', '</div>') ?>
                  <?php endif; ?>

                  <?php if(form_error('quantity[]')): ?>
                    <?= form_error('quantity[]', '<div class="alert alert-danger animated shake">', '</div>') ?>
                  <?php endif; ?>                  

                  <?php if(form_error('unit[]')): ?>
                    <?= form_error('unit[]', '<div class="alert alert-danger animated shake">', '</div>') ?>
                  <?php endif; ?>       

                  <?php if(form_error('rate[]')): ?>
                    <?= form_error('rate[]', '<div class="alert alert-danger animated shake">', '</div>') ?>
                  <?php endif; ?>                                    
                  
                  <?php if(form_error('amount[]')): ?>
                    <?= form_error('amount[]', '<div class="alert alert-danger animated shake">', '</div>') ?>
                  <?php endif; ?>                         

                </div>
              <?php endif; ?>

              <!-- work order common fields -->
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <div class="row">
                    <h4>Work Order Basic Information</h4>
                   
                  <form id="update_work_order" action="<?= base_url().'work_order/save/existing'; ?>" method="post">
                    <div class="col-xs-12 col-sm-5">
                      <div class="row">
                        
                        <input type="hidden" name="work_order_id" value="<?= $work_order_data[0]['work_order_id']; ?>">

                        <?php if($site_data): ?>
                          <div class="form-group <?php if(strlen(form_error('site_name')) != 0) echo 'has-error'; ?>">
                            <label class="control-label label-required">Site Name</label>
                            
                            <select name="site_name" class="form-control" data-parsley-required="true" required>
                              <option value="" selected>- Select Site Name -</option>
                              
                              <?php foreach($site_data as $key => $value): ?>
                                
                                <?php if(set_value('site_name', $work_order_data[0]['site_id']) === $value['site_id']): ?>
                                  <option value="<?= $value['site_id']; ?>" selected><?= $value['site_name']; ?></option>
                                <?php else: ?>
                                  <option value="<?= $value['site_id']; ?>"><?= $value['site_name']; ?></option>
                                <?php endif; ?>

                              <?php endforeach; ?>

                            </select>
                            
                            <?php echo form_error('site_name', '<p class="text-danger">', '</p>'); ?>
                          </div>
                        <?php endif; ?>

                        <div class="form-group <?php if(strlen(form_error('work_order_number')) != 0) echo 'has-error'; ?>">
                          <label class="control-label label-required">Work Order Number</label>
                          <input type="text" name="work_order_number" value="<?= set_value('work_order_number', $work_order_data[0]['work_order_number']); ?>" class="form-control" placeholder="Enter work order number" data-parsley-type="number" data-parsley-required="true" required/>
                          <?php echo form_error('work_order_number', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group <?php if(strlen(form_error('work_order_date')) != 0) echo 'has-error'; ?>">
                          <label class="control-label label-required">Work Order Date</label>
                          <input type="text" id="datepicker" name="work_order_date" value="<?= set_value('work_order_date', $work_order_data[0]['work_order_date']); ?>" class="form-control" placeholder="Choose work order date" data-parsley-required="true" required/>
                          <?php echo form_error('work_order_date', '<p class="text-danger">', '</p>'); ?>
                        </div>

                      </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-5 col-sm-offset-2">
                      <div class="row">
                        <?php $options = array('FLAT INTERNAL', 'FLAT MAINS', 'METER ROOM ELECTRIC WORK', 'PARKING ELECTRICAL WORK', 'STAIRCASE AND LIFT LOBY', 'LIFT ELECTRICAL WORK', 'OTHER WORK'); ?>
                        
                        <div class="form-group <?php if(strlen(form_error('work_type')) != 0) echo 'has-error'; ?>">
                          <label class="control-label label-required">Work Type</label>
                          <select name="work_type" class="form-control" data-parsley-required="true" required>
                            
                            <option value="" selected>- Select Work Type -</option>
                              <?php foreach ($options as $key => $value): ?>
                            
                              <?php if(set_value('work_type', $work_order_data[0]['work_order_type']) === $value): ?>
                                <option value="<?= $value ?>" selected><?= $value ?></option>
                              <?php else: ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                              <?php endif; ?>
                            
                            <?php endforeach; ?>

                          </select>
                          <?php echo form_error('work_type', '<p class="text-danger">', '</p>'); ?>
                        </div>

                        <div class="form-group <?php if(strlen(form_error('building_name')) != 0) echo 'has-error'; ?>">
                          <label class="control-label label-required">Buildong Name</label>
                          <input type="text" name="building_name" value="<?= set_value('building_name', $work_order_data[0]['work_order_building_name']) ?>" class="form-control" placeholder="Enter building name" data-parsley-required="true" required/>
                          <?php echo form_error('building_name', '<p class="text-danger">', '</p>'); ?>
                        </div>

                      </div>
                    </div>

                    <!-- work order items form -->
                    <div class="col-xs-12 col-sm-12">
                      <div class="row">
                        <h4>Work Order Details</h4>
                      </div>
                      
                      <div class="row">
                        <div class="table-responsive">
                          <input type="hidden" id="rowCount" name="row_count" value="<?= set_value('row_count', ($work_order_data[0])? sizeof($work_order_data):1); ?>" data-parsley-type="integer" data-parsley-min="1" data-parsley-max="1000" data-parsley-required="true" required>                          
                          <table id="work_order_table" class="table table-bordered table-condensed">
                            
                            <!-- heading -->
                            <tr class="active">
                              <th>Flat Number</th>
                              <th>Work Order Description</th>
                              <th>Quantity</th>
                              <th style="width: 100px;">Unit</th>
                              <th>Rate</th>
                              <th>Amount</th>
                            </tr>
                            
                            <!-- table row -->
                            <?php if(sizeof($work_order_data) === 1): //?>
                              <tr>
                                <input type="hidden" name="work_order_item_id[]" value="<?= $work_order_data[0]['work_order_item_id']; ?>">
                                <td><input type="text" name="flat_number[]" value="<?= $work_order_data[0]['work_order_item_flat_number'] ?>" class="form-control input-sm" placeholder="Flat Number"></td>
                                <td><textarea name="work_order_desc[]" rows="4" cols="30" class="form-control input-sm" placeholder="Work Order Description" data-parsley-required="true" required> <?= $work_order_data[0]['work_order_item_desc'] ?> </textarea></td>
                                <td><input type="text" name="quantity[]" value="<?= $work_order_data[0]['work_order_item_quantity'] ?>" class="form-control input-sm" data-quantity-position="0" placeholder="Quantity" data-parsley-type="number" data-parsley-min="0.1" data-parsley-max="100000" data-parsley-required="true" required></td>
                                <td>
                                  <?php $unitOptions = array('EA', 'FIT', 'FLAT', 'FT', 'KG', 'M', 'MTR', 'NOS', 'POINT'); ?>
                                  
                                  <select name="unit[]" class="form-control input-sm" data-parsley-required="true" required>
                                    <option value="" selected>- Unit -</option>
                                      <?php foreach ($unitOptions as $key => $value): ?>
                                        
                                        <?php if($value == $work_order_data[0]['work_order_item_unit']): ?>
                                          <option value="<?= $value ?>" selected><?= $value ?></option>
                                        <?php else: ?>
                                          <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endif; ?>

                                      <?php endforeach; ?>
                                  </select>

                                </td>
                                <td><input type="text" name="rate[]" value="<?= $work_order_data[0]['work_order_item_rate'] ?>" class="form-control input-sm" data-rate-position="0" placeholder="Rate" data-parsley-type="number" data-parsley-min="0.1" data-parsley-max="10000000" data-parsley-required="true" required></td>
                                <td><input type="text" name="amount[]" value="<?= $work_order_data[0]['work_order_item_amount'] ?>" class="form-control input-sm" data-amount-position="0" placeholder="Amount" readonly="true" data-parsley-min="0.1" data-parsley-max="10000000" data-parsley-required="true" required></td>
                              </tr>
                            
                            <?php else: ?>                              

                              <?php for($i=0; $i < set_value('row_count', sizeof($work_order_data)); $i++): 
                                  $row_count = set_value('row_count', sizeof($work_order_data));
                                  ?>
                                <input type="hidden" name="work_order_item_id[]" value="<?= $work_order_data[$i]['work_order_item_id']; ?>">
                                <tr>
                                  <td><input type="text" name="flat_number[]" value="<?= set_value("flat_number[". $i ."]", $work_order_data[$i]['work_order_item_flat_number']) ?>" class="form-control input-sm" placeholder="Flat Number"></td>
                                  <td><textarea name="work_order_desc[]" rows="4" cols="30" class="form-control input-sm" placeholder="Work Order Description" data-parsley-required="true" required> <?= set_value("work_order_desc[". $i ."]", $work_order_data[$i]['work_order_item_desc']) ?> </textarea></td>
                                  <td><input type="text" name="quantity[]" value="<?= set_value("quantity[". $i ."]", $work_order_data[$i]['work_order_item_quantity']) ?>" class="form-control input-sm" data-quantity-position="<?= $i ?>" placeholder="Quantity" data-parsley-type="number" data-parsley-min="0.1" data-parsley-max="100000" data-parsley-required="true" required></td>
                                  <td>
                                    <?php $unitOptions = array('EA', 'FIT', 'FLAT', 'FT', 'KG', 'M', 'MTR', 'NOS', 'POINT'); ?>
                                    
                                    <select name="unit[]" class="form-control input-sm" data-parsley-required="true" required>
                                      <option value="" selected>- Unit -</option>
                                      
                                      <?php foreach ($unitOptions as $key => $value): ?>
                                        
                                        <?php if(set_value("unit[". $i ."]", $work_order_data[$i]['work_order_item_unit']) === $value): ?>
                                          <option value="<?= $value ?>" selected><?= $value ?></option>
                                        <?php else: ?>
                                          <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endif; ?>
                                        
                                      <?php endforeach; ?>

                                    </select>

                                  </td>
                                  <td><input type="text" name="rate[]" value="<?= set_value("rate[". $i ."]", $work_order_data[$i]['work_order_item_rate']) ?>" class="form-control input-sm" data-rate-position="<?= $i ?>" placeholder="Rate" data-parsley-type="number" data-parsley-min="0.1" data-parsley-max="10000000" data-parsley-required="true" required></td>
                                  <td><input type="text" name="amount[]" value="<?= set_value("amount[". $i ."]", $work_order_data[$i]['work_order_item_amount']) ?>" class="form-control input-sm" data-amount-position="<?= $i ?>" placeholder="Amount" readonly="true" data-parsley-type="number" data-parsley-min="0.1" data-parsley-max="10000000" data-parsley-required="true" required></td>
                                </tr>
                              <?php endfor;?>

                            <?php endif; ?>
                              

                          </table>
                        </div> 
                      </div>

                      <div class="row">
                        <div class="form-group">
                          <a href="" id="add_row" data-form-name="create_work_order" class="btn btn-warning btn-sm">Add Row</a>
                          <a href="#" id='delete_row' data-form-name="create_work_order" class="btn btn-danger btn-sm">Delete Row</a>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group">
                          <input type="submit" value="Create Work Order" class="btn btn-primary"/>
                          <input type="reset" value="Clear" class="btn btn-default"/>
                        </div>
                      </div>

                    </div>
                  </form>

                  </div>
                </div>
              </div>

              <div class="row">
                <?php
                    echo '<pre>';
                    print_r($work_order_data);
                    echo '</pre>';

                ?>
              </div>


          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>