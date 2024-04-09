<?php 

/**
* 
*/
class M_data_lain extends CI_model
{

private $table  = 'tb_data_lain';
private $table2 = 'tb_rt';

//kk join rt
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table2);
  $this->db->join($this->table, 'tb_data_lain.id_rt = tb_rt.id_rt');
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

public function view_id($id='')
{
 $this->db->select ('*');
  $this->db->from ($this->table2);
  $this->db->join($this->table, 'tb_data_lain.id_rt = tb_rt.id_rt');
  $this->db->where('tb_data_lain.id_data_lain', $id);
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

//mengambil id rt urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_data_lain');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_data_lain', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_data_lain', $id);
  return $this->db-> delete($this->table);
}

//untuk page rt kependudukan
public function view_id_data_lain($id='')
{
  $id = $this->session->userdata['id_rt'];
  $this->db->select('*');
  $this->db->from($this->table2);
  $this->db->join($this->table, 'tb_data_lain.id_rt = tb_rt.id_rt');
  $this->db->where('tb_data_lain.id_rt', $id);
  $this->db->order_by('nama', 'ASC');
  return $this->db->get();
}

}