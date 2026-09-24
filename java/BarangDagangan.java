// Kelas anak dari Senjata: menambah atribut dagang
public class BarangDagangan extends Senjata {

    private double  harga;   // Harga dalam Rupiah
    private int     stok;    // Jumlah stok
    private String  kondisi; // Baru / Bekas
    private boolean garansi; // True = Ya, False = Tidak

    // Constructor kosong
    public BarangDagangan() {
        super();
    }

    // Constructor dengan Parameter
    public BarangDagangan(String idSenjata, String nama, String jenis, String spesifikasi, String madeIn, double harga, int stok, String kondisi, boolean garansi) {
        super(idSenjata, nama, jenis, spesifikasi, madeIn);
        this.harga   = harga;
        this.stok    = stok;
        this.kondisi = kondisi;
        this.garansi = garansi;
    }

    // Getter Method
    public double  getHarga()   { return harga; }
    public int     getStok()    { return stok; }
    public String  getKondisi() { return kondisi; }
    public boolean getGaransi() { return garansi; }

    // Setter Method
    public void setHarga(double harga)     { this.harga = harga; }
    public void setStok(int stok)          { this.stok = stok; }
    public void setKondisi(String kondisi) { this.kondisi = kondisi; }
    public void setGaransi(boolean garansi) { this.garansi = garansi; }
}
