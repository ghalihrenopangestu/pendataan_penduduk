<?php 

/**
* 
*/
class M_admin extends CI_model
{

private $table = 'tb_admin';


//Admin INTERNET
public function view($value='')
{
 return $this->db->select ('*')->from ($this->table)->get ();
}

public function admin($id='')
{
 return $this->db->select ('*')->from ($this->table)->where ('id_admin', $id)->get ();
}

//mengambil id admin urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_admin');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_admin', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_admin', $id);
  return $this->db-> delete($this->table);
}


}