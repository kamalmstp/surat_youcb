-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2021 at 09:18 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ava` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `ava`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'avatar.png', 'Mustapa Ahmad Kamal', 'mustapakamalkml@gmail.com', '$2b$10$.Al/4TXIsQYHUIxjNo2r0O.OhWEvZEd8LAbbNZuINwEF8XultZJRW', 'root', 'xHhJp8u1UdNAGDmWE5HWMbZEtdvhPy93igWQoNEWvGqjV3gL9qLHIJnCyGI1', '2021-07-25 19:49:55', '2021-07-25 19:49:56', NULL),
(6, 'avatar.png', 'Administrator', 'admin@gmail.com', '$2b$10$.Al/4TXIsQYHUIxjNo2r0O.OhWEvZEd8LAbbNZuINwEF8XultZJRW', 'admin', NULL, '2021-07-25 20:15:18', '2021-07-25 20:15:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agenda_keluars`
--

CREATE TABLE `agenda_keluars` (
  `id` int(10) UNSIGNED NOT NULL,
  `suratkeluar_id` int(10) UNSIGNED NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_masuks`
--

CREATE TABLE `agenda_masuks` (
  `id` int(10) UNSIGNED NOT NULL,
  `suratdisposisi_id` int(10) UNSIGNED NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `captions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carousels`
--

INSERT INTO `carousels` (`id`, `image`, `captions`, `created_at`, `updated_at`) VALUES
(3, 'c3.jpg', 'Ayunkan langkahmu sekarang dan wujudkanlah mimpimu.', '2021-07-25 19:49:53', '2021-07-25 19:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(5) NOT NULL,
  `kode` char(12) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `nama_pejabat` varchar(100) DEFAULT NULL,
  `nidn` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `kode`, `jabatan`, `nama_pejabat`, `nidn`) VALUES
(1, 'UCB.R', 'Rektor', 'Juhriyansyah Dalle, S.Pd., S.Si., M.Kom., Ph.D', '2005087603'),
(2, 'UCB.R.1', 'Wakil Rektor I', NULL, NULL),
(3, 'UCB.R.1.1', 'Departemen Akademik Kemahasiswaan, BSI', NULL, NULL),
(4, 'UCB.R.1.2', 'Departemen Perencanaan Kerjasama Hukum dan Internasional dan Inovasi Bisnis Inkubator, dan Karir', NULL, NULL),
(5, 'UCB.R.1.3', 'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM)', NULL, NULL),
(6, 'UCB.R.1.4', 'Lembaga Penjaminan Mutu (LPM) & Lembaga Peningkatan dan Pengembangan Pembelajaran (LP3)', NULL, NULL),
(7, 'UCB.R.2', 'Wakil Rektor II', NULL, NULL),
(8, 'UCB.R.2.1', 'Keuangan dan Aset', NULL, NULL),
(9, 'UCB.R.2.2', 'Departemen Umum, Pusat Keagamaan dan Konseling Pusat Keamanaan Kesehatan, dan Sanitasi', NULL, NULL),
(10, 'UCB.F.01.', 'Fakultas sains dan Teknologi', NULL, NULL),
(11, 'UCB.F.01.1', 'Program Studi Kesehatan Masyarakat', NULL, NULL),
(12, 'UCB.F.01.2', 'Program Studi Keperawatan dan Ners', NULL, NULL),
(13, 'UCB.F.01.3', 'Program Studi Teknologi Informasi', NULL, NULL),
(14, 'UCB.F.02', 'Fakultas Hukum dan Bisnis', NULL, NULL),
(15, 'UCB.F.02.1', 'Program Studi Ilmu Hukum', NULL, NULL),
(16, 'UCB.F.02.2', 'Program Studi Manajemen', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surats`
--

CREATE TABLE `jenis_surats` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_surats`
--

INSERT INTO `jenis_surats` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'Surat Edaran', '2021-07-25 19:49:56', '2021-07-25 19:49:56'),
(23, 'Surat Tugas', '2021-07-28 09:11:59', '2021-07-28 09:12:06'),
(24, 'Surat Perintah Plt./Plh.', '2021-07-28 09:12:12', '2021-07-28 09:12:18'),
(25, 'Surat Undangan Intern', '2021-07-28 09:12:20', '2021-07-28 09:12:22'),
(26, 'Surat Dinas', '2021-07-28 09:12:25', '2021-07-28 09:12:51'),
(27, 'Surat Undangan Ekstern', '2021-07-28 09:12:27', '2021-07-28 09:12:53'),
(28, 'Surat Kuasa', '2021-07-28 09:12:31', '2021-07-28 09:12:55'),
(29, 'Surat Pelimpahan Wewenang', '2021-07-28 09:12:33', '2021-07-28 09:12:56'),
(30, 'Berita Acara', '2021-07-28 09:12:35', '2021-07-28 09:12:58'),
(31, 'Surat Keterangan', '2021-07-28 09:12:39', '2021-07-28 09:13:00'),
(32, 'Surat Izin', '2021-07-28 09:12:41', '2021-07-28 09:13:01'),
(33, 'Surat Pernyataan', '2021-07-28 09:12:44', '2021-07-28 09:13:03'),
(34, 'Surat Pengantar', '2021-07-28 09:12:46', '2021-07-28 09:13:05'),
(35, 'Pengumuman', '2021-07-28 09:12:48', '2021-07-28 09:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_24_074908_create_admins_table', 1),
(4, '2019_01_24_103809_create_carousels_table', 1),
(5, '2019_02_01_151736_create_jenis_surats_table', 1),
(6, '2019_02_01_153818_create_surat_masuks_table', 1),
(7, '2019_02_01_154034_create_surat_disposisis_table', 1),
(8, '2019_02_01_154528_create_agenda_masuks_table', 1),
(9, '2019_02_18_103839_create_perihal_surats_table', 1),
(10, '2019_03_07_080312_create_surat_keluars_table', 1),
(11, '2019_03_07_080414_create_agenda_keluars_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('muntorodanardono@apsd.madiunkota.go.id', '$2y$10$CoA26dsH0dNYXjnS9OXtTuvY.GVlI4O4pg9Z7nmH/XN0s8doojRv6', '2021-07-25 19:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `perihal_surats`
--

CREATE TABLE `perihal_surats` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perihal_surats`
--

INSERT INTO `perihal_surats` (`id`, `kode`, `perihal`, `created_at`, `updated_at`) VALUES
(1, 'TM', 'Penerimaan Mahasiswa', '2021-07-25 19:49:57', '2021-07-25 19:49:57'),
(94, 'KR', 'Kurikulum', '2021-07-28 08:42:02', '2021-07-28 08:42:19'),
(96, 'TD', 'Tenaga Pendidik', '2021-07-28 08:43:21', '2021-07-28 08:43:21'),
(97, 'KM', 'Kemahasiswaan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(98, 'PK', 'Perkuliahan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(99, 'DI', 'Data, Informasi dan Pengembangan Akademik', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(100, 'TA', 'Penunjang Akademik', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(101, 'PT', 'Penelitian', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(102, 'PM', 'Pengabdian Kepada Masyarakat', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(103, 'PJ', 'Publikasi Jurnal/Buku', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(104, 'WA', 'Wisuda dan Alumni', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(105, 'JM', 'Penjaminan Mutu', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(106, 'TP', 'Tata Pamong', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(107, 'PR', 'Perencanaan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(108, 'HK', 'Hukum', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(109, 'OT', 'Organisasi dan Ketatalaksanaan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(110, 'KA', 'Kearsipan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(111, 'TU', 'Ketatausahaan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(112, 'RT', 'Kerumahtanggan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(113, 'PL', 'Perlengkapan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(114, 'HM', 'Hubungan Masyarakat', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(115, 'DL', 'Pendidikan dan Pelatihan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(116, 'SI', 'Teknologi Informasi dan Komunikasi', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(117, 'PA', 'Pengawasan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(118, 'KP', 'Kepegawaian', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(119, 'KU', 'Keuangan', '2021-07-28 08:46:57', '2021-07-28 08:46:57'),
(120, 'BU', 'Badan Usaha', '2021-07-28 08:46:57', '2021-07-28 08:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `surat_disposisis`
--

CREATE TABLE `surat_disposisis` (
  `id` int(10) UNSIGNED NOT NULL,
  `suratmasuk_id` int(10) UNSIGNED NOT NULL,
  `diteruskan_kepada` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harapan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_disposisis`
--

INSERT INTO `surat_disposisis` (`id`, `suratmasuk_id`, `diteruskan_kepada`, `harapan`, `catatan`, `created_at`, `updated_at`) VALUES
(27, 27, '<p>Keuangan</p>', 'Buat Surat Balasan', 'untuk kfdmkdfm', '2021-07-28 08:11:35', '2021-07-28 08:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluars`
--

CREATE TABLE `surat_keluars` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jenis_id` int(10) UNSIGNED NOT NULL,
  `suratdisposisi_id` int(10) UNSIGNED DEFAULT NULL,
  `nama_pengolah` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `no_surat_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instansi_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepada` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_penerima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_id` int(5) DEFAULT NULL,
  `perihal_id` int(5) DEFAULT NULL,
  `no_urut` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifat_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perihal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tembusan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keluars`
--

INSERT INTO `surat_keluars` (`id`, `user_id`, `jenis_id`, `suratdisposisi_id`, `nama_pengolah`, `tgl_surat`, `no_surat_penerima`, `instansi_penerima`, `kota_penerima`, `nama_penerima`, `jabatan_penerima`, `pangkat_penerima`, `kepada`, `nip_penerima`, `jabatan_id`, `perihal_id`, `no_urut`, `no_surat`, `sifat_surat`, `lampiran`, `perihal`, `isi`, `tembusan`, `status`, `catatan`, `files`, `created_at`, `updated_at`) VALUES
(35, 1, 1, 27, 'pegawai', '2021-07-28', NULL, NULL, NULL, 'Pengirim', NULL, NULL, 'Seluruh Tenaga Pendidik dan Tenaga Kependidikan Universitas Cahaya Bangsa', NULL, 1, 1, '003', 'nomor', 'penting', ' lembar', NULL, 'isi siisis', NULL, 1, NULL, NULL, '2021-07-28 08:11:35', '2021-07-28 10:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuks`
--

CREATE TABLE `surat_masuks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `jenis_id` int(10) UNSIGNED DEFAULT NULL,
  `perihal_id` int(5) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifat_surat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perihal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_instansi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_instansi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pengirim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_pengirim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat_pengirim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_pengirim` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tembusan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDisposisi` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_masuks`
--

INSERT INTO `surat_masuks` (`id`, `user_id`, `jenis_id`, `perihal_id`, `tgl_surat`, `no_surat`, `sifat_surat`, `lampiran`, `perihal`, `nama_instansi`, `asal_instansi`, `nama_pengirim`, `jabatan_pengirim`, `pangkat_pengirim`, `nip_pengirim`, `tembusan`, `files`, `isDisposisi`, `created_at`, `updated_at`) VALUES
(27, 11, 1, NULL, '2021-07-28', '8347/dfd/df34/2021', 'penting', '1 (satu) lembar', 'Testing', 'instansi', NULL, 'Pengirim', NULL, NULL, NULL, '<p>tembusan tembusan</p>', '[\"WhatsApp Image 2021-06-19 at 20.25.59.jpeg\",\"WhatsApp Image 2021-06-02 at 16.47.36.jpeg\"]', 1, '2021-07-28 07:56:13', '2021-07-28 08:11:35'),
(29, 11, 1, NULL, '2021-07-28', '8347/dfd/df34/2021', 'penting', '1 (satu) lembar', 'Testing', 'pengirim', NULL, 'dfkmkfmk', NULL, NULL, NULL, '<p>tesdfdsfdsf</p>', '[\"WhatsApp Image 2021-06-02 at 16.47.36.jpeg\"]', 0, '2021-07-29 02:25:43', '2021-07-29 02:25:43'),
(30, 11, NULL, 1, '2021-07-26', '8347/dfd/df34/2021', 'penting', NULL, 'dsflsdkfksdmfkdsf', 'dlkfsdmfkdmf', NULL, 'sdlkfnkdsmfkdmf', NULL, NULL, NULL, '<p>sdsfslkdfmsdmfksdf</p>', '[\"WhatsApp Image 2020-08-11 at 10.24.04.jpeg\",\"WhatsApp Image 2021-06-19 at 20.25.59.jpeg\",\"WhatsApp Image 2021-06-02 at 16.47.36.jpeg\"]', 0, '2021-07-29 04:40:28', '2021-07-29 04:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ava` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmr_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double(20,10) DEFAULT NULL,
  `long` double(20,10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ava`, `nip`, `name`, `email`, `password`, `role`, `remember_token`, `jabatan`, `pangkat`, `alamat`, `nmr_hp`, `jk`, `lat`, `long`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'avatar.png', '2005087603', 'Juhriyansyah Dalle, S.Pd.,S.Si, M.Kom.,Ph.D.', 'rektor@youcb.ac.id', '$2b$10$.Al/4TXIsQYHUIxjNo2r0O.OhWEvZEd8LAbbNZuINwEF8XultZJRW', 'kadin', 'ybaUYbX3HIYBLgZ0xIZYCcDX16dtF3vnGX7HUDLuLJXOk10XqLR0l5s6JGZe', 'Rektor', 'pangkat', 'alamat', '0813 1297 9899', 'pria', 42.6743812000, -83.0349578000, '2021-07-25 19:49:53', '2021-07-28 07:22:32', NULL),
(2, 'avatar.png', '3301306710055122', 'Pengolah', 'pengolah@youcb.ac.id', '$2b$10$.Al/4TXIsQYHUIxjNo2r0O.OhWEvZEd8LAbbNZuINwEF8XultZJRW', 'pengolah', 'hw6TcrZZ8qO6UINO9EIvWhtIpYFG9DY6fvwgV16wWb6ZZssNkPLazjAglSIG', 'Transformer Repairer', 'Et', 'alamat', '0339 8832 4903', 'wanita', 42.6743812000, -83.0349578000, '2021-07-25 19:49:53', '2021-07-28 07:10:55', NULL),
(5, 'avatar.png', '7315063008204838', 'TU yoUCB', 'tu@youcb.ac.id', '$2b$10$.Al/4TXIsQYHUIxjNo2r0O.OhWEvZEd8LAbbNZuINwEF8XultZJRW', 'tata_usaha', 'oURSOsZPqgiezc7vApmG52hfOe14yJfXND89lebjfhxFHt8ikcHMYnR1lC4e', 'Engineer', 'Vero', 'Kpg. Sukajadi No. 876, Tasikmalaya 99381, DKI', '(+62) 636 4558 6319', 'pria', 70.5963980000, -19.9909610000, '2021-07-25 19:49:54', '2021-07-25 19:49:55', NULL),
(11, 'avatar.png', '123123123', 'pegawai', 'pegawai@youcb.ac.id', '$2y$10$TOkvQL13glEF8Y2vf/JwWe5c2IgdDuXOn5Cnj5TPl5As63TzyCfoK', 'pengolah', NULL, 'staff', 'pangkat', 'alamat', '324242', 'pria', 42.6743812000, -83.0349578000, '2021-07-28 07:29:05', '2021-07-28 07:29:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `agenda_keluars`
--
ALTER TABLE `agenda_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_keluars_suratkeluar_id_foreign` (`suratkeluar_id`);

--
-- Indexes for table `agenda_masuks`
--
ALTER TABLE `agenda_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_masuks_suratdisposisi_id_foreign` (`suratdisposisi_id`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surats`
--
ALTER TABLE `jenis_surats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perihal_surats`
--
ALTER TABLE `perihal_surats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_disposisis`
--
ALTER TABLE `surat_disposisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_disposisis_suratmasuk_id_foreign` (`suratmasuk_id`);

--
-- Indexes for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_keluars_user_id_foreign` (`user_id`),
  ADD KEY `surat_keluars_jenis_id_foreign` (`jenis_id`),
  ADD KEY `surat_keluars_suratdisposisi_id_foreign` (`suratdisposisi_id`);

--
-- Indexes for table `surat_masuks`
--
ALTER TABLE `surat_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_masuks_user_id_foreign` (`user_id`),
  ADD KEY `surat_masuks_jenis_id_foreign` (`jenis_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `agenda_keluars`
--
ALTER TABLE `agenda_keluars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `agenda_masuks`
--
ALTER TABLE `agenda_masuks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jenis_surats`
--
ALTER TABLE `jenis_surats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perihal_surats`
--
ALTER TABLE `perihal_surats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `surat_disposisis`
--
ALTER TABLE `surat_disposisis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `surat_masuks`
--
ALTER TABLE `surat_masuks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda_keluars`
--
ALTER TABLE `agenda_keluars`
  ADD CONSTRAINT `agenda_keluars_suratkeluar_id_foreign` FOREIGN KEY (`suratkeluar_id`) REFERENCES `surat_keluars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agenda_masuks`
--
ALTER TABLE `agenda_masuks`
  ADD CONSTRAINT `agenda_masuks_suratdisposisi_id_foreign` FOREIGN KEY (`suratdisposisi_id`) REFERENCES `surat_disposisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_disposisis`
--
ALTER TABLE `surat_disposisis`
  ADD CONSTRAINT `surat_disposisis_suratmasuk_id_foreign` FOREIGN KEY (`suratmasuk_id`) REFERENCES `surat_masuks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  ADD CONSTRAINT `surat_keluars_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_surats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_keluars_suratdisposisi_id_foreign` FOREIGN KEY (`suratdisposisi_id`) REFERENCES `surat_disposisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_keluars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuks`
--
ALTER TABLE `surat_masuks`
  ADD CONSTRAINT `surat_masuks_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_surats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_masuks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
