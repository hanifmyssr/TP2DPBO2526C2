import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;


public class Main {

    // Scanner global untuk input user
    private static final Scanner sc = new Scanner(System.in);

    // List untuk menyimpan semua objek SenjataDagangan
    private static final List<SenjataDagangan> daftar = new ArrayList<>();

    // Cari index berdasarkan ID (untuk cek duplikat)
    private static int cariIndexById(String id) {
        for (int i = 0; i < daftar.size(); i++) {
            if (daftar.get(i).getIdSenjata().equals(id)) return i;
        }
        return -1;
    }

    // Helper untuk mengulang karakter (misal "-".repeat)
    private static String ulang(char c, int n) {
        StringBuilder sb = new StringBuilder();
        for (int i = 0; i < n; i++) sb.append(c);
        return sb.toString();
    }

    // Tabel dinamis
    private static void cetakTabel(String[] header, List<List<String>> rows) {
        int n = header.length;
        int[] lebar = new int[n];

        // Lebar awal dari header
        for (int i = 0; i < n; i++) lebar[i] = header[i].length();

        // Bandingkan dengan setiap cell
        for (List<String> row : rows) {
            for (int i = 0; i < n; i++) {
                if (row.get(i).length() > lebar[i]) lebar[i] = row.get(i).length();
            }
        }

        for (int i = 0; i < n; i++) lebar[i] += 2; // padding

        // Fungsi untuk mencetak garis
        Runnable garis = () -> {
            for (int l : lebar) System.out.print("+" + ulang('-', l));
            System.out.println("+");
        };

        garis.run();

        StringBuilder hd = new StringBuilder();
        for (int i = 0; i < n; i++) {
            hd.append(String.format("|%-" + lebar[i] + "s", " " + header[i]));
        }
        hd.append("|");
        System.out.println(hd);

        garis.run();

        for (List<String> row : rows) {
            StringBuilder rb = new StringBuilder();
            for (int i = 0; i < n; i++) {
                rb.append(String.format("|%-" + lebar[i] + "s", " " + row.get(i)));
            }
            rb.append("|");
            System.out.println(rb);
        }

        garis.run();
    }

    // Validasi input tidak boleh kosong
    private static String inputNotEmpty(String prompt) {
        while (true) {
            System.out.print(prompt);
            String val = sc.nextLine().trim();
            if (val.isEmpty()) {
                System.out.println("Input tidak boleh kosong!");
                continue;
            }
            return val;
        }
    }

    // Validasi harga harus angka dan >= 0
    private static double inputHarga() {
        while (true) {
            System.out.print("Harga (Rp)        : ");
            try {
                double h = Double.parseDouble(sc.nextLine().trim());
                if (h < 0) {
                    System.out.println("Harga tidak boleh negatif!");
                    continue;
                }
                return h;
            } catch (NumberFormatException e) {
                System.out.println("Harga harus berupa angka!");
            }
        }
    }

    // Validasi stok harus integer dan >= 0
    private static int inputStok() {
        while (true) {
            System.out.print("Stok              : ");
            try {
                int s = Integer.parseInt(sc.nextLine().trim());
                if (s < 0) {
                    System.out.println("Stok tidak boleh negatif!");
                    continue;
                }
                return s;
            } catch (NumberFormatException e) {
                System.out.println("Stok harus berupa angka bulat!");
            }
        }
    }

    // Validasi garansi menerima Ya/Tidak (y/n, true/false, 1/0)
    private static boolean inputGaransi() {
        while (true) {
            System.out.print("Garansi (Ya/Tidak): ");
            String g = sc.nextLine().trim().toLowerCase();
            if (g.equals("ya") || g.equals("y") || g.equals("true") || g.equals("1")) return true;
            if (g.equals("tidak") || g.equals("t") || g.equals("false") || g.equals("0") || g.equals("n")) return false;
            System.out.println("Input garansi harus Ya/Tidak (y/n)!");
        }
    }

    // Prosedur tambah data dengan validasi ID duplikat
    private static void tambahData() {
        System.out.println();
        System.out.println("--- Tambah Data Senjata Dagangan ---");

        String id;
        while (true) {
            System.out.print("ID Senjata        : ");
            id = sc.nextLine().trim();
            if (id.isEmpty()) {
                System.out.println("ID tidak boleh kosong!");
                continue;
            }
            if (cariIndexById(id) != -1) {
                System.out.println("ID sudah dipakai!");
                continue;
            }
            break;
        }

        String nama        = inputNotEmpty("Nama              : ");
        String jenis       = inputNotEmpty("Jenis             : ");
        String spesifikasi = inputNotEmpty("Spesifikasi       : ");
        String madeIn      = inputNotEmpty("Made In           : ");
        double harga       = inputHarga();
        int    stok        = inputStok();
        String kondisi     = inputNotEmpty("Kondisi (Baru/Bekas): ");
        boolean garansi    = inputGaransi();
        String kode        = inputNotEmpty("Kode Lisensi Jual : ");
        String penjual     = inputNotEmpty("Penjual           : ");

        daftar.add(new SenjataDagangan(id, nama, jenis, spesifikasi, madeIn, harga, stok, kondisi, garansi, kode, penjual));

        System.out.println("Data berhasil ditambahkan!");
    }

    // Menampilkan semua data dalam tabel dinamis 11 kolom
    private static void tampilkanData() {
        System.out.println();
        System.out.println("--- Daftar Senjata Dagangan ---");

        if (daftar.isEmpty()) {
            System.out.println("Belum ada data.");
            return;
        }

        String[] header = {"ID", "Nama", "Jenis", "Spesifikasi", "Made In", "Harga", "Stok", "Kondisi", "Garansi", "Kode Lisensi", "Penjual"};

        List<List<String>> rows = new ArrayList<>();
        for (SenjataDagangan s : daftar) rows.add(s.toRow());

        cetakTabel(header, rows);
    }

    // Menu utama
    private static void tampilkanMenu() {
        System.out.println();
        System.out.println("===============================");
        System.out.println("  MANAJEMEN SENJATA DAGANGAN");
        System.out.println("===============================");
        System.out.println("1. Tambah Data Senjata Dagangan");
        System.out.println("2. Tampilkan Semua Data");
        System.out.println("0. Keluar");
        System.out.print("Pilih menu: ");
    }

    // Animasi keluar
    private static void animasiKeluar() {
        System.out.print("\nMenutup program");

        for (int i = 0; i < 3; i++) {
            try { Thread.sleep(400); } catch (InterruptedException e) {}
            System.out.print(".");
            System.out.flush();
        }

        System.out.println("\n");

        // Banner TP 2 ASCII - sama di cpp/python (versi baru kamu)
        String[] banner = {
            "#####  ####   ###      ####   ###  #   # #####",
            "  #    #   # #   #     #   # #   # ##  # #    ",
            "  #    ####     #      #   # #   # # # # #### ",
            "  #    #       #       #   # #   # #  ## #    ",
            "  #    #      ####     ####   ###  #   # #####"
        };

        for (String baris : banner) {
            try { Thread.sleep(150); } catch (InterruptedException e) {}
            System.out.println(baris);
        }

        System.out.println();
    }

    public static void main(String[] args) {

        // 5 objek awal (sebelum input user) - wajib sesuai requirement
        daftar.add(new SenjataDagangan("SNJ001", "Glock 19",      "Pistol",  "9mm, Polymer Frame, 15 rounds",    "Austria", 12500000, 12, "Baru",  true,  "LIS-G19-001",  "Toko Senjata Jaya"));
        daftar.add(new SenjataDagangan("SNJ002", "AK-47",         "Rifle",   "7.62mm, Wood Stock, 30 rounds",    "Rusia",   25000000, 8,  "Bekas", false, "LIS-AK47-002", "CV Mandiri Arms"));
        daftar.add(new SenjataDagangan("SNJ003", "M4A1",          "Rifle",   "5.56mm, Tactical Rail, 30 rounds", "USA",     32000000, 5,  "Baru",  true,  "LIS-M4A1-003", "PT Pindad Store"));
        daftar.add(new SenjataDagangan("SNJ004", "Desert Eagle",  "Pistol",  ".50 AE, Gas Operated, 7 rounds",   "India",   45000000, 3,  "Baru",  true,  "LIS-DE-004",   "Toko Senjata Jaya"));
        daftar.add(new SenjataDagangan("SNJ005", "Remington 870", "Shotgun", "12 Gauge, Pump Action, 8 rounds",  "USA",     18000000, 10, "Bekas", false, "LIS-R870-005", "CV Mandiri Arms"));

        System.out.println(">>> 5 Data Awal Senjata Dagangan <<<");
        tampilkanData();

        // Loop menu sampai user pilih keluar
        int pilihan;

        do {
            tampilkanMenu();
            try {
                pilihan = Integer.parseInt(sc.nextLine().trim());
            } catch (NumberFormatException e) {
                System.out.println("Input harus berupa angka!");
                pilihan = -1;
                continue;
            }

            switch (pilihan) {
                case 1:  tambahData();    break;
                case 2:  tampilkanData(); break;
                case 0:  animasiKeluar(); break;
                default: System.out.println("Pilihan tidak valid!");
            }

        } while (pilihan != 0);
    }
}
