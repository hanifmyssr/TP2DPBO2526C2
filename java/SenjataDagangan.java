import java.util.Arrays;
import java.util.List;
import java.text.DecimalFormat;
import java.text.DecimalFormatSymbols;

// Kelas cucu: mewarisi Senjata + BarangDagangan, menambah lisensi & penjual
public class SenjataDagangan extends BarangDagangan {

    private String kodeLisensiJual; // Kode lisensi jual
    private String penjual;         // Nama toko/penjual

    // Constructor kosong
    public SenjataDagangan() {
        super();
    }

    // Constructor dengan Parameter
    public SenjataDagangan(String idSenjata, String nama, String jenis, String spesifikasi, String madeIn, double harga, int stok, String kondisi, boolean garansi, String kodeLisensiJual, String penjual) {
        super(idSenjata, nama, jenis, spesifikasi, madeIn, harga, stok, kondisi, garansi);
        this.kodeLisensiJual = kodeLisensiJual;
        this.penjual         = penjual;
    }

    // Getter Method
    public String getKodeLisensiJual() { return kodeLisensiJual; }
    public String getPenjual()         { return penjual; }

    // Setter Method
    public void setKodeLisensiJual(String kodeLisensiJual) { this.kodeLisensiJual = kodeLisensiJual; }
    public void setPenjual(String penjual)                 { this.penjual = penjual; }

    // Mengubah satu objek menjadi list string untuk tabel dinamis (11 kolom)
    public List<String> toRow() {
        String garansiStr = getGaransi() ? "Ya" : "Tidak";

        // Format harga menjadi Rp 12.500.000
        DecimalFormatSymbols symbols = new DecimalFormatSymbols();
        symbols.setGroupingSeparator('.');
        DecimalFormat df = new DecimalFormat("#,###", symbols);
        String hargaStr = "Rp " + df.format((long) getHarga());

        return Arrays.asList(
            getIdSenjata(),
            getNama(),
            getJenis(),
            getSpesifikasi(),
            getMadeIn(),
            hargaStr,
            String.valueOf(getStok()),
            getKondisi(),
            garansiStr,
            kodeLisensiJual,
            penjual
        );
    }
}
