from BarangDagangan import BarangDagangan


# Kelas cucu: mewarisi Senjata + BarangDagangan, menambah lisensi & penjual
class SenjataDagangan(BarangDagangan):

    # Constructor lengkap untuk 11 atribut total (5 induk + 4 dagang + 2 lisensi)
    def __init__(self, id_senjata="", nama="", jenis="", spesifikasi="", made_in="",
                 harga=0.0, stok=0, kondisi="", garansi=False,
                 kode_lisensi_jual="", penjual=""):
        super().__init__(id_senjata, nama, jenis, spesifikasi, made_in,
                         harga, stok, kondisi, garansi)
        self._kode_lisensi_jual = kode_lisensi_jual  # Kode lisensi jual
        self._penjual           = penjual            # Nama toko/penjual

    # Getter Method
    def get_kode_lisensi_jual(self):
        return self._kode_lisensi_jual

    def get_penjual(self):
        return self._penjual

    # Setter Method
    def set_kode_lisensi_jual(self, kode):
        self._kode_lisensi_jual = kode

    def set_penjual(self, penjual):
        self._penjual = penjual

    # Mengubah satu objek menjadi list string untuk tabel dinamis (11 kolom)
    def to_row(self):
        garansi_str = "Ya" if self._garansi else "Tidak"

        # Format harga menjadi Rp 12.500.000
        harga_str = f"Rp {self._harga:,.0f}".replace(",", ".")

        return [
            self._id_senjata,
            self._nama,
            self._jenis,
            self._spesifikasi,
            self._made_in,
            harga_str,
            str(self._stok),
            self._kondisi,
            garansi_str,
            self._kode_lisensi_jual,
            self._penjual
        ]
