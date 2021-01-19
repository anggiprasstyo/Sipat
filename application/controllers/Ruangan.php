<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function rapat()
    {
        $data['title'] = 'Ruang Rapat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id_user = $data['user'];

        $data['ruangRapat'] = $this->db->get('ruangan_rapat')->result_array();

        // $data['dataBoking'] = $this->db->get_where('pinjam_ruang_rapat', ['id_user' => $id_user['id']])->result_array();

        $this->load->model('Ruangan_model', 'ruangan');

        // menghapus data dari tanggal yang sudah lewat
        $hapusBerkas =  $this->ruangan->getTanggal();
        foreach ($hapusBerkas as $hapus) {
            unlink('./assets/ruangRapat/' . $hapus['file']);
        }
        // menghapus data yang sudah lewat
        $this->ruangan->tanggal();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ruangan/rapat', $data);
        $this->load->view('templates/footer');
    }

    public function jadwalRapat($id_ruangan)
    {
        $data['title'] = 'Ruang Rapat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $id_user = $data['user'];

        $data['jadwal'] = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $id_ruangan])->row_array();

        $data['ruangan'] = $this->db->get_where('ruangan_rapat', ['id_ruangan' => $id_ruangan])->row_array();

        $data['dataPeminjaman'] = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $id_ruangan, 'id_user' => $id_user['id']])->result_array();

        // $kemarin = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));

        // $this->db->where('tanggal', $kemarin);
        // $this->db->delete('pinjam_ruang_rapat');

        $this->load->model('Ruangan_model', 'ruangan');

        // menghapus data dari tanggal yang sudah lewat
        $hapusBerkas =  $this->ruangan->getTanggal();
        foreach ($hapusBerkas as $hapus) {
            unlink('./assets/ruangRapat/' . $hapus['file']);
        }
        // menghapus data yang sudah lewat
        $this->ruangan->tanggal();

        if (!$data['jadwal']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jadwal ruangan masih kosong!</div>');
            redirect('ruangan/rapat');
        }

        $this->load->view('ruangan/jadwalRapat', $data);
    }

    public function getRapat($id_ruangan)
    {
        $json = array();
        // $s = $this->db->get('ruang_rapat')->result_array();
        $s = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $id_ruangan])->result_array();

        foreach ($s as $show) {

            $json[] = array(
                'backgroundColor' => 'rgb(255, 0, 0)',
                'borderColor' => 'rgb(255, 0, 0)',
                'title' => $show['unit'] . " : " . $show['nama_kegiatan'],
                'start' => $show['tanggal'] . ' ' . $show['waktu_mulai'],
                'end' => $show['tanggal'] . ' ' . $show['waktu_selesai']
            );
        }

        // $this->output->set_content_type('application/json')->set_output(json_encode($json));
        echo json_encode($json);
    }

    public function peminjaman($id)
    {
        $data['title'] = 'Ruang Rapat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('unit', 'Unit', 'required|trim', [
            'required' => 'Unit harus diisi!'
        ]);

        $this->form_validation->set_rules('namaKegiatan', 'Nama Kegiatan', 'required|trim', [
            'required' => 'Nama kegiatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('tanggal', 'Tanggal Kegiatan', 'required|trim', [
            'required' => 'Tanggal kegiatan tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('waktuMulai', 'Waktu Mulai', 'required|trim', [
            'required' => 'Waktu Mulai tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('waktuSelesai', 'Waktu Selesai', 'required|trim', [
            'required' => 'Waktu Selesai tidak boleh kosong!'
        ]);

        // $this->form_validation->set_rules('file', 'File', 'required|trim', [
        //     'required' => 'File tidak boleh kosong!'
        // ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ruangan/peminjaman', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $unit = htmlspecialchars($this->input->post('unit', true));
            $namaKegiatan = htmlspecialchars($this->input->post('namaKegiatan', true));
            $tanggal = htmlspecialchars($this->input->post('tanggal', true));
            $waktuMulai = htmlspecialchars($this->input->post('waktuMulai', true));
            $waktuSelesai = htmlspecialchars($this->input->post('waktuSelesai', true));

            // $mulai = $tanggal . ' ' . $waktuMulai;
            // $selesai = $tanggal . ' ' . $waktuSelesai;

            $upload_file = $_FILES['file'];


            $cariData = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $id, 'tanggal' => $tanggal])->row_array();

            if ($waktuMulai <= $cariData['waktu_selesai']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sudah dipinjam pada jam tersebut!</div>');
                redirect('ruangan/rapat');
            }


            if ($upload_file) {
                $config['allowed_types'] = 'pdf|docx';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/ruangRapat/';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Peminjaman Gagal. File harus diisi !</div>');
                    redirect('ruangan/rapat');
                } else {
                    $data = [
                        'id_ruangan' => $id,
                        'id_user' => $id_user['id'],
                        'unit' => $unit,
                        'nama_kegiatan' => $namaKegiatan,
                        'tanggal' => $tanggal,
                        'waktu_mulai' => $waktuMulai,
                        'waktu_selesai' => $waktuSelesai,
                        'file' => $this->upload->data('file_name')
                    ];

                    $this->db->insert('pinjam_ruang_rapat', $data);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peminjaman Ruang Rapat Berhasil!</div>');
                    redirect('ruangan/rapat');
                }
            }
        }
    }

    public function pembatalanJadwal($id_ruangan)
    {
        $data['title'] = 'Ruang Rapat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['ruangan'] = $this->db->get_where('ruangan_rapat', ['id_ruangan' => $id_ruangan])->row_array();

        $id_user = $data['user'];

        $data['dataPeminjaman'] = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $id_ruangan, 'id_user' => $id_user['id']])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ruangan/pembatalan', $data);
        $this->load->view('templates/footer');
    }

    public function batalkanJadwal($id)
    {
        $data = $this->db->get_where('pinjam_ruang_rapat', ['id_pinjam' => $id])->row_array();

        if ($data['file'] != "") {
            unlink('./assets/ruangRapat/' . $data['file']);
        }

        $this->db->where('id_pinjam', $id);
        $this->db->delete('pinjam_ruang_rapat');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal Rapat Berhasil Dihapus!</div>');
        redirect('ruangan/rapat');
    }

    public function dataJadwalPinjam($id)
    {
        $data['title'] = 'Ruang Rapat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['ruangan'] = $this->db->get_where('ruangan_rapat', ['id_ruangan' => $id])->row_array();

        $data['dataPeminjaman'] = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $id])->result_array();

        if (!$data['dataPeminjaman']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Belum ada data jadwal peminjam!</div>');
            redirect('ruangan/rapat');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ruangan/dataJadwalPinjam', $data);
        $this->load->view('templates/footer');
    }

    public function download($namaFile)
    {
        $path = './assets/ruangRapat/' . $namaFile;

        header('Content-Type: aplication/pdf');
        header('Content-Disposition: inline; filename=' . $namaFile);
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($path);
    }
}
