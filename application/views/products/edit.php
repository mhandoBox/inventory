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
      <form role="form" action="<?php echo base_url('Controller_Products/create') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
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
                  <label for="product_image">Product Image</label>
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="stock">Initial Stock</label>
                  <input type="number" class="form-control" id="stock" name="stock" min="0" placeholder="Enter initial stock" autocomplete="off" />
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
                    <?php endforeach ?>
                  </select>
                </div>
              <?php endforeach ?>
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
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category">Category</label>
                  <select class="form-control select_group" id="category" name="category" required>
                    <option value="">Select a category</option>
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
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
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="availability">Availability</label>
                  <select class="form-control" id="availability" name="availability" required>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
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
                  <label for="edit_product_image">Product Image</label>
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_stock">Stock</label>
                  <input type="number" class="form-control" id="edit_stock" name="stock" min="0" placeholder="Enter stock" autocomplete="off" />
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
                    <?php endforeach ?>
                  </select>
                </div>
              <?php endforeach ?>
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
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_category">Category</label>
                  <select class="form-control select_group" id="edit_category" name="category" required>
                    <option value="">Select a category</option>
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
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
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_availability">Availability</label>
                  <select class="form-control" id="edit_availability" name="availability" required>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(in_array('deleteProduct', $this->permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Remove Product</h4>
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
  $("#mainProductNav").addClass('active');

  // Initialize DataTable
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'print'],
    ajax: {
      url: base_url + 'Controller_Products/fetchProductData',
      type: 'GET',
      dataType: 'json',
      error: function(xhr, error, thrown) {
        console.error('DataTables error:', xhr.responseText);
        $('#messages').html('<div class="alert alert-danger">Error loading product data</div>');
      }
    },
    columns: [
      { data: 0 }, // Product name
      { data: 1 }, // Price
      { data: 2 }, // Unit
      { data: 3 }, // Warehouse
      { data: 4 }, // Stock
      { data: 5 }, // Availability
      { data: 6 }, // Actions
      { data: 7, visible: false } // ID (hidden)
    ]
  });

  // Initialize Select2
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

  // Initialize file input
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
    allowedFileExtensions: ["jpg", "png", "gif"],
    previewSettings: { image: {width: "100px", height: "100px"} }
  });

  // Edit product button handler
  $(document).on('click', '.edit-product', function() {
    var productId = $(this).data('id');
    $.ajax({
      url: base_url + 'Controller_Products/getProductData/' + productId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.error) {
          $('#messages').html('<div class="alert alert-danger">' + response.error + '</div>');
          return;
        }
        
        $('#edit_product_id').val(response.id);
        $('#edit_product_name').val(response.name);
        $('#edit_price').val(response.price);
        $('#edit_unit').val(response.unit).trigger('change');
        $('#edit_stock').val(response.stock);
        $('#edit_description').val(response.description);
        
        var attributes = response.attribute_value_id ? JSON.parse(response.attribute_value_id) : [];
        $('[name="attributes_value_id[]"]').each(function() {
          $(this).val(attributes).trigger('change');
        });

        $('#edit_brands').val(response.brand_id || '').trigger('change');
        $('#edit_category').val(response.category_id).trigger('change');
        $('#edit_store').val(response.store_id).trigger('change');
        $('#edit_availability').val(response.availability);

        $('#edit_product_image').fileinput('refresh', {
          initialPreview: response.image ? [base_url + response.image] : [],
          initialPreviewAsData: true,
          initialPreviewConfig: response.image ? [{caption: response.image.split('/').pop(), size: 0, key: 1}] : []
        });

        $('#editProductModal').modal('show');
      },
      error: function(xhr, status, error) {
        console.error('Edit product error:', xhr.responseText);
        $('#messages').html('<div class="alert alert-danger">Error loading product data</div>');
      }
    });
  });

  // Remove product handler
  window.removeFunc = function(id) {
    if (id) {
      $('#remove_product_id').val(id);
      $('#removeModal').modal('show');
    }
  };

  $('#removeForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      data: $(this).serialize(),
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $('#messages').html('<div class="alert alert-success">' + response.messages + '</div>');
          manageTable.ajax.reload(null, false);
        } else {
          $('#messages').html('<div class="alert alert-danger">' + response.messages + '</div>');
        }
        $('#removeModal').modal('hide');
      },
      error: function(xhr, status, error) {
        console.error('Remove error:', xhr.responseText);
        $('#messages').html('<div class="alert alert-danger">Error removing product</div>');
      }
    });
  });
});
</script>