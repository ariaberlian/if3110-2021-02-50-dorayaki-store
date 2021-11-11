<?php
class VarDorayaki_model
{
    // private $table = 'varian_dorayaki';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllVariant()
    {
        // jumlah terjual adalah jumlah perubahan yang dilakukan oleh non admin per variant dorayaki
        // Ambil data nama variant dorayaki, stok, dan jumlah terjual
        $this->db->query("SELECT nama, stok, gambar, harga, ABS(COALESCE(SUM(perubahan),0)) as penjualan 
            FROM varian_dorayaki 
            LEFT JOIN histori 
            ON varian_dorayaki.nama = histori.nama_var 
            and histori.username in (SELECT username FROM user WHERE is_admin = 0)
            GROUP BY nama 
            ORDER BY penjualan DESC");
        return $this->db->resultSet();
    }
    public function getDetailVariant($nama_var)
    {
        $this->db->query("SELECT nama, gambar, ABS(COALESCE(SUM(perubahan),0)) as penjualan, desc, harga, stok
            FROM varian_dorayaki 
            LEFT JOIN histori 
            ON varian_dorayaki.nama = histori.nama_var 
            and histori.username in (SELECT username FROM user WHERE is_admin = 0)
			WHERE varian_dorayaki.nama = '" . $nama_var . "'
            GROUP BY nama ");
        return $this->db->single();
    }

    public function findVariant($keyword)
    {
        $query = "SELECT nama, gambar, harga, desc, ABS(COALESCE(SUM(perubahan),0)) as penjualan, desc  FROM varian_dorayaki 
            LEFT JOIN histori 
            ON varian_dorayaki.nama = histori.nama_var 
            and histori.username in (SELECT username FROM user WHERE is_admin = 0)
			WHERE varian_dorayaki.nama LIKE :keyword
            GROUP BY nama ";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function addVariant($nama, $gambar, $desc, $harga, $stok)
    {
        $query = "INSERT INTO varian_dorayaki (nama, desc, harga, stok, gambar) VALUES (:nama, :desc, :harga, :stok, :gambar);";
        $this->db->query($query);
        $this->db->bind('nama', "$nama");
        $this->db->bind('desc', "$desc");
        $this->db->bind('harga', "$harga");
        $this->db->bind('stok', "$stok");
        $this->db->bind('gambar', "$gambar");
        $this->db->execute();
    }

    public function deleteVariant($nama_var)
    {
        try {
            $query = "DELETE FROM varian_dorayaki WHERE nama = :nama_var";
            $this->db->query($query);
            $this->db->bind('nama_var', "$nama_var");
            $this->db->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function editVariant($nama, $gambar, $desc, $harga, $stok)
    {
        try{
            if (is_null($gambar)) {
                $query = "UPDATE varian_dorayaki
                    SET nama = :nama, desc = :desc, harga = :harga, stok = :stok 
                    WHERE nama = :nama";
            } else {
                $query = "UPDATE varian_dorayaki
                    SET nama = :nama, desc = :desc, harga = :harga, stok = :stok, gambar = :gambar
                    WHERE nama = :nama";
            }
            $this->db->query($query);
            $this->db->bind('nama', "$nama");
            $this->db->bind('desc', "$desc");
            $this->db->bind('harga', "$harga");
            $this->db->bind('stok', "$stok");
            if (!is_null($gambar)){
                $this->db->bind('gambar', "$gambar");}
            $this->db->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
        
    }
    public function ubahStok($nama, $username, $stok_akhir, $perubahan){
        try{
            $query = "UPDATE varian_dorayaki
                    SET stok = :stok";
            $query2 = "INSERT INTO histori (nama_var, username, tanggal_perubahan, perubahan) VALUES (:nama, :username, datetime('now'), :perubahan);";
            $this->db->query($query);
            $this->db->bind("stok", "$stok_akhir");
            $this->db->execute();
    
            $this->db->query($query2);
            $this->db->bind("nama", "$nama");
            $this->db->bind("username", "$username");
            $this->db->bind("perubahan", "$perubahan");
            $this->db->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getStok($nama){
        $this->db->query(
            "SELECT stok FROM varian_dorayaki WHERE nama = '".$nama."';"
        );
        return $this->db->single();
    }
}
