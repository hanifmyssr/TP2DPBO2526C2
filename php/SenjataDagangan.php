<?php
require_once "BarangDagangan.php";

// Kelas cucu: mewarisi Senjata + BarangDagangan, menambah lisensi, penjual, dan foto_produk (khusus PHP)
class SenjataDagangan extends BarangDagangan {
    private $kodeLisensiJual; // Kode lisensi jual
    private $penjual;         // Nama toko/penjual
    private $foto_produk;     // Path lokal gambar (KHUSUS PHP, tidak ada di cpp/java/python)

    // Constructor lengkap 12 atribut (5 induk + 4 dagang + 3 cucu)
    public function __construct($idSenjata = "", $nama = "", $jenis = "", $spesifikasi = "", $madeIn = "",
                                $harga = 0, $stok = 0, $kondisi = "", $garansi = false,
                                $kodeLisensiJual = "", $penjual = "", $foto_produk = "") {
        parent::__construct($idSenjata, $nama, $jenis, $spesifikasi, $madeIn, $harga, $stok, $kondisi, $garansi);
        $this->kodeLisensiJual = $kodeLisensiJual;
        $this->penjual = $penjual;
        $this->foto_produk = $foto_produk;
    }

    // Getter Method
    public function getKodeLisensiJual() { return $this->kodeLisensiJual; }
    public function getPenjual() { return $this->penjual; }
    public function getFotoProduk() { return $this->foto_produk; }

    // Setter Method
    public function setKodeLisensiJual($kode) { $this->kodeLisensiJual = $kode; }
    public function setPenjual($penjual) { $this->penjual = $penjual; }
    public function setFotoProduk($foto) { $this->foto_produk = $foto; }

    // Helper: format harga menjadi Rp 12.500.000
    public function getHargaFormatted() {
        return "Rp " . number_format($this->getHarga(), 0, ',', '.');
    }

    // Helper: ubah boolean garansi menjadi Ya/Tidak
    public function getGaransiStr() {
        return $this->getGaransi() ? "Ya" : "Tidak";
    }
}
?>
