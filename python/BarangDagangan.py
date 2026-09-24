from Senjata import Senjata

# Kelas anak dari Senjata
class BarangDagangan(Senjata):

    # Constructor memanggil parent lalu inisialisasi harga, stok, kondisi, garansi
    def __init__(self, id_senjata="", nama="", jenis="", spesifikasi="", made_in="",
                 harga=0.0, stok=0, kondisi="", garansi=False):
        super().__init__(id_senjata, nama, jenis, spesifikasi, made_in)
        self._harga   = harga     # Harga dalam Rupiah
        self._stok    = stok      # Jumlah stok
        self._kondisi = kondisi   # Baru / Bekas
        self._garansi = garansi   # True = Ya, False = Tidak

    # Getter Method
    def get_harga(self):
        return self._harga

    def get_stok(self):
        return self._stok

    def get_kondisi(self):
        return self._kondisi

    def get_garansi(self):
        return self._garansi

    # Setter Method
    def set_harga(self, harga):
        self._harga = harga

    def set_stok(self, stok):
        self._stok = stok

    def set_kondisi(self, kondisi):
        self._kondisi = kondisi

    def set_garansi(self, garansi):
        self._garansi = garansi
