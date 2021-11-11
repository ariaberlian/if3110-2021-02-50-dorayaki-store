<?php
class Histori_model
{
    private $table = 'histori';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getHistoryAdmin($user){
        $query = "SELECT nama_var, tanggal_perubahan, perubahan FROM histori WHERE username = :user ORDER BY tanggal_perubahan ASC";
        $this->db->query($query);
        $this->db->bind('user', "$user");
        return $this->db->resultSet();
    }
    public function getHistoryUser($user){
        $query = "SELECT nama_var, tanggal_perubahan, abs(perubahan) as pembelian, harga * abs(perubahan) as total_harga FROM histori, varian_dorayaki WHERE username = :user and nama_var=nama ORDER BY tanggal_perubahan ASC";
        $this->db->query($query);
        $this->db->bind('user', "$user");
        return $this->db->resultSet();
    }

    public function getHistoryVariant($variant){
        $query = "SELECT nama_var, username, tanggal_perubahan, perubahan FROM histori WHERE nama_var = :variant ORDER BY tanggal_perubahan ASC";
        $this->db->query($query);
        $this->db->bind('variant', "$variant");
        return $this->db->resultSet();
    }

    public function getVarName(){
        $query = "SELECT DISTINCT nama_var FROM histori";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
