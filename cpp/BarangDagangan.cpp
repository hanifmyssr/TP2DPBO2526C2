#include "Senjata.cpp"

// Kelas anak dari Senjata: menambah atribut dagang (harga, stok, kondisi, garansi)
class BarangDagangan : public Senjata {

private:
    double harga;   // Harga dalam Rupiah
    int    stok;    // Jumlah stok
    string kondisi; // Baru / Bekas
    bool   garansi; // True = Ya, False = Tidak

public:
    // Constructor kosong
    BarangDagangan() {}

    // Constructor dengan Parameter
    BarangDagangan(string id, string n, string j, string s, string m, double h, int st, string k, bool g) {
        setIdSenjata(id);
        setNama(n);
        setJenis(j);
        setSpesifikasi(s);
        setMadeIn(m);
        harga   = h;
        stok    = st;
        kondisi = k;
        garansi = g;
    }

    // Getter Method
    double getHarga()const{
        return harga;
    }
    int getStok()const{
        return stok;
    }
    string getKondisi()const{
        return kondisi;
    }
    bool getGaransi()const{
        return garansi;
    }

    // Setter Method
    void setHarga(double h){
        harga = h;
    }
    void setStok(int st){
        stok = st;
    }
    void setKondisi(string k){
        kondisi = k;
    }
    void setGaransi(bool g){
        garansi = g;
    }

    // Destructor
    virtual ~BarangDagangan() {}
};
