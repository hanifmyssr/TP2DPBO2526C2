#include <bits/stdc++.h>
#include "SenjataDagangan.cpp"

// Tabel Dinamis
void cetakTabel(const vector<string>& header, const vector<vector<string>>& rows) {
    int n = header.size();
    vector<size_t> lebar(n);

    // Lebar awal dari header
    for (int i = 0; i < n; i++) {
        lebar[i] = header[i].size();
    }

    // Bandingkan dengan setiap cell untuk cari lebar maksimal
    for (const auto& row : rows) {
        for (int i = 0; i < n; i++) {
            if (row[i].size() > lebar[i]) {
                lebar[i] = row[i].size();
            }
        }
    }

    for (auto& l : lebar) l += 2; // padding

    auto garis = [&]() {
        for (size_t l : lebar) cout << "+" << string(l, '-');
        cout << "+" << endl;
    };

    garis();
    cout << left;

    // Cetak header
    for (int i = 0; i < n; i++) {
        cout << "|" << setw(lebar[i]) << (" " + header[i]);
    }
    cout << "|" << endl;
    garis();

    // Cetak setiap baris data
    for (const auto& row : rows) {
        for (int i = 0; i < n; i++) {
            cout << "|" << setw(lebar[i]) << (" " + row[i]);
        }
        cout << "|" << endl;
    }

    garis();
}


// Data Objek
vector<SenjataDagangan> daftar;


// Cari index berdasarkan ID (untuk cek duplikat)
int cariIndexById(string id) {
    for (int i = 0; i < (int) daftar.size(); i++) {
        if (daftar[i].getIdSenjata() == id) return i;
    }
    return -1;
}

// Validasi input tidak boleh kosong
string inputNotEmpty(string prompt) {
    string val;

    while (true) {
        cout << prompt;
        getline(cin, val);

        // Trim spasi di awal/akhir
        size_t start = val.find_first_not_of(" \t\r\n");
        size_t end   = val.find_last_not_of(" \t\r\n");

        if (start == string::npos) {
            cout << "Input tidak boleh kosong!" << endl;
            continue;
        }

        val = val.substr(start, end - start + 1);

        if (val.empty()) {
            cout << "Input tidak boleh kosong!" << endl;
            continue;
        }

        return val;
    }
}

// Validasi harga harus angka dan >= 0
double inputHarga() {
    double h;

    while (true) {
        cout << "Harga (Rp)        : ";
        cin >> h;

        if (cin.fail()) {
            cin.clear();
            cin.ignore(1000, '\n');
            cout << "Harga harus berupa angka!" << endl;
            continue;
        }

        cin.ignore(1000, '\n');

        if (h < 0) {
            cout << "Harga tidak boleh negatif!" << endl;
            continue;
        }

        return h;
    }
}

// Validasi stok harus integer dan >= 0
int inputStok() {
    int s;

    while (true) {
        cout << "Stok              : ";
        cin >> s;

        if (cin.fail()) {
            cin.clear();
            cin.ignore(1000, '\n');
            cout << "Stok harus berupa angka bulat!" << endl;
            continue;
        }

        cin.ignore(1000, '\n');

        if (s < 0) {
            cout << "Stok tidak boleh negatif!" << endl;
            continue;
        }

        return s;
    }
}

// Validasi garansi menerima Ya/Tidak (y/n, true/false, 1/0)
bool inputGaransi() {
    string g;

    while (true) {
        cout << "Garansi (Ya/Tidak): ";
        getline(cin, g);

        transform(g.begin(), g.end(), g.begin(), ::tolower);

        // Trim
        size_t start = g.find_first_not_of(" \t\r\n");
        size_t end   = g.find_last_not_of(" \t\r\n");

        if (start != string::npos) g = g.substr(start, end - start + 1);
        else                       g = "";

        if (g == "ya" || g == "y" || g == "true" || g == "1") return true;
        if (g == "tidak" || g == "t" || g == "false" || g == "0" || g == "n") return false;

        cout << "Input garansi harus Ya/Tidak (y/n)!" << endl;
    }
}

// Prosedur tambah data dengan validasi ID duplikat
void tambahData() {
    cout << "\n--- Tambah Data Senjata Dagangan ---" << endl;

    string id;
    while (true) {
        cout << "ID Senjata        : ";
        getline(cin, id);

        size_t start = id.find_first_not_of(" \t\r\n");
        size_t end   = id.find_last_not_of(" \t\r\n");

        if (start == string::npos) {
            cout << "ID tidak boleh kosong!" << endl;
            continue;
        }

        id = id.substr(start, end - start + 1);

        if (id.empty()) {
            cout << "ID tidak boleh kosong!" << endl;
            continue;
        }

        if (cariIndexById(id) != -1) {
            cout << "ID sudah dipakai!" << endl;
            continue;
        }

        break;
    }

    string nama        = inputNotEmpty("Nama              : ");
    string jenis       = inputNotEmpty("Jenis             : ");
    string spesifikasi = inputNotEmpty("Spesifikasi       : ");
    string madeIn      = inputNotEmpty("Made In           : ");
    double harga       = inputHarga();
    int    stok        = inputStok();
    string kondisi     = inputNotEmpty("Kondisi (Baru/Bekas): ");
    bool   garansi     = inputGaransi();
    string kode        = inputNotEmpty("Kode Lisensi Jual : ");
    string penjual     = inputNotEmpty("Penjual           : ");

    daftar.push_back(SenjataDagangan(id, nama, jenis, spesifikasi, madeIn, harga, stok, kondisi, garansi, kode, penjual));

    cout << "Data berhasil ditambahkan!" << endl;
}

// Menampilkan semua data dalam tabel dinamis 11 kolom
void tampilkanData() {
    cout << "\n--- Daftar Senjata Dagangan ---" << endl;

    if (daftar.empty()) {
        cout << "Belum ada data." << endl;
        return;
    }

    vector<string> header = {"ID", "Nama", "Jenis", "Spesifikasi", "Made In", "Harga", "Stok", "Kondisi", "Garansi", "Kode Lisensi", "Penjual"};

    vector<vector<string>> rows;
    for (auto& s : daftar) rows.push_back(s.toRow());

    cetakTabel(header, rows);
}

// Menu utama
void tampilkanMenu() {
    cout << "\n===============================" << endl;
    cout << "  MANAJEMEN SENJATA DAGANGAN" << endl;
    cout << "===============================" << endl;
    cout << "1. Tambah Data Senjata Dagangan" << endl;
    cout << "2. Tampilkan Semua Data" << endl;
    cout << "0. Keluar" << endl;
    cout << "Pilih menu: ";
}

// Animasi keluar
void animasiKeluar() {
    cout << "\nMenutup program";

    for (int i = 0; i < 3; i++) {
        this_thread::sleep_for(chrono::milliseconds(400));
        cout << "." << flush;
    }

    cout << "\n\n";

    vector<string> banner = {
        "#####  ####   ###      ####   ###  #   # #####",
        "  #    #   # #   #     #   # #   # ##  # #    ",
        "  #    ####     #      #   # #   # # # # #### ",
        "  #    #       #       #   # #   # #  ## #    ",
        "  #    #      ####     ####   ###  #   # #####"
    };

    for (auto& baris : banner) {
        this_thread::sleep_for(chrono::milliseconds(150));
        cout << baris << endl;
    }

    cout << endl;
}

int main() {
    // 5 objek awal (sebelum input user)
    daftar.push_back(SenjataDagangan("SNJ001", "Glock 19",      "Pistol",  "9mm, Polymer Frame, 15 rounds",    "Austria", 12500000, 12, "Baru",  true,  "LIS-G19-001",  "Toko Senjata Jaya"));
    daftar.push_back(SenjataDagangan("SNJ002", "AK-47",         "Rifle",   "7.62mm, Wood Stock, 30 rounds",    "Rusia",   25000000, 8,  "Bekas", false, "LIS-AK47-002", "CV Mandiri Arms"));
    daftar.push_back(SenjataDagangan("SNJ003", "M4A1",          "Rifle",   "5.56mm, Tactical Rail, 30 rounds", "USA",     32000000, 5,  "Baru",  true,  "LIS-M4A1-003", "PT Pindad Store"));
    daftar.push_back(SenjataDagangan("SNJ004", "Desert Eagle",  "Pistol",  ".50 AE, Gas Operated, 7 rounds",   "India",   45000000, 3,  "Baru",  true,  "LIS-DE-004",   "Toko Senjata Jaya"));
    daftar.push_back(SenjataDagangan("SNJ005", "Remington 870", "Shotgun", "12 Gauge, Pump Action, 8 rounds",  "USA",     18000000, 10, "Bekas", false, "LIS-R870-005", "CV Mandiri Arms"));

    cout << ">>> 5 Data Awal Senjata Dagangan <<<" << endl;
    tampilkanData();

    // Loop menu sampai user pilih keluar
    int pilihan;

    do {
        tampilkanMenu();
        cin >> pilihan;

        if (cin.fail()) {
            cin.clear();
            cin.ignore(1000, '\n');
            cout << "Input harus berupa angka!" << endl;
            pilihan = -1;
            continue;
        }

        cin.ignore(1000, '\n');

        switch (pilihan) {
            case 1:  tambahData();    break;
            case 2:  tampilkanData(); break;
            case 0:  animasiKeluar(); break;
            default: cout << "Pilihan tidak valid!" << endl;
        }

    } while (pilihan != 0);

    return 0;
}
