<?php 

/**
* 
*/
class M_count extends CI_model
{

private $table  = 'tb_kk';
private $table2 = 'tb_rt';
private $table3 = 'tb_anggota';

//count_anggota tb_kk laki-laki
public function count_kk($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
    return $this->db->get()->num_rows();
}

//count_anggota tb_anggota laki-laki
public function count_anggota_laki($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3)->where ('jenis_kelamin', 'Laki-laki');
    return $this->db->get()->num_rows();
}

//count_anggota tb_anggota perempuan
public function count_anggota_perempuan($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3)->where ('jenis_kelamin', 'Perempuan');
    return $this->db->get()->num_rows();
}

//count rt
public function count_rt($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table2);
    return $this->db->get()->num_rows();
}

//count kk untuk admin
public function admin_count_kk_rt($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table)->where ('id_rt', $id);
    return $this->db->get()->num_rows();
}


//count anggota untuk rt
public function admin_count_anggota_rt_laki($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3)->where ('id_rt', $id)->where ('jenis_kelamin', 'Laki-laki');
    return $this->db->get()->num_rows();
}

//count anggota untuk rt
public function admin_count_anggota_rt_perempuan($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table3)->where ('id_rt', $id)->where ('jenis_kelamin', 'Perempuan');
    return $this->db->get()->num_rows();
}





//count kk untuk rt
public function count_kk_rt($id='')
{
  $id = $this->session->userdata['id_rt'];
  $this->db->select ('*');
  $this->db->from ($this->table)->where ('id_rt', $id);
    return $this->db->get()->num_rows();
}


//count anggota untuk rt
public function count_anggota_rt_laki($id='')
{
  $id = $this->session->userdata['id_rt'];
  $this->db->select ('*');
  $this->db->from ($this->table3)->where ('id_rt', $id)->where ('jenis_kelamin', 'Laki-laki');
    return $this->db->get()->num_rows();
}

//count anggota untuk rt
public function count_anggota_rt_perempuan($id='')
{
  $id = $this->session->userdata['id_rt'];
  $this->db->select ('*');
  $this->db->from ($this->table3)->where ('id_rt', $id)->where ('jenis_kelamin', 'Perempuan');
    return $this->db->get()->num_rows();
}


}