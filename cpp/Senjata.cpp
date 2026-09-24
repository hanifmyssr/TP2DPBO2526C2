#include <bits/stdc++.h>
using namespace std;

// Kelas induk: menyimpan data dasar senjata (5 atribut)
class Senjata {

private:
    string idSenjata;   // ID unik senjata
    string nama;        // Nama senjata
    string jenis;       // Jenis (Pistol/Rifle/Shotgun/SMG)
    string spesifikasi; // Detail kaliber & fitur
    string madeIn;      // Negara pembuat

public:
    // Constructor kosong
    Senjata() {}

    // Constructor dengan parameter
    Senjata(string id, string n, string j, string s, string m) {
        idSenjata   = id;
        nama        = n;
        jenis       = j;
        spesifikasi = s;
        madeIn      = m;
    }

    // Getter Method
    string getIdSenjata()const{
        return idSenjata;
    }
    string getNama()const{
        return nama;
    }
    string getJenis()const{
        return jenis;
    }
    string getSpesifikasi()const{
        return spesifikasi;
    }
    string getMadeIn()const{
        return madeIn;
    }

    // Setter Method
    void setIdSenjata(string id){
        idSenjata = id;
    }
    void setNama(string n){
        nama = n;
    }
    void setJenis(string j){
        jenis = j;
    }
    void setSpesifikasi(string s){
        spesifikasi = s;
    }
    void setMadeIn(string m){
        madeIn = m;
    }

    // Destructor
    virtual ~Senjata() {}
};
