<?php 

/**
* 
*/
class M_anggota extends CI_model
{

  private $table = 'tb_anggota';
  private $table2 = 'tb_kk';

  public function view_anggota_all($value='')
  {
    $this->db->select ('*');
    $this->db->from ($this->table2);
    $this->db->join($this->table, 'tb_anggota.id_kk = tb_kk.id_kk');
    $this->db->order_by('nama_kk', 'ASC');
    return $this->db->get();
  }

  public function count_family_members($id_kk) {
    $query = $this->db->get_where('tb_anggota', ['id_kk' => $id_kk]);
    return $query->num_rows();
  }

  public function view()
  {
    $this->db->select('*');
    $this->db->from($this->table2);
    $this->db->join($this->table, 'tb_anggota.id_kk = tb_kk.id_kk');
    $this->db->order_by('nama_kk', 'ASC');
    return $this->db->get();
  }


//untuk page rt kependudukan
  public function view_anggota_kk($id='')
  {
    $id = $this->session->userdata['id_rt'];
    $this->db->select ('*');
    $this->db->from ($this->table2);
    $this->db->join($this->table, 'tb_anggota.id_kk = tb_kk.id_kk');
    $this->db->where('tb_kk.id_rt', $id);
    $this->db->order_by('nama_kk', 'ASC');
    return $this->db->get();
  }

//mengambil id anggota urut terakhir
  public function id_urut($value='')
  { 
    $this->db->select_max('id_anggota');
    $this->db->from ($this->table);
  }

  public function add($SQLinsert){
    return $this -> db -> insert($this->table, $SQLinsert);
  }

  public function update($id='',$SQLupdate){
    $this->db->where('id_anggota', $id);
    return $this->db-> update($this->table, $SQLupdate);
  }

  public function delete($id=''){
    $this->db->where('id_anggota', $id);
    return $this->db-> delete($this->table);
  }

}