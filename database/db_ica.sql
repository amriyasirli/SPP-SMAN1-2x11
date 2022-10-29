-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2022 pada 14.40
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ica`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_auth`
--

CREATE TABLE `tbl_auth` (
  `id_auth` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `data_created` date NOT NULL DEFAULT current_timestamp(),
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_auth`
--

INSERT INTO `tbl_auth` (`id_auth`, `nama`, `username`, `password`, `foto`, `data_created`, `role`) VALUES
(1, 'Administrator', 'admin', '$2y$10$sUGqAVtxSmNFpRC08xJ9neWMiFXfpQGkU9zYqmzofY9MZLb73OZr.', '46e359820bfb36d33674b51f0c864e4c.jpg', '2022-08-16', 1),
(2, 'Guru ', 'guru', '$2y$10$sUGqAVtxSmNFpRC08xJ9neWMiFXfpQGkU9zYqmzofY9MZLb73OZr.', '46e359820bfb36d33674b51f0c864e4c.jpg', '2022-09-01', 2),
(3, 'Amr Media', 'amr', '$2y$10$hfJWSy1ENSnEpCSRFyEpeOCLZNwshEsAZdXnPVLJBhulFw8LTvDsa', 'a58e10b76da311e672bdb64e25105a13.png', '2022-09-05', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `hp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'X IPA 1'),
(5, 'XI IPA 1'),
(6, 'X IPS 1'),
(7, 'XI IPS 1'),
(8, 'XII IPA 1'),
(9, 'XII IPS 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `tanggal_pembayaran` date NOT NULL DEFAULT current_timestamp(),
  `bulan` varchar(50) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_periode`
--

INSERT INTO `tbl_periode` (`id_periode`, `semester`, `tahun_ajaran`) VALUES
(1, 'I (satu)', '2022/2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `nama_siswa`, `id_kelas`, `jenis_kelamin`, `tanggal_lahir`, `foto`) VALUES
(200597, 'hardi', 1, 'Laki-laki', '2022-10-27', '231ef82076bccc8eb3c9f7560568aa33.png'),
(200598, 'Ica Maika', 1, 'Perempuan', '1999-05-20', 'f17a4ced235db5b9a7d4e8c69359b76f.jpg'),
(200599, 'Park Ji MIn', 6, 'Laki-laki', '1999-05-19', 'c31df3054ec734bc0f729472cdf7cb3c.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_auth`
--
ALTER TABLE `tbl_auth`
  ADD PRIMARY KEY (`id_auth`);

--
-- Indeks untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_auth`
--
ALTER TABLE `tbl_auth`
  MODIFY `id_auth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2517057;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
