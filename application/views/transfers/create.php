<?php
<div class="content-wrapper">
    <section class="content-header">
        <h1>Stock Transfer <small>Create New Transfer</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create Transfer</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Create Stock Transfer</h3>
                    </div>
                    <form role="form" action="<?php echo base_url('Controller_Transfers/createTransfer') ?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>From Store</label>
                                <select class="form-control" name="from_store_id" required>
                                    <option value="">Select Store</option>
                                    <?php foreach ($stores as $store): ?>
                                        <option value="<?php echo $store['id'] ?>">
                                            <?php echo $store['name'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>To Store</label>
                                <select class="form-control" name="to_store_id" required>
                                    <option value="">Select Store</option>
                                    <?php foreach ($stores as $store): ?>
                                        <option value="<?php echo $store['id'] ?>">
                                            <?php echo $store['name'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product</label>
                                <select class="form-control select_group product" name="product_id" required>
                                    <option value="">Select Product</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id'] ?>">
                                            <?php echo $product['name'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="qty" min="1" required>
                            </div>

                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create Transfer</button>
                            <a href="<?php echo base_url('Controller_Transfers') ?>" class="btn btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>