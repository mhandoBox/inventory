<!-- filepath: c:\xampp\htdocs\Inventory_CI\application\views\products\add_stock.php -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>Add Stock to Existing Product</h1>
  </section>
  <section class="content">
    <div class="row justify-content-center">
      <div class="col-md-6 col-xs-12"><!-- Changed to medium size -->
        <div class="box">
          <form action="<?php echo base_url('Controller_Products/addStock'); ?>" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="product_id">Select Product</label>
                <select class="form-control" id="product_id" name="product_id" required>
                  <option value="">Select Product</option>
                  <?php foreach($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="qty">Quantity to Add</label>
                <input type="number" class="form-control" id="qty" name="qty" min="1" required>
              </div>
              <div class="form-group">
                <label for="supplier">Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier" required>
              </div>
              <div class="form-group">
                <label for="price">Price per Unit</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
              </div>
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Add Stock</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>