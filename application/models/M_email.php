<?php 

/**
* 
*/
class M_email extends CI_model
{

private $table = 'tb_email';
private $table2 = 'tb_pelanggan';

//EMAIL
public function view($value='')
{
 return $this->db->select ('*')->from ($this->table)->get ();
}

public function view_id($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_email', $id)->get ();
}

//mengambil id email urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_email');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_email', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_email', $id);
  return $this->db-> delete($this->table);
}

public function sendmail_semua($value='')
{
  $this->db->select('*');
  $this->db->from($this->table);
  $this->db->join($this->table2 , 'tb_pelanggan.id_pelanggan = tb_pelanggan.id_pelanggan');
  $this->db->where('status_plg', 'Aktif');
  return $this->db->get();
}

}