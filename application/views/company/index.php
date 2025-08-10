<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$readonly = empty($can_edit_company) ? 'readonly disabled' : '';
$disabled = empty($can_edit_company) ? 'disabled' : '';
?>

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Manage Company Information
            <small>Update company details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Company</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <!-- Alerts -->
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <!-- Company Form Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-building"></i> Company Details</h3>
                    </div>

                    <form role="form" action="<?php echo base_url('Controller_Company/index'); ?>" method="post" 
                          enctype="multipart/form-data" id="companyForm">
                        <div class="box-body">
                            <?php echo validation_errors(); ?>

                            <!-- Company Branding Section -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Logo Section -->
                                    <div class="form-group">
                                        <label for="logo">Company Logo</label>
                                        <?php if($company_data['logo']): ?>
                                            <div class="image-preview mb-2">
                                                <img src="<?php echo base_url().'assets/images/'.$company_data['logo'] ?>" 
                                                     class="img-thumbnail" alt="Company Logo" 
                                                     style="max-width: 150px;">
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" class="form-control image-input" id="logo" name="logo" 
                                               accept="image/*" <?php echo $disabled; ?>>
                                        <small class="text-muted">Recommended size: 200x200px</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Company Image Section -->
                                    <div class="form-group">
                                        <label for="image">Company Image</label>
                                        <?php if($company_data['image']): ?>
                                            <div class="image-preview mb-2">
                                                <img src="<?php echo base_url().'assets/images/'.$company_data['image'] ?>" 
                                                     class="img-thumbnail" alt="Company Image" 
                                                     style="max-width: 150px;">
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" class="form-control image-input" id="image" name="image" 
                                               accept="image/*" <?php echo $disabled; ?>>
                                        <small class="text-muted">Recommended size: 800x400px</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Information Section -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">Company Name*</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" 
                                               placeholder="Enter company name" 
                                               value="<?php echo $company_data['company_name'] ?>" 
                                               required <?php echo $readonly; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="registration">Registration Number*</label>
                                        <input type="text" class="form-control" id="registration" name="registration" 
                                               placeholder="Enter registration number" 
                                               value="<?php echo $company_data['registration'] ?>" 
                                               required <?php echo $readonly; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="tin">TIN Number*</label>
                                        <input type="text" class="form-control" id="tin" name="tin" 
                                               placeholder="Enter TIN number" 
                                               value="<?php echo $company_data['tin'] ?>" 
                                               required <?php echo $readonly; ?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               placeholder="Enter phone" 
                                               value="<?php echo $company_data['phone'] ?>" 
                                               <?php echo $readonly; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address*</label>
                                        <textarea class="form-control" id="address" name="address" 
                                                  placeholder="Enter address" rows="2" 
                                                  required <?php echo $readonly; ?>><?php echo $company_data['address'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" 
                                               placeholder="Enter country" 
                                               value="<?php echo $company_data['country'] ?>" 
                                               <?php echo $readonly; ?>>
                                    </div>
                                </div>
                            </div>

                            <!-- Financial Settings Section -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="service_charge_value">Service Charge (%)</label>
                                        <input type="number" class="form-control" id="service_charge_value" 
                                               name="service_charge_value" min="0" max="100" step="0.01" 
                                               placeholder="Enter charge amount %" 
                                               value="<?php echo $company_data['service_charge_value'] ?>" 
                                               <?php echo $readonly; ?>>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vat_charge_value">VAT Charge (%)</label>
                                        <input type="number" class="form-control" id="vat_charge_value" 
                                               name="vat_charge_value" min="0" max="100" step="0.01" 
                                               placeholder="Enter vat charge %" 
                                               value="<?php echo $company_data['vat_charge_value'] ?>" 
                                               <?php echo $readonly; ?>>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="currency">Currency*</label>
                                        <select class="form-control" id="currency" name="currency" 
                                                required <?php echo $disabled; ?>>
                                            <option value="">Select Currency</option>
                                            <?php foreach ($currency_symbols as $k => $v): ?>
                                                <option value="<?php echo trim($k); ?>" 
                                                    <?php echo ($company_data['currency'] == $k) ? 'selected' : ''; ?>>
                                                    <?php echo $k . ' (' . $v . ')'; ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Message Section -->
                            <div class="form-group">
                                <label for="message">Invoice Footer Message</label>
                                <textarea class="form-control" id="message" name="message" 
                                          placeholder="Enter message" rows="3" 
                                          <?php echo $readonly; ?>><?php echo $company_data['message'] ?></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" <?php echo $disabled; ?>">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#companyNav").addClass('active');
    
    // Image preview
    function readURL(input, previewElement) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(previewElement).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logo, #image").change(function() {
        var previewElement = $(this).siblings('.image-preview').find('img');
        readURL(this, previewElement);
    });

    // Enhanced image preview function
    function previewImage(input) {
        const previewContainer = $(input).closest('.form-group').find('.image-preview');
        const previewImg = previewContainer.find('.preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.attr('src', e.target.result);
                previewContainer.show();
            }
            
            reader.onerror = function() {
                alert('Error loading image');
            }
            
            // Validate file size
            const fileSize = input.files[0].size / 1024 / 1024; // in MB
            const maxSize = $(input).attr('id') === 'logo' ? 2 : 5; // 2MB for logo, 5MB for company image
            
            if (fileSize > maxSize) {
                alert(`File size exceeds ${maxSize}MB limit`);
                input.value = '';
                return;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Handle file input change
    $('.image-input').on('change', function() {
        previewImage(this);
    });
});
</script>

