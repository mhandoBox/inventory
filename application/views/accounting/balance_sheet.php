<div class="content-wrapper">
    <section class="content-header">
        <h1>Balance Sheet</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Controller_accounting') ?>">Accounting</a></li>
            <li class="active">Balance Sheet</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Balance Sheet</h3>
                        
                        <form method="get" class="form-inline pull-right">
                            <div class="form-group">
                                <label>As of: </label>
                                <input type="date" name="as_of_date" class="form-control input-sm" value="<?php echo $as_of_date; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </form>
                    </div>
                    
                    <div class="box-body">
                        <div class="row">
                            <!-- Assets Column -->
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th colspan="2">Assets</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($balance_sheet['assets'] as $asset): ?>
                                        <tr>
                                            <td><?php echo $asset->account_name; ?></td>
                                            <td class="text-right"><?php echo number_format($asset->balance, 2); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="bg-info">
                                            <th>Total Assets</th>
                                            <th class="text-right"><?php echo number_format($balance_sheet['total_assets'], 2); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Liabilities and Equity Column -->
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th colspan="2">Liabilities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($balance_sheet['liabilities'] as $liability): ?>
                                        <tr>
                                            <td><?php echo $liability->account_name; ?></td>
                                            <td class="text-right"><?php echo number_format($liability->balance, 2); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="bg-info">
                                            <th>Total Liabilities</th>
                                            <th class="text-right"><?php echo number_format($balance_sheet['total_liabilities'], 2); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th colspan="2">Equity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($balance_sheet['equity'] as $equity): ?>
                                        <tr>
                                            <td><?php echo $equity->account_name; ?></td>
                                            <td class="text-right"><?php echo number_format($equity->balance, 2); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="bg-info">
                                            <th>Total Equity</th>
                                            <th class="text-right"><?php echo number_format($balance_sheet['total_equity'], 2); ?></th>
                                        </tr>
                                        <tr class="bg-success">
                                            <th>Total Liabilities and Equity</th>
                                            <th class="text-right"><?php echo number_format($balance_sheet['total_liabilities'] + $balance_sheet['total_equity'], 2); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
