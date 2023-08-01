<?php 

function getClassName($className) 
{
  $class_parts = explode('\\', $className);
  return end($class_parts);
}
function formatNomorHp($phoneNumber)
{
    // Menghapus semua karakter non-digit dari nomor HP
    $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

    // Cek panjang nomor HP setelah dihapus karakter non-digit
    $phoneNumberLength = strlen($phoneNumber);

    // Jika panjang nomor HP lebih dari 10 digit dan dimulai dengan "62"
    if ($phoneNumberLength > 10 && substr($phoneNumber, 0, 2) === '62') {
        // Mengambil 3 digit pertama setelah "62"
        $prefix = substr($phoneNumber, 2, 3);

        // Mengambil sisa digit nomor HP
        $suffix = substr($phoneNumber, 5);

        // Menggabungkan dengan format "08xx-xxxx-xxxx"
        $formattedPhoneNumber = '0' . $prefix . '-' . chunk_split($suffix, 4, '-');

        return rtrim($formattedPhoneNumber, '-');
    }

    return $phoneNumber; // Mengembalikan nomor HP asli jika tidak sesuai format
}


function bulanTagihan() {
  return[
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
  ];
}

function ubahNamaBulan($angka) {
  $namaBulan = [
    '' => '',
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
  ];
  return $namaBulan[$angka];
}

function ubahNamaBulanSingkat($angka) {
  $namaBulan = [
    '' => '',
    '1' => 'Jan',
    '2' => 'Feb',
    '3' => 'Mar',
    '4' => 'Apr',
    '5' => 'May',
    '6' => 'Jun',
    '7' => 'Jul',
    '8' => 'Aug',
    '9' => 'Sept',
    '10' => 'Oct',
    '11' => 'Nov',
    '12' => 'Des',
  ];
  return $namaBulan[$angka];
}

function ubahBulanLaravel($angka) {
  $namaBulan = [
    '' => '',
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
  ];
  return $namaBulan[$angka];
}

function formatRupiah($nominal, $prefix = null) {
    $prefix = $prefix ? $prefix : 'Rp';
    return $prefix . number_format($nominal, 0, ',', '.');
}

function terbilang($x) {
  $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

  if ($x < 12)
    return " " . $angka[$x];
  elseif ($x < 20)
    return terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
  elseif ($x < 200)
    return "seratus" . terbilang($x - 100);
  elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
  elseif ($x < 2000)
    return "seribu" . terbilang($x - 1000);
  elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
  elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}