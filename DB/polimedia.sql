-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2021 pada 07.46
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polimedia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam_ruang_rapat`
--

CREATE TABLE `pinjam_ruang_rapat` (
  `id_pinjam` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `unit` varchar(35) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `file` varchar(128) NOT NULL,
  `tgl_boking` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan_rapat`
--

CREATE TABLE `ruangan_rapat` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan_rapat`
--

INSERT INTO `ruangan_rapat` (`id_ruangan`, `nama_ruangan`, `foto`) VALUES
(1, 'Ruang Rapat A.25', 'A25.jpg'),
(2, 'Ruang Rapat A.26', 'A26.jpg'),
(3, 'Aula Polimedia', 'polimedia.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Anggi Prass', 'muhammadanggi53@yahoo.com', 'DSC_00221.jpg', '$2y$10$BqduzJ034.nDWBGeUH6EHulvYAAEP/6205IAwFtmopSRb5w.rQ0jO', 1, 1, 1583166934),
(4, 'Lisa Utami', 'lisautami81@gmail.com', 'default.jpg', '$2y$10$FSBb7WagbYwAGoSim9WHUOWcZDZjXh303Mpcq5Pk/RVuLuM2/DA.O', 2, 1, 1583173664),
(9, 'muhammad anggi', 'muhammadanggi69@gmail.com', 'default.jpg', '$2y$10$jn3TyBBmkQ1/9b.PsArUbu162G2uJIXHNV3nRIJSD3pZJr6DcIfmy', 2, 1, 1583521726),
(13, 'suyatni', 'suyatniyatni117@gmail.com', 'default.jpg', '$2y$10$zi0l3Fbol0KqaDhaGK6TY.HrllcReNzcrSRnXDhm8GS3.C1Ac.j.m', 2, 1, 1602045076),
(16, 'UPT TIK', 'upttik@polimedia.ac.id', 'default.jpg', '$2y$10$KoHnZgbWk/5e1yc5frxHdOjIf22AnlIJr3KevUaolFuDcD4PsBQdq', 2, 1, 1603088725),
(17, 'Direktur', 'direktur@polimedia.ac.id', 'default.jpg', '$2y$10$Pa7Qthp.h9Shy8pxKUN0f.g2M6QMzNfWmrCdtihDFzME73zar2Ok.', 2, 1, 1603178005),
(18, 'Wadir 1', 'wadir1@polimedia.ac.id', 'default.jpg', '$2y$10$qIcIHYbf1xdh1kXgnlV/x.AhEAtAZ9TSV9qE7Xdu/OYjo33HVtCEm', 2, 1, 1603178053),
(19, 'Wadir 2', 'wadir2@polimedia.ac.id', 'default.jpg', '$2y$10$LDne8W/HFAy20dXogapH1Og92Q0dyh/oMR7HMjjTaQ7zjigxYIvI2', 2, 1, 1603178096),
(20, 'Wadir 3', 'wadir3@polimedia.ac.id', 'default.jpg', '$2y$10$8/sfQTujmGjxG8l80dRMeubvwMmdfQr/e6lxFH7f5ppfhmQ2amrQ.', 2, 1, 1603178134);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 1, 3),
(8, 2, 5),
(9, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(5, 'Ruangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Profil', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Ubah Profil', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Pengaturan Menu', 'menu', 'fas fa-bars', 1),
(5, 3, 'Pengaturan Submenu', 'menu/submenu', 'fas fa-list', 1),
(7, 1, 'Akses Pengguna', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Ubah Kata Sandi', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 5, 'Ruang Rapat', 'ruangan/rapat', 'fas fa-users', 1),
(10, 1, 'Data Pengguna', 'admin/dataUser', 'fas fa-users-cog', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pinjam_ruang_rapat`
--
ALTER TABLE `pinjam_ruang_rapat`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `ruangan_rapat`
--
ALTER TABLE `ruangan_rapat`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pinjam_ruang_rapat`
--
ALTER TABLE `pinjam_ruang_rapat`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `ruangan_rapat`
--
ALTER TABLE `ruangan_rapat`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
