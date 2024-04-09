<?php 

/**
* 
*/
class M_rt extends CI_model
{

private $table = 'tb_rt';

//rt INTERNET
public function view($value='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->order_by('id_rt');
  return $this->db->get();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_rt', $id)->get ();
}

//mengambil id rt urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_rt');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_rt', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_rt', $id);
  return $this->db-> delete($this->table);
}

//untuk page rt login
public function view_id_rt($id='')
{
  $id = $this->session->userdata['id_rt'];
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->where('id_rt', $id);
  $this->db->order_by('id_rt');
  return $this->db->get();
}

}