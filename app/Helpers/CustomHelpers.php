<?php

function getAcademicYear($date)
{
    // Ubah tanggal ke dalam format tahunan
    $year = date('Y', strtotime($date));

    // Jika tanggal berada di rentang waktu 1 Juli sampai 30 Juni
    if (date('n', strtotime($date)) >= 7) {
        // Tahun ajaran dimulai pada Juli tahun sekarang hingga Juni tahun depan
        $startYear = $year;
        $endYear = $year + 1;
    } else {
        // Tahun ajaran dimulai pada Juli tahun sebelumnya hingga Juni tahun sekarang
        $startYear = $year - 1;
        $endYear = $year;
    }

    // Formatkan tahun ajaran dalam output yang diinginkan
    return $startYear . '/' . $endYear;
}
