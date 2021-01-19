<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['ruangRapat'] = $this->db->get('ruangan_rapat')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Akses Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Nama akses pengguna tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => htmlspecialchars($this->input->post('role', true))
            ];

            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses pengguna telah ditambahkan!</div>');
            redirect('admin/role');
        }
    }

    public function editRole($id)
    {
        $data['title'] = 'Ubah Akses Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Nama akses pengguna tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editRole', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id' => $this->input->post('id'),
                'role' => htmlspecialchars($this->input->post('role', true))
            ];

            $this->db->where('id', $id);
            $this->db->update('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses pengguna berhasil diubah!</div>');
            redirect('admin/role');
        }
    }

    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses Pengguna berhasil dihapus!</div>');
        redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Akses Pengguna';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses Telah diubah!</div>');
    }

    public function dataUser()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'admin');

        $data['datauser'] = $this->admin->getUser();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[6]|max_length[25]|is_unique[user.nip]', [
        //     'required' => 'NIP tidak boleh kosong!',
        //     'is_unique' => 'NIP ini sudah terdaftar!',
        //     'min_length' => 'NIP terlalu pendek!',
        //     'max_length' => 'NIP terlalu panjang!',
        //     'numeric' => 'NIP tidak boleh ada huruf'
        // ]);

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!',
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'required' => 'Kata Sandi tidak boleh kosong!',
            'matches' => 'Kata Sandi tidak cocok!',
            'min_length' => 'Kata Sandi terlalu pendek!'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Konfirmasi Kata Sandi tidak boleh kosong!',
            'matches' => 'Konfirmasi Kata Sandi tidak cocok!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Pengguna';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/dataUser', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('nama', true)),
                // 'nip' => htmlspecialchars($this->input->post('nip', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data pengguna berhasil ditambahkan.</div>');
            redirect('admin/dataUser');
        }
    }

    public function deleteUser($id)
    {
        $data = $this->db->get_where('user', ['id' => $id])->row_array();

        if ($data['image'] != "default.jpg") {
            unlink('./assets/img/profile/' . $data['image']);
        }

        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengguna Berhasil Dihapus!</div>');
        redirect('admin/datauser');
    }

    public function aktifkanUser($id)
    {
        $data = [
            'is_active' => 1,
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diaktifkan!</div>');
        redirect('admin/datauser');
    }

    public function nonAktifkanUser($id)
    {
        $data = [
            'is_active' => 0,
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil tidak diaktifkan!</div>');
        redirect('admin/datauser');
    }
}
