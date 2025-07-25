<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?>
          <?php if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
            <li id="brandNav">
              <a href="<?php echo base_url('Controller_Items/') ?>">
                <i class="fa fa-cubes"></i> <span>Items</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <li id="categoryNav">
              <a href="<?php echo base_url('Controller_Category/') ?>">
                <i class="fa fa-th"></i> <span>Category</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            <li id="storeNav">
              <a href="<?php echo base_url('Controller_Warehouse/') ?>">
                <i class="fa fa-institution"></i> <span>Warehouse</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
            <li id="attributeNav">
              <a href="<?php echo base_url('Controller_Element/') ?>">
                <i class="fa fa-files-o"></i> <span>Elements</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('viewReport', $user_permission)): ?>
            <li><a href="<?php echo base_url('Controller_Expenses'); ?>"><i class="fa fa-money"></i> <span>Company Expenses</span></a></li>
          <?php endif; ?>

          <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Products</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                  <li id="manageProductNav"><a href="<?php echo base_url('Controller_Products') ?>"><i class="fa fa-circle-o"></i> Manage Products</a></li>
                <?php endif; ?>
                <li id="purchasesNav"><a href="<?php echo base_url('Controller_Products/purchases') ?>"><i class="fa fa-circle-o"></i> Purchases</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('Controller_Orders/create') ?>"><i class="fa fa-circle-o"></i> Add Order</a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                  <li id="manageOrdersNav"><a href="<?php echo base_url('Controller_Orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
                <?php endif; ?>
                <li id="quotationViewNav"><a href="<?php echo base_url('orders/quotation_view') ?>"><i class="fa fa-circle-o"></i> Quotation View</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('viewReport', $user_permission)): ?>
            <li class="treeview" id="mainReportsNav">
              <a href="#">
                <i class="glyphicon glyphicon-stats"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="salesReportNav"><a href="<?php echo base_url('Controller_Reports/sales_report') ?>"><i class="fa fa-circle-o"></i> Sales Report</a></li>
                <li id="stockReportNav"><a href="<?php echo base_url('Controller_Reports/stock_report') ?>"><i class="fa fa-circle-o"></i> Stock Report</a></li>
                <li id="purchaseReportNav"><a href="<?php echo base_url('Controller_Reports/purchase_report') ?>"><i class="fa fa-circle-o"></i> Purchase Report</a></li>
                <li id="expenseReportNav"><a href="<?php echo base_url('Controller_Reports/expense_report') ?>"><i class="fa fa-circle-o"></i> Expense Report</a></li>
                <li id="generalReportNav"><a href="<?php echo base_url('Controller_Reports/general_report') ?>"><i class="fa fa-circle-o"></i> General Report</a></li>
                <li id="legacyReportNav"><a href="<?php echo base_url('reports/') ?>"><i class="fa fa-circle-o"></i> Annual Overview</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php /* Accounting menu temporarily disabled
          if(in_array('viewAccounting', $user_permission) || in_array('reportAccounting', $user_permission)): ?>
            <li class="treeview" id="mainAccountingNav">
              <a href="#">
                <i class="fa fa-calculator"></i>
                <span>Accounting</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="accountingDashboardNav">
                  <a href="<?php echo base_url('accounting'); ?>">
                    <i class="fa fa-dashboard"></i> Dashboard
                  </a>
                </li>
                <li id="chartOfAccountsNav">
                  <a href="<?php echo base_url('accounting/chart_of_accounts'); ?>">
                    <i class="fa fa-list"></i> Chart of Accounts
                  </a>
                </li>
                <li id="accountManagementNav">
                  <a href="<?php echo base_url('accounting/accounts'); ?>">
                    <i class="fa fa-cogs"></i> Account Management
                  </a>
                </li>
                <li id="journalEntryNav">
                  <a href="<?php echo base_url('accounting/journal_entry'); ?>">
                    <i class="fa fa-pencil"></i> Journal Entry
                  </a>
                </li>
                <li id="trialBalanceNav">
                  <a href="<?php echo base_url('accounting/trial_balance'); ?>">
                    <i class="fa fa-balance-scale"></i> Trial Balance
                  </a>
                </li>
                <li id="incomeStatementNav">
                  <a href="<?php echo base_url('accounting/income_statement'); ?>">
                    <i class="fa fa-line-chart"></i> Income Statement
                  </a>
                </li>
                <li id="balanceSheetNav">
                  <a href="<?php echo base_url('accounting/balance_sheet'); ?>">
                    <i class="fa fa-book"></i> Balance Sheet
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; */
          ?>

          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="mainUserNav">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Members</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createUser', $user_permission)): ?>
                  <li id="createUserNav"><a href="<?php echo base_url('Controller_Members/create') ?>"><i class="fa fa-circle-o"></i> Add Members</a></li>
                <?php endif; ?>
                <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                  <li id="manageUserNav"><a href="<?php echo base_url('Controller_Members') ?>"><i class="fa fa-circle-o"></i> Manage Members</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-recycle"></i>
                <span>Permission</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('Controller_Permission/create') ?>"><i class="fa fa-circle-o"></i> Add Permission</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                  <li id="manageGroupNav"><a href="<?php echo base_url('Controller_Permission') ?>"><i class="fa fa-circle-o"></i> Manage Permission</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('updateCompany', $user_permission)): ?>
            <li id="companyNav"><a href="<?php echo base_url('Controller_Company/') ?>"><i class="fa fa-bank"></i> <span>Company</span></a></li>
          <?php endif; ?>
        <?php endif; ?>

        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>