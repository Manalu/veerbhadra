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
                <li>
                  <a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</a>
                </li>
              </ol>
            </div>
            <?php
              if($this->session->login_status === TRUE){
                echo "<div class='row'><div class='alert alert-success animated shake'>You have successfully logged in.</div></div>";
                // destroy login status session
                $this->session->unset_userdata('login_status');
              }
            ?>
            <div class="row">
              <div class="dashboard-logo-section">
                <a href="<?= base_url(); ?>dashboard">
                  <img class="img-responsive dashboard-logo-img" src="<?= base_url(); ?>assets/img/logo.png" alt="dashboard-logo"/>
                </a>
                <h3 class="dashboard-logo-heading">Electricals &amp; Engineers (Pune) <small>Maharashtra State Govt. Electrical Licensed Contractor.</small> </h3>
              </div>
            </div>
            <div class="row">
              <div class="dashboard-company-information table-responsive">
                  <table class="table table-hover table-bordered">
                      <tr>
                          <td>Company Name:</td>
                          <td>Veerbhadra Electricals &amp; Engineers</td>
                      </tr>
                      <tr>
                          <td>Proprietor Name:</td>
                          <td>Mr. Santosh Kashinath Kumbhar</td>
                      </tr>
                      <tr>
                          <td>Business Nature:</td>
                          <td>Government License Electrical Contractor</td>
                      </tr>
                      <tr>
                          <td>Business Form:</td>
                          <td>Sole Proprietorship</td>
                      </tr>
                      <tr>
                          <td>Registered Address:</td>
                          <td>Sr. No. 580, Anand Nagar, Marker Yard, Bibwewadi- Kondhwa Road, Pune – 411037</td>
                      </tr>
                      <tr>
                          <td>Corporate Office:</td>
                          <td>Rajdhani Complex, Shop No.20 A, near Shankar Maharaj Math, Dhankawadi Pune-411043</td>
                      </tr>
                      <tr>
                          <td>Email:</td>
                          <td><a href="mailto: veerbhadra2009@yahoo.com">veerbhadra2009@yahoo.com</a>, <a href="mailto: veerbhadra.30294@yahoo.com">veerbhadra.30294@yahoo.com</a></td>
                      </tr>
                      <tr>
                          <td>Mobile Number:</td>
                          <td>+91 7720062701</td>
                      </tr>
                      <tr>
                          <td>Elec. Contractor No:</td>
                          <td>30294</td>
                      </tr>
                      <tr>
                          <td>GSTN Provisional ID:</td>
                          <td>27ANTPK2983Q1ZU</td>
                      </tr>
                      <tr>
                          <td>PAN Number:</td>
                          <td>ANTPK2983Q</td>
                      </tr>
                      <tr>
                          <td>Bank Name:</td>
                          <td>Axis Bank Ltd</td>
                      </tr>
                      <tr>
                          <td>Bank IFSC Code:</td>
                          <td>UTIB0000350</td>
                      </tr>               
                      <tr>
                          <td>Bank Account:</td>
                          <td>912020060024448</td>
                      </tr>   
                  </table>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?= $footer_view; ?>