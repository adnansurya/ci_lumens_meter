<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct(){
        parent:: __construct();
        is_logged_in();

    }

    public function index(){
        $this->load->view('templates/headerdash');
        $this->load->view('templates/sidebardash');
        $this->load->view('user/dash');
        $this->load->view('templates/footerdash');
    }
    
    // public function role(){
    //     $data['title'] = 'Role';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['role'] = $this->db->get('user_role')->result_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/role', $data);
    //     $this->load->view('templates/footer');
    // }
    public function grapik1(){        
        $this->load->view('templates/headerdash');
        $this->load->view('templates/sidebardash');
        $this->load->view('admin/grapit1');
        $this->load->view('templates/footergraph');
    }

    public function grapik2(){        
        $this->load->view('templates/headerdash');
        $this->load->view('templates/sidebardash');
        $this->load->view('admin/grapit2');
        $this->load->view('templates/footergraph1');
    }

    public function tabel(){        
        $this->load->view('templates/headerdash');
        $this->load->view('templates/sidebardash');
        $this->load->view('admin/table');
        $this->load->view('templates/footerdash');
    }
    
    public function persentase()
    {
        $this->load->view('templates/headerdash');
        $this->load->view('templates/sidebardash');
        $this->load->view('admin/persen');
        $this->load->view('templates/footergraph2');
    }

    // public function roleAccess($role_id){
    //     $data['title'] = 'Role Access';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['role'] = $this->db->get_where('user_role', ['id' =>$role_id])->row_array();
    //     $this->db->where('id !=', 1);
    //     $data['menu'] = $this->db->get('user_menu')->result_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/role-access', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function changeaccess(){
    //     $menu_id = $this->input->post('menuId');
    //     $role_id = $this->input->post('roleId');

    //     $data = [
    //         'role_id' => $role_id,
    //         'menu_id' => $menu_id
    //     ];

    //     $result = $this->db->get_where('user_acces_menu', $data);
    //     if($result->num_rows() < 1){
    //         $this->db->insert('user_acces_menu', $data);
    //     } else {
    //         $this->db->delete('user_acces_menu', $data);
    //     }
    //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //     Access Change</div>');
    // }

    // public function control(){
    //     $data['title'] = 'Control PPM and pH';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['role'] = $this->db->get('user_role')->result_array();
    //     $data['tds'] = $this->db->get('hiro')->row_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/control', $data);
    //     $this->load->view('templates/footer');

    // }

}