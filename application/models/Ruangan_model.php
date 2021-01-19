<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan_model extends CI_Model
{
    public function tanggal()
    {
        $query = "DELETE FROM `pinjam_ruang_rapat` WHERE tanggal < CURDATE()";
        return $this->db->query($query);
    }

    public function getTanggal()
    {
        $query = "SELECT * FROM `pinjam_ruang_rapat` WHERE tanggal < CURDATE()";
        return $this->db->query($query)->result_array();
    }
}
