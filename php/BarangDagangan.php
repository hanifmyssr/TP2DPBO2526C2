<?php
require_once "Senjata.php";

// Kelas anak dari Senjata
class BarangDagangan extends Senjata {
    private $harga;   // Harga dalam Rupiah
    private $stok;    // Jumlah stok
    private $kondisi; // Baru / Bekas
    private $garansi; // True = Ya, False = Tidak

    // Constructor memanggil parent untuk 5 atribut induk + 4 atribut dagang
    public function __construct($idSenjata = "", $nama = "", $jenis = "", $spesifikasi = "", $madeIn = "", $harga = 0, $stok = 0, $kondisi = "", $garansi = false) {
        parent::__construct($idSenjata, $nama, $jenis, $spesifikasi, $madeIn);
        $this->harga = $harga;
        $this->stok = $stok;
        $this->kondisi = $kondisi;
        $this->garansi = $garansi;
    }

    // Getter Method
    public function getHarga() { return $this->harga; }
    public function getStok() { return $this->stok; }
    public function getKondisi() { return $this->kondisi; }
    public function getGaransi() { return $this->garansi; }

    // Setter Method
    public function setHarga($harga) { $this->harga = $harga; }
    public function setStok($stok) { $this->stok = $stok; }
    public function setKondisi($kondisi) { $this->kondisi = $kondisi; }
    public function setGaransi($garansi) { $this->garansi = $garansi; }
}
?>
