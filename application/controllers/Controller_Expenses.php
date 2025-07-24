<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Expenses extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Explicitly load required libraries
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        
        // Load the expenses model
        $this->load->model('model_expenses');
        
        // Set page title
        $this->data['page_title'] = 'Company Expenses';
        
        // Ensure user is logged in
        $this->not_logged_in();
        
        // Log for debugging
        log_message('debug', 'Controller_Expenses initialized');
    }

    public function index()
    {
        if (!in_array('viewExpense', $this->permission)) {
            $this->session->set_flashdata('error', 'Unauthorized access to view expenses');
            redirect('dashboard', 'refresh');
        }
        
        // Fetch expenses for non-AJAX rendering (if needed)
        $this->data['expenses'] = $this->model_expenses->getExpenses(200);
        $this->data['currency'] = $this->company_currency();
        $this->render_template('expenses/index', $this->data);
    }

    public function fetchExpensesData()
    {
        if (!in_array('viewExpense', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Unauthorized access']);
            return;
        }
        
        $result = array('data' => array());
        $data = $this->model_expenses->getExpenses(200);
        
        // Log raw data for debugging
        log_message('debug', 'fetchExpensesData raw data: ' . print_r($data, true));
        
        $currency = $this->company_currency();
        
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $buttons = '';
                if (in_array('viewExpense', $this->permission)) {
                    $buttons .= '<button type="button" class="btn btn-default" onclick="viewFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#viewModal"><i class="fa fa-eye"></i></button>';
                }
                if (in_array('updateExpense', $this->permission)) {
                    $buttons .= ' <button type="button" class="btn btn-default" onclick="editFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
                }
                if (in_array('deleteExpense', $this->permission)) {
                    $buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                }
                $result['data'][$key] = array(
                    'expense_date' => htmlspecialchars($value['expense_date'] ?? ''),
                    'amount' => $currency . ' ' . number_format($value['amount'] ?? 0, 2),
                    'description' => htmlspecialchars($value['description'] ?? ''),
                    'category' => htmlspecialchars($value['category'] ?? ''),
                    'user_name' => htmlspecialchars($value['user_name'] ?? 'Unknown'),
                    'actions' => $buttons
                );
            }
        } else {
            log_message('debug', 'No expenses found in fetchExpensesData');
        }
        
        echo json_encode($result);
    }

    public function create()
    {
        if (!in_array('createExpense', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Unauthorized access']);
            return;
        }

        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('expense_date', 'Date', 'required');
        $this->form_validation->set_rules('user_id_hidden', 'User ID', 'required|integer');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
                'category' => $this->input->post('category'),
                'expense_date' => $this->input->post('expense_date'),
                'user_id' => $this->input->post('user_id_hidden')
            );
            
            $create = $this->model_expenses->create($data);
            echo json_encode($create
                ? ['success' => true, 'messages' => 'Expense recorded successfully']
                : ['success' => false, 'messages' => 'Error recording expense']);
        } else {
            echo json_encode(['success' => false, 'messages' => validation_errors()]);
        }
    }

    public function view($id = null)
    {
        if (!in_array('viewExpense', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Unauthorized access']);
            return;
        }
        
        if (!$id) {
            echo json_encode(['success' => false, 'messages' => 'Invalid expense ID']);
            return;
        }

        $expense = $this->model_expenses->getExpense($id);
        if (!$expense) {
            echo json_encode(['success' => false, 'messages' => 'Expense not found']);
            return;
        }

        $currency = $this->company_currency();
        $response = array(
            'success' => true,
            'data' => array(
                'expense_date' => htmlspecialchars($expense['expense_date']),
                'amount' => $currency . ' ' . number_format($expense['amount'], 2),
                'description' => htmlspecialchars($expense['description']),
                'category' => htmlspecialchars($expense['category']),
                'user_name' => htmlspecialchars($expense['user_name'] ?? 'Unknown')
            )
        );
        
        echo json_encode($response);
    }

    public function edit($id = null)
    {
        if (!in_array('updateExpense', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Unauthorized access']);
            return;
        }
        
        if (!$id) {
            echo json_encode(['success' => false, 'messages' => 'Invalid expense ID']);
            return;
        }

        $expense = $this->model_expenses->getExpense($id);
        if (!$expense) {
            echo json_encode(['success' => false, 'messages' => 'Expense not found']);
            return;
        }

        $response = array(
            'success' => true,
            'data' => array(
                'id' => $expense['id'],
                'expense_date' => htmlspecialchars($expense['expense_date']),
                'amount' => htmlspecialchars($expense['amount']),
                'description' => htmlspecialchars($expense['description']),
                'category' => htmlspecialchars($expense['category']),
                'user_id' => htmlspecialchars($expense['user_id'] ?? $this->session->userdata('id')),
                'user_name' => htmlspecialchars($expense['user_name'] ?? $this->session->userdata('username'))
            )
        );
        
        echo json_encode($response);
    }

    public function update()
    {
        if (!in_array('updateExpense', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Unauthorized access']);
            return;
        }

        $expense_id = $this->input->post('expense_id');
        if (!$expense_id) {
            echo json_encode(['success' => false, 'messages' => 'Invalid expense ID']);
            return;
        }

        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('expense_date', 'Date', 'required');
        $this->form_validation->set_rules('user_id_hidden', 'User ID', 'required|integer');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
                'category' => $this->input->post('category'),
                'expense_date' => $this->input->post('expense_date'),
                'user_id' => $this->input->post('user_id_hidden')
            );

            $this->db->where('id', $expense_id);
            $update = $this->db->update('company_expenses', $data);
            echo json_encode($update
                ? ['success' => true, 'messages' => 'Expense updated successfully']
                : ['success' => false, 'messages' => 'Error updating expense']);
        } else {
            echo json_encode(['success' => false, 'messages' => validation_errors()]);
        }
    }

    public function remove()
    {
        if (!in_array('deleteExpense', $this->permission)) {
            echo json_encode(['success' => false, 'messages' => 'Unauthorized access']);
            return;
        }
        
        $expense_id = $this->input->post('expense_id');
        if ($expense_id) {
            $delete = $this->model_expenses->delete($expense_id);
            echo json_encode($delete
                ? ['success' => true, 'messages' => 'Expense deleted successfully']
                : ['success' => false, 'messages' => 'Error deleting expense']);
        } else {
            echo json_encode(['success' => false, 'messages' => 'Invalid expense ID']);
        }
    }
}