<?php 
class MY_Controller extends CI_Controller 
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        
        // Load required libraries
        $this->load->library('session');
        $this->load->database();

        // Initialize permission array
        $this->permission = array();

        // Initialize role flags with default values
        $this->data['is_admin'] = false;
        $this->data['is_manager'] = false;
        $this->data['user_permission'] = array();

        // Check if user is logged in and has permissions
        if ($this->session->userdata('logged_in')) {
            // Get user role with null coalescing
            $role = strtolower($this->session->userdata('role') ?? '');
            
            // Set role flags
            $this->data['is_admin'] = ($role === 'administrator');
            $this->data['is_manager'] = ($role === 'manager');

            // Get user permissions safely
            $user_permission = $this->session->userdata('user_permission');
            if ($user_permission !== null) {
                $this->permission = is_array($user_permission) ? $user_permission : array();
            }

            // Debug log
            log_message('debug', 'MY_Controller - Role: ' . $role);
            log_message('debug', 'MY_Controller - Is Admin: ' . ($this->data['is_admin'] ? 'true' : 'false'));
            log_message('debug', 'MY_Controller - Permissions: ' . print_r($this->permission, true));
        } else {
            log_message('debug', 'MY_Controller - User not logged in');
        }
    }

    public function not_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login', 'refresh');
        }
    }

    protected function render_template($page = null, $data = array())
    {
        if ($page) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/side_menubar', $data);
            $this->load->view($page, $data);
            $this->load->view('templates/footer', $data);
        }
    }
}

class Admin_Controller extends MY_Controller 
{
    var $permission = array();

    public function __construct() 
    {
        parent::__construct();

        $group_data = array();
        if (empty($this->session->userdata('logged_in'))) {
            $session_data = array('logged_in' => FALSE);
            $this->session->set_userdata($session_data);
        } else {
            $user_id = $this->session->userdata('id');
            $this->load->model('model_groups');
            $group_data = $this->model_groups->getUserGroupByUserId($user_id);

            $user_permission = array();
            if (is_array($group_data) && isset($group_data['permission']) && !empty($group_data['permission'])) {
                $user_permission = @unserialize($group_data['permission']);
                if ($user_permission === false) {
                    $user_permission = array();
                }
            }
            $this->data['user_permission'] = $user_permission;
            $this->permission = $user_permission;

            if (is_array($user_permission) && isset($user_permission['some_permission'])) {
                $this->data['some_permission'] = $user_permission['some_permission'];
            } else {
                $this->data['some_permission'] = null;
            }
        }

        if ($this->session->userdata('role') === 'Administrator') {
            // Assign all permissions here
            $all_permissions = array(
                'createBrand', 'updateBrand', 'viewBrand', 'deleteBrand',
                'createCategory', 'updateCategory', 'viewCategory', 'deleteCategory',
                'createStore', 'updateStore', 'viewStore', 'deleteStore',
                'createAttribute', 'updateAttribute', 'viewAttribute', 'deleteAttribute',
                'createProduct', 'updateProduct', 'viewProduct', 'deleteProduct',
                'createOrder', 'updateOrder', 'viewOrder', 'deleteOrder',
                'createUser', 'updateUser', 'viewUser', 'deleteUser',
                'createGroup', 'updateGroup', 'viewGroup', 'deleteGroup',
                'createExpense', 'updateExpense', 'viewExpense', 'deleteExpense',
                'viewReport', 'updateCompany', 'viewAccounting', 'updateAccounting',
                 'reportAccounting', 'deleteAccounting' // Restored for dashboard compatibility
            );
            $this->data['user_permission'] = $all_permissions;
            $this->permission = $all_permissions;
        }
    }

    public function logged_in()
    {
        $session_data = $this->session->userdata();
        if ($session_data['logged_in'] == TRUE) {
            redirect('dashboard', 'refresh');
        }
    }

    public function render_template($page = null, $data = array())
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/header_menu', $data);
        $this->load->view('templates/side_menubar', $data);
        $this->load->view($page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function company_currency()
    {
        $this->load->model('model_company');
        $company_currency = $this->model_company->getCompanyData(1);
        $currencies = $this->currency();
            
        $currency = '';
        foreach ($currencies as $key => $value) {
            if ($key == $company_currency['currency']) {
                $currency = $value;
            }
        }
        return $currency;
    }

    public function currency()
    {
        return $currency_symbols = array(
            'AED' => 'د.إ', 'AFN' => 'Af', 'ALL' => 'Lek', 'ANG' => 'ƒ',
            'AOA' => 'Kz', 'ARS' => '$', 'AUD' => '$', 'AWG' => 'ƒ', 'AZN' => 'ман',
            'BAM' => 'KM', 'BBD' => '$', 'BDT' => '৳', 'BGN' => 'лв', 'BHD' => '.د.ب',
            'BIF' => 'FBu', 'BMD' => '$', 'BND' => '$', 'BOB' => '$b', 'BRL' => 'R$',
            'BSD' => '$', 'BTN' => 'Nu.', 'BWP' => 'P', 'BYR' => 'p.', 'BZD' => 'BZ$',
            'CAD' => '$', 'CDF' => 'FC', 'CHF' => 'CHF', 'CLP' => '$', 'CNY' => '¥',
            'COP' => '$', 'CRC' => '₡', 'CUP' => '⃌', 'CVE' => '$', 'CZK' => 'Kč',
            'DJF' => 'Fdj', 'DKK' => 'kr', 'DOP' => 'RD$', 'DZD' => 'دج',
            'EGP' => '£', 'ETB' => 'Br', 'EUR' => '€', 'FJD' => '$', 'FKP' => '£',
            'GBP' => '£', 'GEL' => 'ლ', 'GHS' => '¢', 'GIP' => '£', 'GMD' => 'D',
            'GNF' => 'FG', 'GTQ' => 'Q', 'GYD' => '$', 'HKD' => '$', 'HNL' => 'L',
            'HRK' => 'kn', 'HTG' => 'G', 'HUF' => 'Ft', 'IDR' => 'Rp', 'ILS' => '₪',
            'INR' => '₹', 'IQD' => 'ع.د', 'IRR' => '﷼', 'ISK' => 'kr', 'JEP' => '£',
            'JMD' => 'J$', 'JOD' => 'JD', 'JPY' => '¥', 'KES' => 'KSh', 'KGS' => 'лв',
            'KHR' => '៛', 'KMF' => 'CF', 'KPW' => '₩', 'KRW' => '₩', 'KWD' => 'د.ك',
            'KYD' => '$', 'KZT' => 'лв', 'LAK' => '₭', 'LBP' => '£', 'LKR' => '₨',
            'LRD' => '$', 'LSL' => 'L', 'LTL' => 'Lt', 'LVL' => 'Ls', 'LYD' => 'ل.د',
            'MAD' => 'د.م.', 'MDL' => 'L', 'MGA' => 'Ar', 'MKD' => 'ден',
            'MMK' => 'K', 'MNT' => '₮', 'MOP' => 'MOP$', 'MRO' => 'UM', 'MUR' => '₨',
            'MVR' => '.ރ', 'MWK' => 'MK', 'MXN' => '$', 'MYR' => 'RM', 'MZN' => 'MT',
            'NAD' => '$', 'NGN' => '₦', 'NIO' => 'C$', 'NOK' => 'kr', 'NPR' => '₨',
            'NZD' => '$', 'OMR' => '﷼', 'PAB' => 'B/.', 'PEN' => 'S/.', 'PGK' => 'K',
            'PHP' => '₱', 'PKR' => '₨', 'PLN' => 'zł', 'PYG' => 'Gs', 'QAR' => '﷼',
            'RON' => 'lei', 'RSD' => 'Дин.', 'RUB' => 'руб',
            'RWF' => 'ر.س', 'SAR' => '﷼', 'SBD' => '$', 'SCR' => '₨', 'SDG' => '£',
            'SEK' => 'kr', 'SGD' => '$', 'SHP' => '£', 'SLL' => 'Le', 'SOS' => 'S',
            'SRD' => '$', 'STD' => 'Db', 'SVC' => '$', 'SYP' => '£', 'SZL' => 'L',
            'THB' => '฿', 'TZS' => 'TZS', 'TMT' => 'm', 'TND' => 'د.ت', 'TOP' => 'T$',
            'TRY' => '₤', 'TTD' => '$', 'TWD' => 'NT$', 'UAH' => '₴', 'UGX' => 'USh',
            'USD' => '$', 'UYU' => '$U', 'UZS' => 'лв', 'VEF' => 'Bs', 'VND' => '₫',
            'VUV' => 'VT', 'WST' => 'WS$', 'XAF' => 'FCFA', 'XCD' => '$',
            'XPF' => 'F', 'YER' => '﷼', 'ZAR' => 'R', 'ZMK' => 'ZK', 'ZWL' => 'Z$'
        );
    }
}