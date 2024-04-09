<?php
/* Model design by Ismarianto Putra Tech Programming
 * http://minangopensource.blogspot.com 
 */
class Login_m extends CI_model
{
    public function admin($email='', $password='')
    {
        $this->db->select('*');
        $this->db->from('tb_admin');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function ketua_rt($nama='', $no_hp='', $password='')
    {
        $this->db->select('*');
        $this->db->from('tb_rt');
        $this->db->where('(nama_rt = "'.$nama.'" OR no_hp = "'.$no_hp.'")');
        $this->db->where('password', $password);
        $this->db->limit(1);
        return $this->db->get();
    }
}
?>