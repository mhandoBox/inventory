<?php
    public function stock_report() {
        if(!in_array('viewReport', $this->session->userdata('user_permission'))) {
            redirect('dashboard', 'refresh');
        }

        $data['title'] = 'Stock Report';
        $data['page_title'] = 'Stock Report';
        
        // Get filter parameters
        $filters = array(
            'category' => $this->input->get('category'),
            'warehouse' => $this->input->get('warehouse'),
            'stock_status' => $this->input->get('stock_status')
        );
        
        // Load required models
        $this->load->model('Model_products');
        $this->load->model('Model_category');
        $this->load->model('Model_stores');
        
        // Get filter data for dropdowns
        $data['categories'] = $this->Model_category->getActiveCategories();
        $data['warehouses'] = $this->Model_stores->getActiveStores();
        
        // Get stock report data
        $data['report'] = $this->Model_reports->getStockReport($filters);
        
        // Calculate aggregates
        $aggregates = array(
            'total_items' => 0,
            'total_value' => 0,
            'low_stock_items' => 0,
            'out_of_stock_items' => 0
        );
        
        if(!empty($data['report'])) {
            foreach($data['report'] as $item) {
                $aggregates['total_items'] += $item['quantity'];
                $aggregates['total_value'] += ($item['quantity'] * $item['price']);
                if($item['quantity'] <= $item['minimum_quantity']) {
                    $aggregates['low_stock_items']++;
                }
                if($item['quantity'] == 0) {
                    $aggregates['out_of_stock_items']++;
                }
            }
        }
        
        $data['aggregates'] = $aggregates;
        $data['filters'] = $filters;
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view('reporting/stock_report', $data);
        $this->load->view('templates/footer');
    }
