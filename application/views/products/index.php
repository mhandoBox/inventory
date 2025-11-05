<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<style>
  .modal-content { border-radius: 6px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
  .modal-header { background-color: #3c8dbc; color: white; border-top-left-radius: 6px; border-top-right-radius: 6px; }
  .modal-title { font-weight: bold; }
  .form-group label { font-weight: 600; color: #333; }
  .select2-container .select2-selection--single, .select2-container .select2-selection--multiple {
    border: 1px solid #d2d6de; border-radius: 4px; padding: 6px 12px; height: 34px;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc; color: white; border-radius: 4px;
  }
  .file-input .file-preview { border: 1px solid #d2d6de; border-radius: 4px; }
  .btn-primary { background-color: #3c8dbc; border-color: #367fa9; }
  .btn-primary:hover { background-color: #367fa9; }
  .btn-danger { background-color: #dd4b39; border-color: #d73925; }
  .btn-danger:hover { background-color: #d73925; }
  .form-section { border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px; }
  .form-section h4 { font-size: 18px; color: #3c8dbc; margin-bottom: 10px; }
  .btn-sm { display: inline-block !important; visibility: visible !important; margin-right: 5px; }
  .btn-disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Products <small>Manage Products</small></h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createProduct', $this->permission)): ?>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Add Product</button>
          <br /><br />
        <?php endif; ?>

        <div class="box">
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Unit</th>
                  <th>Warehouse</th>
                  <th>Stock</th>
                  <th>Availability</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php if(in_array('createProduct', $this->permission)): ?>
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="addProductModalLabel">Add New Product</h4>
      </div>
      <form role="form" action="<?php echo base_url('Controller_Products/create') ?>" method="post" enctype="multipart/form-data" id="addProductForm">
        <div class="modal-body">
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          <?php if (empty($category)): ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              No active categories available. Please create a category first.
            </div>
          <?php endif; ?>
          <div class="form-section">
            <h4>Product Details</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" autocomplete="off" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="product_image">Product Image (Optional)</label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="product_image" name="product_image" type="file" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price">Price (TZS)</label>
                  <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter price" autocomplete="off" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="unit">Unit of Measurement</label>
                  <select class="form-control select_group" id="unit" name="unit" required>
                    <option value="">Select a unit</option>
                    <option value="pcs">Pieces (pcs)</option>
                    <option value="kg">Kilograms (kg)</option>
                    <option value="L">Liters (L)</option>
                    <option value="m">Meters (m)</option>
                    <option value="g">Grams (g)</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="4" autocomplete="off"></textarea>
            </div>
          </div>
          <div class="form-section">
            <h4>Product Attributes</h4>
            <?php if($attributes): ?>
              <?php foreach ($attributes as $k => $v): ?>
                <div class="form-group">
                  <label for="attributes_value_id_<?php echo $v['attribute_data']['id'] ?>"><?php echo $v['attribute_data']['name'] ?></label>
                  <select class="form-control select_group" id="attributes_value_id_<?php echo $v['attribute_data']['id'] ?>" name="attributes_value_id[]" multiple="multiple">
                    <?php foreach ($v['attribute_value'] as $k2 => $v2): ?>
                      <option value="<?php echo $v2['id'] ?>"><?php echo $v2['value'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="form-section">
            <h4>Product Categorization</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="brands">Brand</label>
                  <select class="form-control select_group" id="brands" name="brand">
                    <option value="">Select a brand</option>
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category">Category</label>
                  <select class="form-control select_group" id="category" name="category" required>
                    <?php if (empty($category)): ?>
                      <option value="">No categories available</option>
                    <?php else: ?>
                      <option value="">Select a category</option>
                      <?php foreach ($category as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="store">Warehouse</label>
                  <select class="form-control select_group" id="store" name="store" required>
                    <option value="">Select a warehouse</option>
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="availability">Availability</label>
                  <select class="form-control" id="availability" name="availability" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" <?php echo empty($category) ? 'disabled' : ''; ?>>Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('updateProduct', $this->permission)): ?>
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="editProductModalLabel">Edit Product</h4>
      </div>
      <form role="form" action="<?php echo base_url('Controller_Products/update') ?>" method="post" id="editProductForm" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
          <?php if (empty($category)): ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              No active categories available. Please create a category first.
            </div>
          <?php endif; ?>
          <input type="hidden" id="edit_product_id" name="product_id">
          <div class="form-section">
            <h4>Product Details</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_product_name">Product Name</label>
                  <input type="text" class="form-control" id="edit_product_name" name="product_name" placeholder="Enter product name" autocomplete="off" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_product_image">Product Image (Optional)</label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="edit_product_image" name="product_image" type="file" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_price">Price (TZS)</label>
                  <input type="number" step="0.01" class="form-control" id="edit_price" name="price" placeholder="Enter price" autocomplete="off" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_unit">Unit of Measurement</label>
                  <select class="form-control select_group" id="edit_unit" name="unit" required>
                    <option value="">Select a unit</option>
                    <option value="pcs">Pieces (pcs)</option>
                    <option value="kg">Kilograms (kg)</option>
                    <option value="L">Liters (L)</option>
                    <option value="m">Meters (m)</option>
                    <option value="g">Grams (g)</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="edit_description">Description</label>
              <textarea class="form-control" id="edit_description" name="description" placeholder="Enter description" rows="4" autocomplete="off"></textarea>
            </div>
          </div>
          <div class="form-section">
            <h4>Product Attributes</h4>
            <?php if($attributes): ?>
              <?php foreach ($attributes as $k => $v): ?>
                <div class="form-group">
                  <label for="edit_attributes_value_id_<?php echo $v['attribute_data']['id'] ?>"><?php echo $v['attribute_data']['name'] ?></label>
                  <select class="form-control select_group" id="edit_attributes_value_id_<?php echo $v['attribute_data']['id'] ?>" name="attributes_value_id[]" multiple="multiple">
                    <?php foreach ($v['attribute_value'] as $k2 => $v2): ?>
                      <option value="<?php echo $v2['id'] ?>"><?php echo $v2['value'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="form-section">
            <h4>Product Categorization</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_brands">Brand</label>
                  <select class="form-control select_group" id="edit_brands" name="brand">
                    <option value="">Select a brand</option>
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_category">Category</label>
                  <select class="form-control select_group" id="edit_category" name="category" required>
                    <?php if (empty($category)): ?>
                      <option value="">No categories available</option>
                    <?php else: ?>
                      <option value="">Select a category</option>
                      <?php foreach ($category as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_store">Warehouse</label>
                  <select class="form-control select_group" id="edit_store" name="store" required>
                    <option value="">Select a warehouse</option>
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_availability">Availability</label>
                  <select class="form-control" id="edit_availability" name="availability" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" <?php echo empty($category) ? 'disabled' : ''; ?>>Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('deleteProduct', $this->permission)): ?>
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="removeModalLabel">Remove Product</h4>
      </div>
      <form role="form" action="<?php echo base_url('Controller_Products/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
          <input type="hidden" name="product_id" id="remove_product_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  if (typeof $ === 'undefined') {
    $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
      '<strong>Error!</strong> jQuery is not loaded. Check your script includes.' +
    '</div>');
    return;
  }

  if (typeof $.fn.DataTable === 'undefined') {
    $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
      '<strong>Error!</strong> DataTables is not loaded. Check your script includes.' +
    '</div>');
    return;
  }

  $("#mainProductNav").addClass('active');

  manageTable = $('#manageTable').DataTable({
    dom: 'Blfrtip', // added "l" (length menu) so users can change page size; retains buttons and pagination
    buttons: ['copy', 'csv', 'excel', 'print'],
    paging: true,
    pagingType: 'simple_numbers', // clearer pagination controls (Prev / page numbers / Next)
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']], // page-size options
    ajax: {
      url: base_url + 'Controller_Products/fetchProductData',
      dataSrc: function(json) {
        if (!json || !json.data) {
          $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong>Error!</strong> No data received from server. Check console for details.' +
          '</div>');
          return [];
        }
        if (json.data.length === 0) {
          $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong>Warning!</strong> No products available in the database.' +
          '</div>');
        }
        return json.data;
      },
      error: function(xhr, error, thrown) {
        $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
          '<strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')' +
        '</div>');
      }
    },
    order: [],
    columnDefs: [{
      targets: -1,
      data: null,
      render: function(data, type, row) {
        var productId = row.id;
        if (!productId) {
          return '<span class="text-danger">No ID</span>';
        }
        var buttons = '';
        var hasUpdatePermission = <?php echo in_array('updateProduct', $this->permission) ? 'true' : 'false'; ?>;
        var hasDeletePermission = <?php echo in_array('deleteProduct', $this->permission) ? 'true' : 'false'; ?>;
        buttons += '<button class="btn btn-warning btn-sm edit-product' + (hasUpdatePermission ? '' : ' btn-disabled') + '" data-id="' + productId + '"' + (hasUpdatePermission ? '' : ' disabled') + '><i class="fa fa-pencil"></i> Edit</button>';
        buttons += ' <button type="button" class="btn btn-danger btn-sm delete-product' + (hasDeletePermission ? '' : ' btn-disabled') + '" data-id="' + productId + '"' + (hasDeletePermission ? '' : ' disabled') + '><i class="fa fa-trash"></i> Delete</button>';
        return buttons || '<span class="text-muted">No actions</span>';
      }
    }],
    columns: [
      { data: 'name' },
      { data: 'price' },
      { data: 'unit_status' },
      { data: 'warehouse' },
      { data: 'stock' },
      { data: 'availability' },
      { data: 'actions' },
      { data: 'id', visible: false }
    ]
  });

  if (typeof $.fn.select2 !== 'undefined') {
    $(".select_group").select2({
      width: '100%',
      placeholder: function() {
        return $(this).attr('id').includes('store') ? 'Select a warehouse' :
               $(this).attr('id').includes('brands') ? 'Select a brand' :
               $(this).attr('id').includes('category') ? 'Select a category' :
               $(this).attr('id').includes('unit') ? 'Select a unit' :
               $(this).attr('id').includes('attributes') ? 'Select attributes' : 'Select an option';
      }
    });
  } else {
    $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
      '<strong>Error!</strong> Select2 is not loaded. Check your script includes.' +
    '</div>');
  }

  if (typeof $.fn.fileinput !== 'undefined') {
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="fa fa-tag"></i></button>';
    $("#product_image, #edit_product_image").fileinput({
      overwriteInitial: true,
      maxFileSize: 1500,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseIcon: '<i class="fa fa-folder-open"></i>',
      removeIcon: '<i class="fa fa-times"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      layoutTemplates: {main2: '{preview} ' + btnCust + ' {remove} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"],
      previewSettings: { image: {width: "100px", height: "100px"} }
    });
  } else {
    $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
      '<strong>Error!</strong> FileInput is not loaded. Check your script includes.' +
    '</div>');
  }

  $(document).on('click', '.edit-product:not(.btn-disabled)', function(e) {
    e.preventDefault();
    var productId = $(this).data('id');
    $.ajax({
      url: base_url + 'Controller_Products/getProductData/' + productId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response && response.id) {
          $('#edit_product_id').val(response.id);
          $('#edit_product_name').val(response.name);
          $('#edit_price').val(response.price);
          $('#edit_unit').val(response.unit).trigger('change');
          $('#edit_description').val(response.description);
          
          var attributes = response.attribute_value_id ? JSON.parse(response.attribute_value_id) : [];
          $('[name="attributes_value_id[]"]').each(function() {
            $(this).val(attributes).trigger('change');
          });

          $('#edit_brands').val(response.brand_id || '').trigger('change');
          $('#edit_category').val(response.category_id).trigger('change');
          $('#edit_store').val(response.store_id).trigger('change');
          $('#edit_availability').val(response.availability);

          if (typeof $.fn.fileinput !== 'undefined') {
            $('#edit_product_image').fileinput('refresh', {
              initialPreview: response.image ? [base_url + response.image] : [],
              initialPreviewAsData: true,
              initialPreviewConfig: response.image ? [{caption: response.image.split('/').pop(), size: 0, key: 1}] : []
            });
          }

          if (typeof $.fn.modal !== 'undefined') {
            $('#editProductModal').modal('show');
          } else {
            $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
              '<strong>Error!</strong> Bootstrap modal is not loaded. Check your script includes.' +
            '</div>');
          }
        } else {
          $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong>Error!</strong> Unable to fetch product data. Check console for details.' +
          '</div>');
        }
      },
      error: function(xhr, error, thrown) {
        $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
          '<strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')' +
        '</div>');
      }
    });
  });

  $(document).on('click', '.delete-product:not(.btn-disabled)', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var productId = $(this).data('id');
    try {
      if (productId) {
        $('#remove_product_id').val(productId);
        if (typeof $.fn.modal !== 'undefined') {
          $('#removeModal').modal({
            backdrop: 'static',
            keyboard: false
          }).modal('show');
        } else {
          $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong>Error!</strong> Bootstrap modal is not loaded. Check your script includes.' +
          '</div>');
        }
      } else {
        $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
          '<strong>Error!</strong> Invalid product ID.' +
        '</div>');
      }
    } catch (err) {
      $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
        '<strong>Error!</strong> An error occurred while opening the delete modal. Check console for details.' +
      '</div>');
    }
  });

  $("#removeForm").on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    $(".text-danger").remove();
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),
      dataType: 'json',
      success: function(response) {
        manageTable.ajax.reload(null, false);
        if (response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> ' + response.messages +
          '</div>');
          $("#removeModal").modal('hide');
        } else {
          $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong> ' + response.messages +
          '</div>');
        }
      },
      error: function(xhr, error, thrown) {
        $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
          '<strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')' +
        '</div>');
      }
    });
  });

  $("#addProductForm, #editProductForm").on('submit', function(e) {
    var category = $(this).find('[name="category"]').val();
    if (!category || category === '') {
      e.preventDefault();
      $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
        '<strong>Error!</strong> Please select a valid category.' +
      '</div>');
    }
  });

  $("#addProductForm").on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);
    $(".text-danger").remove();
    $("#messages").html('');
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: formData,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(response) {
        if (response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> ' + response.messages +
          '</div>');
          $("#addProductModal").modal('hide');
          manageTable.ajax.reload(null, false);
          form[0].reset();
        } else {
          $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
            '<strong>Error!</strong> ' + response.messages +
          '</div>');
        }
      },
      error: function(xhr, error, thrown) {
        $("#messages").html('<div class="alert alert-error alert-dismissible" role="alert">' +
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
          '<strong>Error!</strong> AJAX request failed: ' + xhr.statusText + ' (Status: ' + xhr.status + ')' +
        '</div>');
      }
    });
  });

  if ($('#messages .alert-error').length) {
    $('#addProductModal').modal('show');
  }
});
</script>