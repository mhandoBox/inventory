<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if(!empty($is_admin) || !empty($is_manager)): ?>

        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Revenue</span>
                <span class="info-box-number">
                  <?php 
                    $query = $this->db->query('
                        SELECT 
                            COALESCE(SUM(net_amount), 0) as total, 
                            COUNT(*) as order_count,
                            SUM(CASE WHEN paid_status = 1 THEN net_amount ELSE 0 END) as paid_amount,
                            SUM(CASE WHEN paid_status = 2 THEN net_amount ELSE 0 END) as partial_amount,
                            SUM(CASE WHEN paid_status = 3 THEN net_amount ELSE 0 END) as unpaid_amount
                        FROM orders 
                        WHERE paid_status IN (1, 2, 3)
                    ');
                    if ($query && $result = $query->row()) {
                        echo number_format($result->total, 2);
                        $order_count = $result->order_count;
                        $paid_amount = $result->paid_amount;
                        $partial_amount = $result->partial_amount;
                        $unpaid_amount = $result->unpaid_amount;
                    } else {
                        echo '0.00';
                        $order_count = 0;
                    }
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small>From <?php echo number_format($order_count); ?> orders</small><br>
                  <small class="text-success">Paid: <?php echo number_format($paid_amount, 2); ?></small><br>
                  <small class="text-warning">Partial: <?php echo number_format($partial_amount, 2); ?></small><br>
                  <small class="text-danger">Unpaid: <?php echo number_format($unpaid_amount, 2); ?></small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Average Order Value</span>
                <span class="info-box-number">
                  <?php 
                    $avg_order = isset($order_count) && $order_count > 0 ? $result->total / $order_count : 0;
                    echo number_format($avg_order, 2);
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small>Per Order Average</small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-blue"><i class="fa fa-line-chart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Today's Sales</span>
                <span class="info-box-number">
                  <?php 
                    $today_query = $this->db->query('
                        SELECT 
                            COALESCE(SUM(net_amount), 0) as total,
                            COUNT(*) as count,
                            SUM(CASE WHEN paid_status = 1 THEN net_amount ELSE 0 END) as paid,
                            SUM(CASE WHEN paid_status = 2 THEN net_amount ELSE 0 END) as partial,
                            SUM(CASE WHEN paid_status = 3 THEN net_amount ELSE 0 END) as unpaid
                        FROM orders 
                        WHERE DATE(date_time) = CURDATE()
                    ');
                    if ($today_query && $today_result = $today_query->row()) {
                        echo number_format($today_result->total, 2);
                        $today_count = $today_result->count;
                    } else {
                        echo '0.00';
                        $today_count = 0;
                    }
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small><?php echo date('d M Y'); ?> (<?php echo $today_count; ?> orders)</small><br>
                  <small class="text-success">Paid: <?php echo number_format($today_result->paid, 2); ?></small><br>
                  <small class="text-warning">Partial: <?php echo number_format($today_result->partial, 2); ?></small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-credit-card"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Payments</span>
                <span class="info-box-number">
                  <?php 
                    $unpaid_query = $this->db->query('SELECT SUM(net_amount) as total FROM orders WHERE paid_status = 2');
                    echo number_format($unpaid_query->row()->total ?? 0, 2);
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small>From unpaid orders</small>
                </span>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Products</span>
                <span class="info-box-number"><?php echo number_format($total_products); ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Completed Orders</span>
                <span class="info-box-number"><?php echo number_format($total_paid_orders); ?></span>
                <span class="info-box-text text-muted">
                  <small>Paid & Delivered</small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-clock-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Orders</span>
                <span class="info-box-number">
                  <?php
                    $pending_query = $this->db->query('SELECT COUNT(*) as count FROM orders WHERE paid_status = 2');
                    echo number_format($pending_query->row()->count);
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small>Awaiting Payment</small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-purple"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Active Members</span>
                <span class="info-box-number"><?php echo number_format($total_users); ?></span>
                <span class="info-box-text text-muted">
                  <small>System Users</small>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-building"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Warehouses</span>
                <span class="info-box-number"><?php echo number_format($total_stores); ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-olive"><i class="fa fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">This Month Orders</span>
                <span class="info-box-number">
                  <?php
                    $month_query = $this->db->query('SELECT COUNT(*) as count FROM orders WHERE MONTH(date_time) = MONTH(CURRENT_DATE()) AND YEAR(date_time) = YEAR(CURRENT_DATE())');
                    echo number_format($month_query->row()->count);
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small><?php echo date('F Y'); ?></small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-teal"><i class="fa fa-dollar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Monthly Revenue</span>
                <span class="info-box-number">
                  <?php
                    $revenue_query = $this->db->query('
                        SELECT 
                            SUM(net_amount) as total,
                            COUNT(*) as count,
                            SUM(CASE WHEN paid_status = 1 THEN net_amount ELSE 0 END) as paid,
                            SUM(CASE WHEN paid_status = 2 THEN net_amount ELSE 0 END) as partial,
                            SUM(CASE WHEN paid_status = 3 THEN net_amount ELSE 0 END) as unpaid
                        FROM orders 
                        WHERE MONTH(date_time) = MONTH(CURRENT_DATE()) 
                        AND YEAR(date_time) = YEAR(CURRENT_DATE())
                    ');
                    $monthly_data = $revenue_query->row();
                    echo number_format($monthly_data->total ?? 0, 2);
                  ?>
                </span>
                <span class="info-box-text text-muted">
                  <small>This Month (<?php echo $monthly_data->count; ?> orders)</small><br>
                  <small class="text-success">Paid: <?php echo number_format($monthly_data->paid, 2); ?></small><br>
                  <small class="text-warning">Partial: <?php echo number_format($monthly_data->partial, 2); ?></small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-maroon"><i class="fa fa-refresh"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Stock Turnover</span>
                <span class="info-box-number">
                  N/A
                </span>
                <span class="info-box-text text-muted">
                  <small>Stock turnover calculation not available</small>
                </span>
                <span class="info-box-text text-muted">
                  <small>Monthly Rate</small>
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- Analytics Charts -->
        <div class="row">
          <!-- Revenue Trend Chart -->
          <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Revenue Analytics</h3>
              </div>
              <div class="box-body">
                <canvas id="revenueChart" style="height: 300px;"></canvas>
              </div>
            </div>
          </div>

          <!-- Order Statistics Chart -->
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Order Statistics</h3>
              </div>
              <div class="box-body">
                <canvas id="orderChart" style="height: 300px;"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Inventory Status Chart -->
          <div class="col-md-6">
            <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title">Inventory Status</h3>
              </div>
              <div class="box-body">
                <canvas id="inventoryChart" style="height: 300px;"></canvas>
              </div>
            </div>
          </div>

          <!-- Top Products Chart -->
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Top Selling Products</h3>
              </div>
              <div class="box-body">
                <canvas id="productsChart" style="height: 300px;"></canvas>
              </div>
            </div>
          </div>
        </div>
        
        <!-- /.row -->
      <?php endif; ?>

      <?php
        // Initialize arrays to store chart data
        $revenue_data = array();
        $labels = array();
        $order_data = array();
        $top_products = array();
        $inventory_status = (object)['normal' => 0, 'low' => 0, 'out' => 0];

        try {
            // Last 6 months revenue data
            for($i = 5; $i >= 0; $i--) {
                $month = date('Y-m', strtotime("-$i months"));
                $labels[] = date('M Y', strtotime("-$i months"));
                
                $revenue_query = $this->db->query("
                    SELECT COALESCE(SUM(net_amount), 0) as total 
                    FROM orders 
                    WHERE paid_status = 1 
                    AND DATE_FORMAT(date_time, '%Y-%m') = ?",
                    array($month)
                );
                
                if ($revenue_query && $result = $revenue_query->row()) {
                    $revenue_data[] = $result->total;
                } else {
                    $revenue_data[] = 0;
                }
            }

            // Order statistics for current month
            $current_month = date('Y-m');
            for($i = 1; $i <= date('t'); $i++) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                $date = "$current_month-$day";
                
                $orders_query = $this->db->query("
                    SELECT COUNT(*) as count 
                    FROM orders 
                    WHERE DATE(date_time) = ?",
                    array($date)
                );
                
                if ($orders_query && $result = $orders_query->row()) {
                    $order_data[] = $result->count;
                } else {
                    $order_data[] = 0;
                }
            }

            // Inventory status
            $normal_query = $this->db->query("
                SELECT COUNT(*) as count 
                FROM products 
                WHERE quantity > minimum_quantity"
            );
            if ($normal_query && $result = $normal_query->row()) {
                $inventory_status->normal = $result->count;
            }

            $low_query = $this->db->query("
                SELECT COUNT(*) as count 
                FROM products 
                WHERE quantity <= minimum_quantity 
                AND quantity > 0 
                AND minimum_quantity > 0"
            );
            if ($low_query && $result = $low_query->row()) {
                $inventory_status->low = $result->count;
            }

            $out_query = $this->db->query("
                SELECT COUNT(*) as count 
                FROM products 
                WHERE quantity = 0"
            );
            if ($out_query && $result = $out_query->row()) {
                $inventory_status->out = $result->count;
            }

            // Top 10 selling products
            $products_query = $this->db->query("
                SELECT p.name, 
                       COALESCE(SUM(oi.qty), 0) as total_sold
                FROM products p
                LEFT JOIN order_items oi ON p.id = oi.product_id
                LEFT JOIN orders o ON oi.order_id = o.id
                WHERE o.paid_status = 1
                GROUP BY p.id, p.name
                ORDER BY total_sold DESC
                LIMIT 10"
            );
            
            if ($products_query) {
                $top_products = $products_query->result();
            }
        } catch (Exception $e) {
            log_message('error', 'Dashboard Chart Data Error: ' . $e->getMessage());
        }
      ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $("#dashboardMainMenu").addClass('active');

      // Revenue Chart
      new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
          labels: <?php echo json_encode($labels); ?>,
          datasets: [{
            label: 'Total Revenue',
            data: <?php echo json_encode($revenue_data); ?>,
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.2)',
            borderWidth: 2
          }, {
            label: 'Paid Orders',
            data: <?php echo json_encode($paid_data); ?>,
            borderColor: '#28a745',
            backgroundColor: 'transparent',
            borderWidth: 2
          }, {
            label: 'Partial Payments',
            data: <?php echo json_encode($partial_data); ?>,
            borderColor: '#ffc107',
            backgroundColor: 'transparent',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          plugins: {
            title: {
              display: true,
              text: 'Revenue Breakdown (Last 6 Months)'
            }
          }
        }
      });

      // Order Statistics Chart
      new Chart(document.getElementById('orderChart'), {
        type: 'bar',
        data: {
          labels: Array.from({length: <?php echo date('t'); ?>}, (_, i) => i + 1),
          datasets: [{
            label: 'Daily Orders',
            data: <?php echo json_encode($order_data); ?>,
            backgroundColor: 'rgba(0, 123, 255, 0.6)',
            borderColor: '#0056b3',
            borderWidth: 1,
            borderRadius: 4,
            maxBarThickness: 20,
            hoverBackgroundColor: 'rgba(0, 123, 255, 0.8)'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            title: {
              display: true,
              text: 'Daily Orders (Current Month)',
              font: {
                size: 16,
                weight: 'bold'
              },
              padding: 20
            },
            legend: {
              labels: {
                font: {
                  size: 12
                }
              }
            },
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              titleFont: {
                size: 13
              },
              bodyFont: {
                size: 13
              },
              padding: 12
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: 'rgba(0, 0, 0, 0.05)',
                drawBorder: false
              },
              ticks: {
                stepSize: 1,
                font: {
                  size: 11
                },
                padding: 8
              }
            },
            x: {
              grid: {
                display: false
              },
              ticks: {
                font: {
                  size: 11
                },
                padding: 8
              }
            }
          }
        }
      });

      // Inventory Status Chart
      new Chart(document.getElementById('inventoryChart'), {
        type: 'doughnut',
        data: {
          labels: ['Normal Stock', 'Low Stock', 'Out of Stock'],
          datasets: [{
            data: [
              <?php echo $inventory_status->normal; ?>,
              <?php echo $inventory_status->low; ?>,
              <?php echo $inventory_status->out; ?>
            ],
            backgroundColor: [
              'rgba(40, 167, 69, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(220, 53, 69, 0.8)'
            ],
            borderColor: [
              '#28a745',
              '#ffc107',
              '#dc3545'
            ],
            borderWidth: 2,
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '65%',
          radius: '90%',
          plugins: {
            title: {
              display: true,
              text: 'Inventory Status Overview',
              font: {
                size: 16,
                weight: 'bold'
              },
              padding: 20
            },
            legend: {
              position: 'right',
              labels: {
                padding: 15,
                font: {
                  size: 12
                },
                usePointStyle: true,
                pointStyle: 'circle'
              }
            },
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              titleFont: {
                size: 13
              },
              bodyFont: {
                size: 13
              },
              padding: 12,
              callbacks: {
                label: function(context) {
                  const label = context.label || '';
                  const value = context.formattedValue;
                  const total = context.dataset.data.reduce((a, b) => a + b, 0);
                  const percentage = Math.round((context.raw / total) * 100);
                  return `${label}: ${value} items (${percentage}%)`;
                }
              }
            }
          }
        }
      });

      // Top Products Chart
      new Chart(document.getElementById('productsChart'), {
        type: 'bar',
        data: {
          labels: [
            <?php 
              foreach ($top_products as $product) {
                echo "'" . addslashes($product->name) . "',";
              }
            ?>
          ],
          datasets: [{
            label: 'Units Sold',
            data: [
              <?php 
                foreach ($top_products as $product) {
                  echo $product->total_sold . ",";
                }
              ?>
            ],
            backgroundColor: 'rgba(102, 16, 242, 0.6)',
            borderColor: '#6610f2',
            borderWidth: 1,
            borderRadius: 4,
            maxBarThickness: 20,
            hoverBackgroundColor: 'rgba(102, 16, 242, 0.8)'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          indexAxis: 'y',
          plugins: {
            title: {
              display: true,
              text: 'Top Selling Products',
              font: {
                size: 16,
                weight: 'bold'
              },
              padding: 20
            },
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              titleFont: {
                size: 13
              },
              bodyFont: {
                size: 13
              },
              padding: 12,
              callbacks: {
                label: function(context) {
                  return `Units Sold: ${context.formattedValue}`;
                }
              }
            }
          },
          scales: {
            x: {
              beginAtZero: true,
              grid: {
                color: 'rgba(0, 0, 0, 0.05)',
                drawBorder: false
              },
              title: {
                display: true,
                text: 'Units Sold',
                font: {
                  size: 12,
                  weight: 'bold'
                },
                padding: {top: 10, bottom: 0}
              },
              ticks: {
                font: {
                  size: 11
                },
                padding: 8
              }
            },
            y: {
              grid: {
                display: false
              },
              title: {
                display: true,
                text: 'Product Name',
                font: {
                  size: 12,
                  weight: 'bold'
                },
                padding: {top: 0, bottom: 10}
              },
              ticks: {
                font: {
                  size: 11
                },
                padding: 8
              }
            }
          }
        }
      });
    }); 
  </script>
