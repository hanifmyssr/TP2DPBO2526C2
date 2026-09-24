from SenjataDagangan import SenjataDagangan
import time
import sys

# Tabel dinamis
def cetak_tabel(header, rows):
    n = len(header)

    # Hitung lebar awal dari header
    lebar = [len(h) for h in header]

    # Bandingkan dengan setiap cell untuk cari lebar maksimal
    for row in rows:
        for i in range(n):
            if len(row[i]) > lebar[i]:
                lebar[i] = len(row[i])

    # Tambah 2 untuk padding kiri-kanan
    lebar = [l + 2 for l in lebar]

    # Helper untuk mencetak garis pemisah
    def garis():
        print("".join("+" + "-" * l for l in lebar) + "+")

    garis()

    # Cetak header
    print("".join("|" + " " + header[i].ljust(lebar[i] - 1) for i in range(n)) + "|")
    garis()

    # Cetak setiap baris data
    for row in rows:
        print("".join("|" + " " + row[i].ljust(lebar[i] - 1) for i in range(n)) + "|")

    garis()


# Menyimpan data objek
daftar = []


# Cari index berdasarkan ID (untuk cek duplikat)
def cari_index_by_id(id_senjata):
    for i, s in enumerate(daftar):
        if s.get_id_senjata() == id_senjata:
            return i
    return -1

# Validasi input tidak boleh kosong
def input_not_empty(prompt):
    while True:
        val = input(prompt).strip()
        if not val:
            print("Input tidak boleh kosong!")
            continue
        return val


# Validasi harga harus angka dan >= 0
def input_harga():
    while True:
        try:
            h = float(input("Harga (Rp)        : ").strip())
        except ValueError:
            print("Harga harus berupa angka!")
            continue
        if h < 0:
            print("Harga tidak boleh negatif!")
            continue
        return h


# Validasi stok harus integer dan >= 0
def input_stok():
    while True:
        try:
            s = int(input("Stok              : ").strip())
        except ValueError:
            print("Stok harus berupa angka bulat!")
            continue
        if s < 0:
            print("Stok tidak boleh negatif!")
            continue
        return s


# Validasi garansi menerima Ya/Tidak (y/n, true/false, 1/0)
def input_garansi():
    while True:
        g = input("Garansi (Ya/Tidak): ").strip().lower()
        if g in ["ya", "y", "true", "1"]:
            return True
        elif g in ["tidak", "t", "false", "0", "n"]:
            return False
        else:
            print("Input garansi harus Ya/Tidak (y/n)!")

# Prosedur tambah data dengan validasi ID duplikat
def tambah_data():
    print("\n--- Tambah Data Senjata Dagangan ---")

    while True:
        id_senjata = input("ID Senjata        : ").strip()
        if not id_senjata:
            print("ID tidak boleh kosong!")
            continue
        if cari_index_by_id(id_senjata) != -1:
            print("ID sudah dipakai!")
            continue
        break

    nama        = input_not_empty("Nama              : ")
    jenis       = input_not_empty("Jenis             : ")
    spesifikasi = input_not_empty("Spesifikasi       : ")
    made_in     = input_not_empty("Made In           : ")
    harga       = input_harga()
    stok        = input_stok()
    kondisi     = input_not_empty("Kondisi (Baru/Bekas): ")
    garansi     = input_garansi()
    kode        = input_not_empty("Kode Lisensi Jual : ")
    penjual     = input_not_empty("Penjual           : ")

    daftar.append(SenjataDagangan(
        id_senjata, nama, jenis, spesifikasi, made_in,
        harga, stok, kondisi, garansi, kode, penjual
    ))
    print("Data berhasil ditambahkan!")


# Menampilkan semua data dalam tabel dinamis 11 kolom
def tampilkan_data():
    print("\n--- Daftar Senjata Dagangan ---")

    if not daftar:
        print("Belum ada data.")
        return

    header = ["ID", "Nama", "Jenis", "Spesifikasi", "Made In", "Harga", "Stok", "Kondisi", "Garansi", "Kode Lisensi", "Penjual"]
    rows = [s.to_row() for s in daftar]
    cetak_tabel(header, rows)


# Menu utama
def tampilkan_menu():
    print("\n===============================")
    print("  MANAJEMEN SENJATA DAGANGAN")
    print("===============================")
    print("1. Tambah Data Senjata Dagangan")
    print("2. Tampilkan Semua Data")
    print("0. Keluar")
    print("Pilih menu: ", end="")


# Animasi keluar
def animasi_keluar():
    print("\nMenutup program", end="")

    for _ in range(3):
        time.sleep(0.4)
        print(".", end="")
        sys.stdout.flush()

    print("\n")

    banner = [
        "#####  ####   ###      ####   ###  #   # #####",
        "  #    #   # #   #     #   # #   # ##  # #    ",
        "  #    ####     #      #   # #   # # # # #### ",
        "  #    #       #       #   # #   # #  ## #    ",
        "  #    #      ####     ####   ###  #   # #####",
    ]

    for baris in banner:
        time.sleep(0.15)
        print(baris)

    print()

def main():

    # 5 objek awal (sebelum input user)
    daftar.append(SenjataDagangan("SNJ001", "Glock 19",      "Pistol",  "9mm, Polymer Frame, 15 rounds",    "Austria", 12500000, 12, "Baru",  True,  "LIS-G19-001",  "Toko Senjata Jaya"))
    daftar.append(SenjataDagangan("SNJ002", "AK-47",         "Rifle",   "7.62mm, Wood Stock, 30 rounds",    "Rusia",   25000000, 8,  "Bekas", False, "LIS-AK47-002", "CV Mandiri Arms"))
    daftar.append(SenjataDagangan("SNJ003", "M4A1",          "Rifle",   "5.56mm, Tactical Rail, 30 rounds", "USA",     32000000, 5,  "Baru",  True,  "LIS-M4A1-003", "PT Pindad Store"))
    daftar.append(SenjataDagangan("SNJ004", "Desert Eagle",  "Pistol",  ".50 AE, Gas Operated, 7 rounds",   "India",   45000000, 3,  "Baru",  True,  "LIS-DE-004",   "Toko Senjata Jaya"))
    daftar.append(SenjataDagangan("SNJ005", "Remington 870", "Shotgun", "12 Gauge, Pump Action, 8 rounds",  "USA",     18000000, 10, "Bekas", False, "LIS-R870-005", "CV Mandiri Arms"))

    print(">>> 5 Data Awal Senjata Dagangan <<<")
    tampilkan_data()

    # Loop menu sampai user pilih keluar
    while True:
        tampilkan_menu()
        try:
            pilihan = int(input())
        except ValueError:
            print("Input harus berupa angka!")
            continue

        if pilihan == 1:
            tambah_data()
        elif pilihan == 2:
            tampilkan_data()
        elif pilihan == 0:
            animasi_keluar()
            break
        else:
            print("Pilihan tidak valid!")


if __name__ == "__main__":
    main()
