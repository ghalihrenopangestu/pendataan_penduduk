<?php 

/**
* 
*/
class M_kk extends CI_model
{

private $table  = 'tb_kk';
private $table2 = 'tb_rt';
private $table3 = 'tb_anggota';

//kk join rt
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table2);
  $this->db->join($this->table, 'tb_kk.id_rt = tb_rt.id_rt');
  $this->db->order_by('nama_kk', 'ASC');
  return $this->db->get();
}

public function view_anggota($id='',$value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table3, 'tb_anggota.id_kk = tb_kk.id_kk');
  $this->db->where('tb_anggota.id_kk', $id);
  $this->db->order_by('id_anggota', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_kk', $id)->get ();
}

//mengambil id rt urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_kk');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_kk', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_kk', $id);
  return $this->db-> delete($this->table);
}

//untuk page rt kependudukan
public function view_id_kk($id='')
{
  $id = $this->session->userdata['id_rt'];
  $this->db->select('*');
  $this->db->from($this->table2);
  $this->db->join($this->table, 'tb_kk.id_rt = tb_rt.id_rt');
  $this->db->where('tb_kk.id_rt', $id);
  $this->db->order_by('nama_kk', 'ASC');
  return $this->db->get();
}

}