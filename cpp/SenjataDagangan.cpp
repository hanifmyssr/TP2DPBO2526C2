#include "BarangDagangan.cpp"

// Kelas cucu: mewarisi Senjata + BarangDagangan, menambah kode lisensi & penjual
class SenjataDagangan : public BarangDagangan {

private:
    string kodeLisensiJual; // Kode lisensi jual
    string penjual;         // Nama toko/penjual

public:
    // Constructor kosong
    SenjataDagangan() {}

    // Constructor dengan Parameter
    SenjataDagangan(string id, string n, string j, string s, string m, double h, int st, string k, bool g, string kode, string p) {
        setIdSenjata(id);
        setNama(n);
        setJenis(j);
        setSpesifikasi(s);
        setMadeIn(m);
        setHarga(h);
        setStok(st);
        setKondisi(k);
        setGaransi(g);
        kodeLisensiJual = kode;
        penjual = p;
    }

    // Getter Method
    string getKodeLisensiJual()const{
        return kodeLisensiJual;
    }
    string getPenjual()const{
        return penjual;
    }

    // Setter Method
    void setKodeLisensiJual(string kode){
        kodeLisensiJual = kode;
    }
    void setPenjual(string p){
        penjual = p;
    }

    // Mengubah satu objek menjadi vector<string> untuk tabel dinamis (11 kolom)
    vector<string> toRow() const {
        string garansiStr = getGaransi() ? "Ya" : "Tidak";

        // Format harga menjadi Rp 12.500.000 (titik ribuan)
        long long h   = (long long) getHarga();
        string hargaStr = to_string(h);
        string formatted;
        int count = 0;

        for (int i = hargaStr.size() - 1; i >= 0; i--) {
            formatted.push_back(hargaStr[i]);
            count++;
            if (count == 3 && i != 0) {
                formatted.push_back('.');
                count = 0;
            }
        }
        reverse(formatted.begin(), formatted.end());
        formatted = "Rp " + formatted;

        return {
            getIdSenjata(),
            getNama(),
            getJenis(),
            getSpesifikasi(),
            getMadeIn(),
            formatted,
            to_string(getStok()),
            getKondisi(),
            garansiStr,
            kodeLisensiJual,
            penjual
        };
    }

    // Destructor
    ~SenjataDagangan() {}
};
