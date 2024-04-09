<?php 

/**
* 
*/
class M_resetpassword extends CI_model
{
    private $table1 = 'tb_rt';
    private $table2 = 'tb_kk';
    private $table3 = 'tb_token';


    public function view_id_byemail($email='')
    {
  //join table tb_kk dan tb_rt
      $this->db->select('*');
      $this->db->from($this->table1);
      $this->db->where('email', $email);
      return $this->db->get();
  }

  public function view_id_bytoken($token='')
  {
  //join table tb_token dan tb_rt
    $this->db->select('*');
    $this->db->from($this->table1);
    $this->db->join($this->table3 , 'tb_token.id_token = tb_token.id_token');
    $this->db->where('token', $token);
    return $this->db->get();
}

public function update_by_email($email='',$SQLupdate){
  $this->db->where('email', $email);
  return $this->db->update($this->table1, $SQLupdate);
}

//mengambil id token urut terakhir
public function token_id_urut($value='')
{
    $this->db->select_max('id_token');
    $this->db->from ($this->table3);
}

public function token_add($SQLinsert2){
    return $this -> db -> insert($this->table3, $SQLinsert2);
}

public function update_by_token($id_token='',$SQLupdate){
    $this->db->select('*');
    $this->db->from($this->table1);
    $this->db->join($this->table3 , 'tb_token.id_token = tb_token.id_token');
    $this->db->where('id_token', $id_token);
    return $this->db->update($this->table1, $SQLupdate);
}


}
