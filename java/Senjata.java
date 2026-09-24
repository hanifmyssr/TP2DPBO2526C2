// Kelas induk: menyimpan data dasar senjata (5 atribut)
public class Senjata {

    private String idSenjata;   // ID unik senjata
    private String nama;        // Nama senjata
    private String jenis;       // Jenis (Pistol/Rifle/Shotgun/SMG)
    private String spesifikasi; // Detail kaliber & fitur
    private String madeIn;      // Negara pembuat

    // Constructor tanpa parameter
    public Senjata() {}

    // Constructor dengan parameter
    public Senjata(String idSenjata, String nama, String jenis, String spesifikasi, String madeIn) {
        this.idSenjata   = idSenjata;
        this.nama        = nama;
        this.jenis       = jenis;
        this.spesifikasi = spesifikasi;
        this.madeIn      = madeIn;
    }

    // Getter Method
    public String getIdSenjata()   { return idSenjata; }
    public String getNama()        { return nama; }
    public String getJenis()       { return jenis; }
    public String getSpesifikasi() { return spesifikasi; }
    public String getMadeIn()      { return madeIn; }

    // Setter Method
    public void setIdSenjata(String idSenjata)     { this.idSenjata = idSenjata; }
    public void setNama(String nama)               { this.nama = nama; }
    public void setJenis(String jenis)             { this.jenis = jenis; }
    public void setSpesifikasi(String spesifikasi) { this.spesifikasi = spesifikasi; }
    public void setMadeIn(String madeIn)           { this.madeIn = madeIn; }
}
