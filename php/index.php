<?php
require_once "SenjataDagangan.php";
session_start();

// Tombol reset: hapus session agar data awal ter-load ulang (fix gambar lama)
if (isset($_GET["reset"])) {
    unset($_SESSION["senjata"]);
    header("Location: index.php");
    exit;
}

// Auto-fix: jika session lama masih pakai path lama (glock19.jpg), rebuild
$needsRebuild = false;
if (isset($_SESSION["senjata"]) && count($_SESSION["senjata"]) > 0) {
    $firstFoto = $_SESSION["senjata"][0]->getFotoProduk();
    if (strpos($firstFoto, "glock19.jpg") !== false ||
        strpos($firstFoto, "ak47.jpg")    !== false ||
        $firstFoto === "") {
        $needsRebuild = true;
    }
}
if ($needsRebuild) {
    unset($_SESSION["senjata"]);
}

// 5 objek awal (sesuai file di php/img/)
if (!isset($_SESSION["senjata"])) {
    $_SESSION["senjata"] = array();
    $_SESSION["senjata"][] = new SenjataDagangan("SNJ001", "Glock 19",      "Pistol",  "9mm, Polymer Frame, 15 rounds",    "Austria", 12500000, 12, "Baru",  true,  "LIS-G19-001",  "Toko Senjata Jaya", "img/Glock.jpg");
    $_SESSION["senjata"][] = new SenjataDagangan("SNJ002", "AK-47",         "Rifle",   "7.62mm, Wood Stock, 30 rounds",    "Rusia",   25000000, 8,  "Bekas", false, "LIS-AK47-002", "CV Mandiri Arms",   "img/AK-47.jpg");
    $_SESSION["senjata"][] = new SenjataDagangan("SNJ003", "M4A1",          "Rifle",   "5.56mm, Tactical Rail, 30 rounds", "USA",     32000000, 5,  "Baru",  true,  "LIS-M4A1-003", "PT Pindad Store",   "img/MPA1.jpg");
    $_SESSION["senjata"][] = new SenjataDagangan("SNJ004", "Desert Eagle",  "Pistol",  ".50 AE, Gas Operated, 7 rounds",   "India",   45000000, 3,  "Baru",  true,  "LIS-DE-004",   "Toko Senjata Jaya", "img/Desert Eagle.jpg");
    $_SESSION["senjata"][] = new SenjataDagangan("SNJ005", "Remington 870", "Shotgun", "12 Gauge, Pump Action, 8 rounds",  "USA",     18000000, 10, "Bekas", false, "LIS-R870-005", "CV Mandiri Arms",   "img/Remington 870.jpg");
}

$daftar = &$_SESSION["senjata"];


// Cari index berdasarkan ID (untuk cek duplikat)
function cariIndexById($daftar, $id) {
    foreach ($daftar as $i => $s) {
        if ($s->getIdSenjata() === $id) return $i;
    }
    return -1;
}


$pesan = "";
$error = "";
$old   = array();

// Proses tambah data (POST) dengan validasi server-side
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id        = trim($_POST["idSenjata"]      ?? "");
    $nama      = trim($_POST["nama"]           ?? "");
    $jenis     = trim($_POST["jenis"]          ?? "");
    $spesifikasi = trim($_POST["spesifikasi"]  ?? "");
    $madeIn    = trim($_POST["madeIn"]         ?? "");
    $harga     = $_POST["harga"]               ?? "";
    $stok      = $_POST["stok"]                ?? "";
    $kondisi   = trim($_POST["kondisi"]        ?? "");
    $garansi   = $_POST["garansi"]             ?? "";
    $kode      = trim($_POST["kodeLisensiJual"] ?? "");
    $penjual   = trim($_POST["penjual"]        ?? "");
    $foto      = trim($_POST["foto_produk"]    ?? "");

    $old = array(
        "idSenjata"      => $id,       "nama"      => $nama,
        "jenis"          => $jenis,    "spesifikasi" => $spesifikasi,
        "madeIn"         => $madeIn,   "harga"     => $harga,
        "stok"           => $stok,     "kondisi"   => $kondisi,
        "garansi"        => $garansi,  "kodeLisensiJual" => $kode,
        "penjual"        => $penjual,  "foto_produk" => $foto
    );

    if ($id === "" || $nama === "" || $jenis === "" || $spesifikasi === "" ||
        $madeIn === "" || $kondisi === "" || $kode === "" || $penjual === "" || $foto === "") {
        $error = "Semua field harus diisi!";
    } elseif (!is_numeric($harga) || floatval($harga) < 0) {
        $error = "Harga harus angka >= 0!";
    } elseif (!ctype_digit(strval($stok)) || intval($stok) < 0) {
        $error = "Stok harus angka bulat >= 0!";
    } elseif ($garansi !== "0" && $garansi !== "1") {
        $error = "Garansi harus dipilih!";
    } else {
        if (cariIndexById($daftar, $id) !== -1) {
            $error = "ID sudah dipakai!";
        } else {
            $daftar[] = new SenjataDagangan(
                $id, $nama, $jenis, $spesifikasi, $madeIn,
                floatval($harga), intval($stok), $kondisi, $garansi === "1",
                $kode, $penjual, $foto
            );
            $pesan = "Data senjata dagangan berhasil ditambahkan!";
            $old   = array();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Senjata Dagangan</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #0a0a0a;
            color: #eee;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #000000 0%, #7a0000 50%, #e63946 100%);
            padding: 25px 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(230,57,70,.4);
            border-bottom: 3px solid #e63946;
        }

        .header h1 {
            font-size: 24px;
            letter-spacing: 2px;
            color: #fff;
            text-shadow: 0 2px 8px rgba(0,0,0,.8);
        }

        .container {
            max-width: 1300px;
            margin: 25px auto;
            padding: 0 20px;
        }

        .card {
            background: #1a1a1a;
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 25px;
            box-shadow: 0 6px 18px rgba(0,0,0,.6);
            border: 1px solid #330000;
        }

        .card h2 {
            color: #e63946;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #e63946;
            padding-bottom: 8px;
        }

        .alert {
            border-radius: 6px;
            padding: 12px 15px;
            margin-bottom: 0;
            border-left: 5px solid;
            font-size: 14px;
        }

        .success { background: #1a2e1a; color: #7ee2a8; border-left-color: #2fbf71; }
        .error   { background: #40141b; color: #ff9aa2; border-left-color: #e63946; margin-top: 10px; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #111111;
            border-radius: 8px;
            overflow: hidden;
            font-size: 13px;
        }

        table th, table td {
            border: 1px solid #330000;
            padding: 8px 10px;
            text-align: left;
        }

        table thead th {
            background: #e63946;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
            white-space: nowrap;
        }

        table tbody tr:nth-child(even) { background: #1e1e1e; }
        table tbody tr:hover           { background: #2a0a0a; }

        img.thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 2px solid #7a0000;
            display: block;
            background: #0a0a0a;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            transition: filter .2s;
        }

        .btn:hover      { filter: brightness(1.15); }
        .btn-primary    { background: #e63946; }

        form p { margin-bottom: 12px; }

        form label {
            display: inline-block;
            width: 160px;
            font-size: 14px;
            color: #ffcccc;
            vertical-align: top;
        }

        form input[type=text],
        form input[type=number],
        form select {
            width: 320px;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #7a0000;
            background: #111111;
            color: #eee;
            font-size: 14px;
        }

        form input:focus,
        form select:focus {
            outline: none;
            border-color: #e63946;
            box-shadow: 0 0 6px rgba(230,57,70,.5);
        }

        .empty  { color: #8b88a8; text-align: center; padding: 20px; font-style: italic; }
        .lokasi { color: #aaa; font-size: 11px; }

        @media (max-width: 700px) {
            form label { display: block; width: 100%; margin-bottom: 4px; }
            form input, form select { width: 100%; }
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Apex Tactical </h1>
</div>

<div class="container">

    <?php if ($pesan !== "" || $error !== "") : ?>
    <div class="card">
        <?php if ($pesan !== "") : ?><div class="alert success"><?php echo htmlspecialchars($pesan); ?></div><?php endif; ?>
        <?php if ($error !== "") : ?><div class="alert error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Daftar senjata -->
    <div class="card">
        <h2>Daftar Senjata Dagangan (<?php echo count($daftar); ?> data)</h2>

        <?php if (count($daftar) === 0) : ?>
            <p class="empty">Belum ada data.</p>
        <?php else : ?>
            <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Spesifikasi</th>
                        <th>Made In</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th>Garansi</th>
                        <th>Kode Lisensi</th>
                        <th>Penjual</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($daftar as $s) : ?>
                    <?php
                        // Encode spasi di nama file agar URL valid (Desert Eagle.jpg -> Desert%20Eagle.jpg)
                        $fotoSrc = $s->getFotoProduk();
                        $parts   = explode("/", $fotoSrc);
                        $parts   = array_map("rawurlencode", $parts);
                        $fotoSrcEncoded = implode("/", $parts);
                    ?>
                    <tr>
                        <td>
                            <img class="thumb"
                                 src="<?php echo htmlspecialchars($fotoSrcEncoded); ?>"
                                 alt="<?php echo htmlspecialchars($s->getNama()); ?>"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='inline';">
                            <span class="lokasi" style="display:none;">No img (<?php echo htmlspecialchars($s->getFotoProduk()); ?>)</span>
                            <?php if (!file_exists(__DIR__ . "/" . $s->getFotoProduk())) : ?>
                                <br><span class="lokasi" style="color:#ff6b6b;">⚠ File tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($s->getIdSenjata()); ?></td>
                        <td><?php echo htmlspecialchars($s->getNama()); ?></td>
                        <td><?php echo htmlspecialchars($s->getJenis()); ?></td>
                        <td><?php echo htmlspecialchars($s->getSpesifikasi()); ?></td>
                        <td><?php echo htmlspecialchars($s->getMadeIn()); ?></td>
                        <td><?php echo $s->getHargaFormatted(); ?></td>
                        <td><?php echo $s->getStok(); ?></td>
                        <td><?php echo htmlspecialchars($s->getKondisi()); ?></td>
                        <td><?php echo $s->getGaransiStr(); ?></td>
                        <td><?php echo htmlspecialchars($s->getKodeLisensiJual()); ?></td>
                        <td><?php echo htmlspecialchars($s->getPenjual()); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Form tambah data -->
    <div class="card">
        <h2>Tambah Data Senjata Dagangan</h2>

        <form method="post" action="index.php">
            <p><label>ID Senjata</label><input type="text"   name="idSenjata"      value="<?php echo htmlspecialchars($old["idSenjata"] ?? ""); ?>" placeholder="SNJ006"></p>
            <p><label>Nama</label><input type="text"         name="nama"           value="<?php echo htmlspecialchars($old["nama"] ?? ""); ?>"      placeholder="Beretta M9"></p>
            <p><label>Jenis</label><input type="text"        name="jenis"          value="<?php echo htmlspecialchars($old["jenis"] ?? ""); ?>"     placeholder="Pistol / Rifle / Shotgun"></p>
            <p><label>Spesifikasi</label><input type="text"  name="spesifikasi"    value="<?php echo htmlspecialchars($old["spesifikasi"] ?? ""); ?>" placeholder="Kaliber, fitur"></p>
            <p><label>Made In</label><input type="text"      name="madeIn"         value="<?php echo htmlspecialchars($old["madeIn"] ?? ""); ?>"    placeholder="USA / Jerman"></p>
            <p><label>Harga (Rp)</label><input type="number" name="harga"          value="<?php echo htmlspecialchars($old["harga"] ?? ""); ?>"     min="0" step="1000"></p>
            <p><label>Stok</label><input type="number"       name="stok"           value="<?php echo htmlspecialchars($old["stok"] ?? ""); ?>"      min="0"></p>
            <p><label>Kondisi</label><input type="text"      name="kondisi"        value="<?php echo htmlspecialchars($old["kondisi"] ?? ""); ?>"   placeholder="Baru / Bekas"></p>
            <p>
                <label>Garansi</label>
                <select name="garansi">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if (($old["garansi"] ?? "") === "1") echo "selected"; ?>>Ya</option>
                    <option value="0" <?php if (($old["garansi"] ?? "") === "0") echo "selected"; ?>>Tidak</option>
                </select>
            </p>
            <p><label>Kode Lisensi Jual</label><input type="text" name="kodeLisensiJual" value="<?php echo htmlspecialchars($old["kodeLisensiJual"] ?? ""); ?>" placeholder="LIS-XXX-000"></p>
            <p><label>Penjual</label><input type="text"        name="penjual"        value="<?php echo htmlspecialchars($old["penjual"] ?? ""); ?>"   placeholder="Nama toko"></p>
            <p><label>Foto Produk</label><input type="text"    name="foto_produk"    value="<?php echo htmlspecialchars($old["foto_produk"] ?? ""); ?>" placeholder="img/nama.jpg"></p>

            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn" style="background:#6c757d;" href="index.php">Reset</a>
        </form>
    </div>

</div>

</body>
</html>
