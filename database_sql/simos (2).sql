-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 15 Des 2024 pada 15.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nra` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `pengalaman` text NOT NULL,
  `jenis_anggota` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nra`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `telepon`, `pengalaman`, `jenis_anggota`, `foto`, `users_id`, `created_at`, `updated_at`) VALUES
(2, 'STC 5782 RW', 'Jakarta', '2024-06-30', 'Jakarta', '089522853137', '<ul><li>Akun Testing</li><li>Akun Development</li></ul>', '1', '1723275915.jpg', 3, '2024-06-30 11:18:57', '2024-09-01 11:10:07'),
(3, 'STC 4236 TF', 'Tangerang', '2024-07-13', 'Tangerang', '089522853137', '<ul><li>Ketua Umum</li></ul>', '2', '1720867867.jpg', 4, '2024-07-13 10:51:07', '2024-12-11 13:00:28'),
(12, 'STC 0000', 'Tangerang', '2024-09-23', 'Jakarta', '081213671213', '<p>#</p>', '1', '1731143570.jpg', 14, '2024-09-30 15:12:55', '2024-11-09 11:06:50'),
(13, 'Sekretaris', 'Jakarta', '2024-10-21', 'Jakarta', '012345', '<p>Sekretaris</p>', '1', '1729517049.jpg', 15, '2024-10-21 13:24:09', '2024-10-21 13:24:09'),
(14, 'Bendahara', 'Jakarta', '2024-10-21', 'Jakarta', '012345', '<p>Bendahara</p>', '4', '1729517195.jpg', 16, '2024-10-21 13:26:35', '2024-10-21 13:26:35'),
(15, 'Logistik', 'Jakarta', '2024-10-21', 'Jakarta', '012345', '<p>Logistik</p>', '4', '1729517740.jpg', 17, '2024-10-21 13:35:40', '2024-10-21 13:39:33'),
(16, 'Kepala Bidang', 'Jakarta', '2024-10-21', 'Jakarta', '012345', '<p>Kepala Bidang</p>', '1', '1729517872.jpg', 18, '2024-10-21 13:37:52', '2024-10-22 14:07:10'),
(17, 'User', 'Jakarta', '2024-11-09', 'Jakarta', '012345', '<p>User</p>', '1', '1731143696.jpg', 19, '2024-11-09 09:14:56', '2024-11-09 09:14:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `tugas_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `deskripsi`, `status`, `tgl_mulai`, `tgl_selesai`, `file`, `program_id`, `tugas_id`, `users_id`, `created_at`, `updated_at`) VALUES
(56, 'Dokumen Musyawarah Belum Selesai', 'Perbaikan', '2024-09-15', '2024-09-15', '', 12, 76, 3, '2024-09-15 02:26:04', '2024-12-12 17:08:02'),
(57, 'Persiapan Tempat & Peralatan Telah Di Selesaikan', 'Tunggu', '2024-09-15', '2024-09-15', '', 12, 77, 3, '2024-09-15 02:28:53', '2024-12-12 17:06:29'),
(61, '<p>Pembuatan Undangan Kegiatan Telah Di Selesaikan</p>', 'Tunggu', '2024-11-09', '2024-11-09', '1731147911.jpg', 12, 75, 3, '2024-11-09 10:25:11', '2024-12-12 17:05:57'),
(65, '<p>Selesai</p>', 'Tunggu', '2024-12-13', '2024-12-31', '1734150329.png', 12, 88, 3, '2024-12-14 04:25:29', '2024-12-14 04:25:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logistik`
--

CREATE TABLE `logistik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `tahun_pembelian` year(4) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `pemakaian` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `logistik`
--

INSERT INTO `logistik` (`id`, `nama`, `nomor`, `merek`, `tahun_pembelian`, `keterangan`, `status`, `pemakaian`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'a', '1', 'a', '2019', '<p>a</p>', '1', '1', '1721311860.jpg', '2024-07-18 14:11:00', '2024-07-18 14:11:00'),
(8, 'Komputer', 'STC 001', 'LG', '2019', '<ul><li>CPU</li><li>Monitor</li><li>Keyboard</li><li>Mouse</li><li>Speaker</li></ul>', '1', '1', '1727191495.jpg', '2024-09-24 15:24:55', '2024-09-24 15:24:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2024_05_18_101534_add_users_id_to_anggota_table', 1),
(11, '2024_05_18_102531_add_username_to_users_table', 1),
(12, '2024_05_18_191603_add_status_to_users_table', 1),
(30, '2014_10_12_000000_create_users_table', 2),
(31, '2014_10_12_100000_create_password_resets_table', 2),
(32, '2019_08_19_000000_create_failed_jobs_table', 2),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(34, '2024_02_09_090213_create_anggota_table', 2),
(35, '2024_02_09_091206_create_pengumuman_table', 2),
(36, '2024_02_09_092056_create_logistik_table', 2),
(37, '2024_02_09_092557_create_surat_masuk_table', 2),
(38, '2024_02_09_092844_create_surat_keluar_table', 2),
(39, '2024_05_27_193203_create_surat_keterangan_table', 2),
(40, '2024_06_17_084511_create_pengurus_table', 2),
(41, '2024_06_17_122321_create_program_table', 2),
(42, '2024_06_28_190229_create_panitia_table', 2),
(43, '2024_07_02_200206_create_tugas_table', 3),
(44, '2024_07_09_193502_create_laporan_table', 4),
(45, '2024_09_15_093659_create_pemasukan_table', 5),
(46, '2024_09_28_214123_create_pengeluaran__table', 6),
(47, '2024_12_07_182311_add_users_id_to_tugas_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `panitia`
--

CREATE TABLE `panitia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'panitia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `panitia`
--

INSERT INTO `panitia` (`id`, `users_id`, `program_id`, `role`, `created_at`, `updated_at`) VALUES
(29, 3, 12, 'panitia', NULL, NULL),
(46, 15, 25, 'panitia', NULL, NULL),
(47, 16, 25, 'panitia', NULL, NULL),
(48, 17, 25, 'panitia', NULL, NULL),
(49, 18, 25, 'panitia', NULL, NULL),
(51, 4, 12, 'panitia', NULL, NULL),
(52, 14, 12, 'panitia', NULL, NULL),
(56, 19, 25, 'panitia', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(10,0) NOT NULL,
  `file` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `nama`, `tanggal`, `jumlah`, `file`, `program_id`, `users_id`, `created_at`, `updated_at`) VALUES
(44, 'DKM', '2024-12-09', 10000000, '1734175422.png', 12, 3, '2024-12-14 11:23:42', '2024-12-14 11:23:42'),
(45, 'DKM', '2024-12-21', 10000000, '1734185440.png', 25, 3, '2024-12-14 14:10:40', '2024-12-14 14:10:40'),
(46, 'Iuran Sukarela', '2024-12-15', 2000000, '1734185680.png', 12, 3, '2024-12-14 14:14:40', '2024-12-14 14:14:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(10,0) NOT NULL,
  `file` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `nama`, `tanggal`, `jumlah`, `file`, `program_id`, `users_id`, `created_at`, `updated_at`) VALUES
(15, 'Cetak Undangan Proposal', '2024-12-25', 750000, '1734175455.jpg', 12, 3, '2024-12-14 11:24:15', '2024-12-14 11:24:15'),
(16, 'Konsumsi Kegiatan', '2024-12-30', 3750000, '1734175490.jpg', 12, 3, '2024-12-14 11:24:50', '2024-12-14 11:24:50'),
(17, 'Mabs', '2024-12-28', 3000000, '1734185628.jpg', 25, 3, '2024-12-14 14:13:48', '2024-12-14 14:13:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'Under Maintenance', '<p>Aplikasi Dalam Tahap Pengembangan</p>', '2024-06-30 11:39:32', '2024-06-30 11:39:32'),
(2, 'SIMOS Go Live !!!', '<p>UAT</p>', '2024-09-01 10:57:06', '2024-09-01 10:57:06'),
(3, 'SIMOS Under Development', '<p>Development System</p>', '2024-09-14 11:23:28', '2024-09-14 16:36:11'),
(4, 'SIMOS Testing', '<p>Testing</p>', '2024-12-09 12:52:32', '2024-12-09 12:52:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_periode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`id`, `tahun_periode`, `created_at`, `updated_at`) VALUES
(1, '2024 - 2025', '2024-06-30 11:15:40', '2024-06-30 11:15:40'),
(3, '2025 - 2026', '2024-08-11 08:35:52', '2024-08-11 08:35:52'),
(4, '2026 - 2027', '2024-09-14 17:07:24', '2024-09-14 17:07:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `proposal` varchar(255) NOT NULL,
  `lpj` varchar(255) NOT NULL,
  `pengurus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program`
--

INSERT INTO `program` (`id`, `nama`, `deskripsi`, `jenis`, `status`, `tgl_mulai`, `tgl_selesai`, `proposal`, `lpj`, `pengurus_id`, `created_at`, `updated_at`) VALUES
(12, 'Musyawarah Besar', '<p>Musyawarah Besar</p>', '1', 'Sukses', '2024-09-14', '2024-09-14', '', '', 3, '2024-09-14 16:58:27', '2024-12-14 04:24:35'),
(25, 'Basic Training Stacia', '<p>BATAS</p>', '1', 'Batal', '2024-12-15', '2024-12-28', '', '', 1, '2024-11-09 07:53:37', '2024-12-14 04:24:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor`, `tanggal`, `perihal`, `tujuan`, `isi`, `file`, `created_at`, `updated_at`) VALUES
(1, '2', '2024-07-18', '2', '2', '<p>2</p>', '1721311810.pdf', '2024-07-18 14:10:10', '2024-07-18 14:10:10'),
(2, 'as', '2024-08-10', 'as', 'as', '<p>as</p>', '1723278551.pdf', '2024-08-10 08:29:11', '2024-08-10 08:29:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keterangan`
--

CREATE TABLE `surat_keterangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_keterangan`
--

INSERT INTO `surat_keterangan` (`id`, `nomor`, `tanggal`, `perihal`, `isi`, `file`, `created_at`, `updated_at`) VALUES
(1, '3', '2024-07-18', '3', '<p>3</p>', '1721311826.pdf', '2024-07-18 14:10:26', '2024-07-18 14:10:26'),
(2, '981237', '2024-09-30', '2eds', '<p>wdd</p>', '1727697181.pdf', '2024-09-30 11:53:01', '2024-09-30 11:53:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor`, `tanggal`, `perihal`, `asal`, `isi`, `file`, `created_at`, `updated_at`) VALUES
(1, '1', '2024-07-18', '1', '1', '<p>1</p>', '1721311792.pdf', '2024-07-18 14:09:52', '2024-07-18 14:09:52'),
(2, '12345r', '2024-09-30', 'sadfcvasdf', 'sdfcv', '<p>asdfasdc</p>', '1727697233.pdf', '2024-09-30 11:53:53', '2024-09-30 11:53:53'),
(3, '567', '2024-09-30', 'fgh', 'dfgb', '<p>dfghx</p>', '1727697739.pdf', '2024-09-30 12:02:19', '2024-09-30 12:02:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id`, `nama`, `deskripsi`, `status`, `users_id`, `program_id`, `created_at`, `updated_at`) VALUES
(75, 'Pembuatan Undangan', 'Pembuatan Undangan', 'Tunggu', 3, 12, '2024-09-15 02:20:20', '2024-12-12 17:07:28'),
(76, 'Penyusunan Dokumen', '<p>Penyusunan Dokumen<br></p>', 'Perbaikan', 3, 12, '2024-09-15 02:25:45', '2024-12-12 17:06:46'),
(77, 'Persiapan Tempat & Peralatan', '<p>Persiapan Tempat &amp; Peralatan Kegiatan<br></p>', 'Selesai', 3, 12, '2024-09-15 02:28:33', '2024-12-12 17:08:10'),
(85, 'Survei Lokasi', '<p>Lokasi Kegiatan Berada di Jakarta</p>', 'Tunggu', 14, 12, '2024-12-12 17:10:10', '2024-12-12 17:10:10'),
(86, 'Open Sponsorhip', '<p>Pencarian Sponsor Kegiatan</p>', 'Tunggu', 4, 12, '2024-12-14 04:18:46', '2024-12-14 04:18:46'),
(87, 'Undangan Narasumber', '<p>Undangan Narasumber Berikut Dengan Surat Undangan</p>', 'Tunggu', 4, 12, '2024-12-14 04:19:22', '2024-12-14 04:19:22'),
(88, 'Pembuatan Dokumen', '<p>Pembuatan Dokumen Penunjang</p>', 'Tunggu', 14, 12, '2024-12-14 04:20:47', '2024-12-14 04:20:47'),
(89, 'Pembentukan Struktur Panitia', '<p>Struktur Panitia</p>', 'Tunggu', 3, 12, '2024-12-14 04:21:11', '2024-12-14 04:21:11'),
(90, 'Belanja Konsumsi', '<p>Belanja Konsumsi Kegiatan</p>', 'Tunggu', 4, 12, '2024-12-14 04:22:45', '2024-12-14 04:22:45'),
(91, 'Rapat Pembentukan Tim', '<p>Pengurus Kegiatan</p>', 'Tunggu', 19, 25, '2024-12-14 14:29:57', '2024-12-14 14:29:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Administrator', 'admin', 'admin@stacia.org', NULL, '$2y$10$9UXSkDYoBxFqgUSVf1L.5eF6g47LCdYWyCzVn8m35j3j.S9yTXfJW', '1', '1', NULL, '2024-06-30 11:18:57', '2024-06-30 11:18:57'),
(4, 'Ahmad Athoriq', 'ahmad.athoriq', 'ahmad.athoriq@stacia.org', NULL, '$2y$10$AUnhQYlQoLQ6/V8MN/wJhu1gx2And.RLP7lC2oITLGmRYNCZr5R8a', '1', '1', NULL, '2024-07-13 10:51:07', '2024-12-11 13:00:28'),
(14, 'Aditya Pratama Febriono', 'aditya.febriono', 'aditya.febriono@stacia.org', NULL, '$2y$10$JAmxZ8.FmUP6P76Sp/BJBOIaDSWCYcR3rHAzyRtmeAaVyxd/qfeBq', '1', '0', NULL, '2024-09-30 15:12:55', '2024-12-12 14:04:18'),
(15, 'Tes Sekretaris', 'sekretaris', 'sekretaris@stacia.org', NULL, '$2y$10$ncoaMvCtTsFukbZnZebn0.WI6WCfYXSQ4.IXrJ7TQL9sLcV8NbmWy', '2', '1', NULL, '2024-10-21 13:24:09', '2024-10-21 13:24:09'),
(16, 'Tes Bendahara', 'bendahara', 'bendahara@stacia.org', NULL, '$2y$10$76r2pImg3YYtP393QB6MD.TVODdsk9Iv6AVXAWZU.3bdikOhbJ6RK', '3', '1', NULL, '2024-10-21 13:26:35', '2024-10-21 13:26:35'),
(17, 'Tes Logistik', 'logistik', 'logistik@stacia.org', NULL, '$2y$10$xR0jB./9PW9YPz8JACoIhOMwAxFKRUE5s6NzaErNZ.QS0yn7mEDJm', '4', '1', NULL, '2024-10-21 13:35:40', '2024-10-21 13:35:40'),
(18, 'Tes Kepala Bidang', 'kepala.bidang', 'kepala.bidang@stacia.org', NULL, '$2y$10$te6DFkQzg.06bHTojZv2hOSvDJcutx3l2/k9g50sOT8ypLiwtY2lC', '5', '1', NULL, '2024-10-21 13:37:52', '2024-10-21 13:37:52'),
(19, 'Tes User', 'user', 'user@stacia.org', NULL, '$2y$10$dHHq2VmUiR0puftf5M4z.erhzYOxayjJunePZmm1K7QLW.gwoGfK.', '6', '1', NULL, '2024-11-09 09:14:56', '2024-11-09 09:14:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_program_id_foreign` (`program_id`),
  ADD KEY `laporan_tugas_id_foreign` (`tugas_id`),
  ADD KEY `laporan_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `logistik`
--
ALTER TABLE `logistik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panitia_users_id_foreign` (`users_id`),
  ADD KEY `panitia_program_id_foreign` (`program_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemasukan_program_id_foreign` (`program_id`),
  ADD KEY `pemasukan_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengeluaran__program_id_foreign` (`program_id`),
  ADD KEY `pengeluaran__users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_pengurus_id_foreign` (`pengurus_id`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_program_id_foreign` (`program_id`),
  ADD KEY `tugas_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `panitia`
--
ALTER TABLE `panitia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `surat_keterangan`
--
ALTER TABLE `surat_keterangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `panitia`
--
ALTER TABLE `panitia`
  ADD CONSTRAINT `panitia_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  ADD CONSTRAINT `panitia_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemasukan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran__program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengeluaran__users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`id`);

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tugas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
