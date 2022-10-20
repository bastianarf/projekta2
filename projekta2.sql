-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Okt 2021 pada 17.22
-- Versi server: 8.0.21
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekta2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris_barang`
--

CREATE TABLE `inventaris_barang` (
  `id` int UNSIGNED NOT NULL,
  `users_id` int UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty_barang` int UNSIGNED NOT NULL,
  `ruangan_barang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_lab`
--

CREATE TABLE `jadwal_lab` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(27, '2014_10_12_000000_create_users_table', 2),
(28, '2021_06_07_091103_create_inventaris_barang_table', 2),
(29, '2021_06_07_091121_create_peminjaman_barang_table', 2),
(30, '2021_06_07_091134_create_perbaikan_barang_table', 2),
(31, '2021_06_07_091146_create_pengajuan_barang_table', 2),
(32, '2021_06_07_091221_create_jadwal_lab_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_barang`
--

CREATE TABLE `peminjaman_barang` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_barang`
--

CREATE TABLE `pengajuan_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbaikan_barang`
--

CREATE TABLE `perbaikan_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nama_lengkap` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis_nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Kepala Laboratorium','Guru','Siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang_kalab` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mapel_guru` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cek` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `nis_nip`, `role`, `ruang_kalab`, `kelas`, `mapel_guru`, `email`, `password`, `cek`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '199012012019031002', 'Admin', NULL, NULL, NULL, 'admin@admin.com', '$2y$10$M88GJ8sW9XPlKO3FfDDbO.lBCb2ByZa65PYSZObwYVB4f/E.p8Sge', 0, NULL, NULL, '2021-06-07 03:00:56', '2021-06-07 03:00:56'),
(2, 'Kepala Laboratorium 1', '199211272016031002', 'Kepala Laboratorium', NULL, NULL, NULL, 'kalab@kalab.com', '$2y$10$7wfOyUSk90l/jen3LmgQ1u0684tgXhRpNFeftdFiM2/ONfisDzSIG', 1, NULL, NULL, '2021-06-07 03:00:57', '2021-06-07 03:00:57'),
(3, 'Guru 1', '198911212008022001', 'Guru', NULL, NULL, NULL, 'guru@guru.com', '$2y$10$pP9/yuxk9pfepr/alRQBcOr47PwiksvHMopkXs7vhl7y6ffH9BElS', 1, NULL, NULL, '2021-06-07 03:00:57', '2021-06-07 03:00:57'),
(4, 'Siswa 1', '18029122', 'Siswa', NULL, NULL, NULL, 'siswa@siswa.com', '$2y$10$Rqr/pf0UusfMmQpzxRve3evkPrVbjvKmhecdxv5PFU1U4eRyji2Xa', 1, NULL, NULL, '2021-06-07 03:00:58', '2021-06-07 03:00:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inventaris_barang`
--
ALTER TABLE `inventaris_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventaris_barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `inventaris_barang_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `jadwal_lab`
--
ALTER TABLE `jadwal_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_barang`
--
ALTER TABLE `pengajuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perbaikan_barang`
--
ALTER TABLE `perbaikan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nis_nip_unique` (`nis_nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inventaris_barang`
--
ALTER TABLE `inventaris_barang`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_lab`
--
ALTER TABLE `jadwal_lab`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_barang`
--
ALTER TABLE `pengajuan_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perbaikan_barang`
--
ALTER TABLE `perbaikan_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `inventaris_barang`
--
ALTER TABLE `inventaris_barang`
  ADD CONSTRAINT `inventaris_barang_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
