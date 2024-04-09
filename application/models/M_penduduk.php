<?php 

/**
* 
*/
class M_penduduk extends CI_model
{

private $table  = 'tb_kk';
private $table2 = 'tb_rt';
private $table3 = 'tb_anggota';

public function view_anggota($id='')
{
  $this->db->select ('*');
  $this->db->from ($this->table);
  $this->db->join($this->table3, 'tb_anggota.id_kk = tb_kk.id_kk');
  $this->db->where('tb_anggota.id_kk', $id);
  $this->db->order_by('id_anggota', 'ASC');
  return $this->db->get();
}

public function view_id($token='')
{
 return $this->db->select ('*')->from ($this->table)->where ('uuid', $token)->get ();
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

public function update($token='',$SQLupdate){
  $this->db->where('uuid', $token);
  return $this->db-> update($this->table, $SQLupdate);
}

public function get_by_nama($nama, $tgl_lahir)
{
    $this->db->select('*');
    $this->db->from ($this->table);
    $this->db->join($this->table3, 'tb_anggota.id_kk = tb_kk.id_kk');
    $this->db->where('nama', $nama);
    $this->db->where('tgl_lahir', $tgl_lahir);
    return $this->db->get();
}

}