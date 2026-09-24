<?php
// Kelas induk: menyimpan data dasar senjata (5 atribut)
class Senjata {
    private $idSenjata;   // ID unik senjata
    private $nama;        // Nama senjata
    private $jenis;       // Jenis (Pistol/Rifle/Shotgun/SMG)
    private $spesifikasi; // Detail kaliber & fitur
    private $madeIn;      // Negara pembuat

    // Constructor untuk inisialisasi 5 atribut
    public function __construct($idSenjata = "", $nama = "", $jenis = "", $spesifikasi = "", $madeIn = "") {
        $this->idSenjata = $idSenjata;
        $this->nama = $nama;
        $this->jenis = $jenis;
        $this->spesifikasi = $spesifikasi;
        $this->madeIn = $madeIn;
    }

    // Getter Method
    public function getIdSenjata() { return $this->idSenjata; }
    public function getNama() { return $this->nama; }
    public function getJenis() { return $this->jenis; }
    public function getSpesifikasi() { return $this->spesifikasi; }
    public function getMadeIn() { return $this->madeIn; }

    // Setter Method
    public function setIdSenjata($id) { $this->idSenjata = $id; }
    public function setNama($nama) { $this->nama = $nama; }
    public function setJenis($jenis) { $this->jenis = $jenis; }
    public function setSpesifikasi($spesifikasi) { $this->spesifikasi = $spesifikasi; }
    public function setMadeIn($madeIn) { $this->madeIn = $madeIn; }
}
?>
