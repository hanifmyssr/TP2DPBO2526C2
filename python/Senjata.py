# Kelas induk: menyimpan data dasar senjata (5 atribut)
class Senjata:

    # Constructor untuk inisialisasi atribut senjata
    def __init__(self, id_senjata="", nama="", jenis="", spesifikasi="", made_in=""):
        self._id_senjata  = id_senjata   # ID unik senjata
        self._nama        = nama         # Nama senjata
        self._jenis       = jenis        # Jenis (Pistol/Rifle/Shotgun/SMG)
        self._spesifikasi = spesifikasi  # Detail kaliber & fitur
        self._made_in     = made_in      # Negara pembuat

    # Getter Method
    def get_id_senjata(self):
        return self._id_senjata

    def get_nama(self):
        return self._nama

    def get_jenis(self):
        return self._jenis

    def get_spesifikasi(self):
        return self._spesifikasi

    def get_made_in(self):
        return self._made_in

    # Setter Method
    def set_id_senjata(self, id_senjata):
        self._id_senjata = id_senjata

    def set_nama(self, nama):
        self._nama = nama

    def set_jenis(self, jenis):
        self._jenis = jenis

    def set_spesifikasi(self, spesifikasi):
        self._spesifikasi = spesifikasi

    def set_made_in(self, made_in):
        self._made_in = made_in
