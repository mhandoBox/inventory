<!-- Content Wrapper. Contains page content -->
<?php
$readonly = empty($can_edit_company) ? 'readonly disabled' : '';
$disabled = empty($can_edit_company) ? 'disabled' : '';
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Company
     
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">company</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            
            <form role="form" action="<?php echo base_url('company/update'); ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <?php if($company_data['logo']): ?>
                  <div class="form-group">
                    <label>Company Logo</label><br>
                    <img src="<?php echo base_url().'assets/images/'.$company_data['logo'] ?>" width="150" height="150">
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label for="logo">Update Logo</label>
                  <input type="file" class="form-control" id="logo" name="logo" <?php echo $disabled; ?>>
                </div>

                <?php if($company_data['image']): ?>
                  <div class="form-group">
                    <label>Company Image</label><br>
                    <img src="<?php echo base_url().'assets/images/'.$company_data['image'] ?>" width="150" height="150">
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label for="image">Update Image</label>
                  <input type="file" class="form-control" id="image" name="image" <?php echo $disabled; ?>>
                </div>

                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" value="<?php echo $company_data['company_name'] ?>" autocomplete="off" <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                  <label for="registration">Registration Number</label>
                  <input type="text" class="form-control" id="registration" name="registration" placeholder="Enter registration number" value="<?php echo $company_data['registration'] ?>" autocomplete="off" <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                  <label for="tin">TIN Number</label>
                  <input type="text" class="form-control" id="tin" name="tin" placeholder="Enter TIN number" value="<?php echo $company_data['tin'] ?>" autocomplete="off" <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                  <label for="service_charge_value">Charge Amount (%)</label>
                  <input type="text" class="form-control" id="service_charge_value" name="service_charge_value" placeholder="Enter charge amount %" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off" <?php echo $readonly ?>>
                </div>
                <div class="form-group">
                  <label for="vat_charge_value">Vat Charge (%)</label>
                  <input type="text" class="form-control" id="vat_charge_value" name="vat_charge_value" placeholder="Enter vat charge %" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off" <?php echo $readonly ?>>
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?php echo $company_data['address'] ?>" autocomplete="off" <?php echo $readonly ?>>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="<?php echo $company_data['phone'] ?>" autocomplete="off" <?php echo $readonly ?>>
                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" value="<?php echo $company_data['country'] ?>" autocomplete="off" <?php echo $readonly ?>>
                </div>
                <div class="form-group">
                  <label for="message">Message</label>
                  <input type="text" class="form-control" id="message" name="message" placeholder="Enter message" value="<?php echo $company_data['message'] ?>" autocomplete="off" <?php echo $readonly; ?>>
                </div>
                <div class="form-group">
                  <label for="currency">Currency</label>
                  <?php ?>
                  <select class="form-control" id="currency" name="currency" <?php echo $disabled; ?>>
                    <option value="">~~SELECT~~</option>

                    <?php foreach ($currency_symbols as $k => $v): ?>
                      <option value="<?php echo trim($k); ?>" <?php if($company_data['currency'] == $k) {
                        echo "selected";
                      } ?>><?php echo $k ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" <?php echo $disabled; ?>>Save Changes</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#companyNav").addClass('active');
  });
</script>

