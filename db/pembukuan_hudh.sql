-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2021 pada 12.23
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembukuan_hudh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_member` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `gender`, `phone`, `email`, `address`, `is_member`, `created_at`) VALUES
(1, 'Edi', 'Hartono', 'Laki - laki', '089664684169', 'example@example.com', 'karangsono', 1, '2021-04-04 23:32:44'),
(2, 'Heti', 'Kusrini', 'Perempuan', '08883838398', 'admin@jaknot.com', 'admin@jaknot.com', 0, '2021-04-04 23:37:55'),
(3, 'wahyu', 'hartanto', 'Laki - laki', '08883838398', 'admin@gmail.com', 'asdasdasd', 1, '2021-04-10 23:30:56'),
(4, 'TRI', 'ANTO', 'Laki - laki', '0879757855', 'tri@gmail.com', 'jalan raya', 1, '2021-08-01 20:22:13'),
(5, 'sri', 'sri', 'Perempuan', '089777777777', 'sri@gmail.com', 'jalan raya', 1, '2021-08-19 14:15:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(20) NOT NULL DEFAULT 'PCS',
  `type` varchar(100) DEFAULT '-',
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `unit`, `type`, `stock`, `price`) VALUES
(1, 'frame kaca mata', 'PCS', 'Full', 8, '100000.00'),
(2, 'frame kaca mata keren', 'PCS', 'Setengah Bingkai', 10, '300000.00'),
(3, 'frame kaca mata 3', 'PCS', 'Full', 7, '500000.00'),
(4, 'full bingkai', 'PCS', 'PCS', 9, '500000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL,
  `is_moons` int(1) NOT NULL DEFAULT 0 COMMENT '1 = lunas, 0 = cicil',
  `total_price` decimal(30,0) NOT NULL,
  `grand_total_price` decimal(30,0) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `product_id`, `installment_id`, `qty`, `is_moons`, `total_price`, `grand_total_price`, `created_at`) VALUES
(17, 2, 1, 1, 2, 1, '200000', '219000', '2021-04-11 00:18:09'),
(20, 3, 3, 0, 2, 1, '1000000', '1000000', '2021-04-11 02:47:04'),
(21, 4, 1, 2, 1, 0, '100000', '112000', '2021-08-01 20:22:58'),
(22, 5, 4, 1, 1, 1, '500000', '549000', '2021-08-19 14:17:10');

--
-- Trigger `transactions`
--
DELIMITER $$
CREATE TRIGGER `tr_stok` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
	UPDATE products SET stock = stock - new.qty WHERE id = new.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `installments` int(2) NOT NULL,
  `nominal` decimal(30,0) NOT NULL,
  `is_paid` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `installments`, `nominal`, `is_paid`, `created_at`) VALUES
(48, 17, 1, '69667', 1, '2021-04-11 00:20:52'),
(49, 17, 2, '69667', 1, '2021-04-11 00:18:31'),
(50, 17, 3, '69667', 1, '2021-04-11 00:18:33'),
(51, 18, 1, '33000', 0, NULL),
(52, 18, 2, '33000', 0, NULL),
(53, 18, 3, '33000', 0, NULL),
(54, 21, 1, '15333', 1, '2021-08-01 20:23:15'),
(55, 21, 2, '15333', 0, NULL),
(56, 21, 3, '15333', 0, NULL),
(57, 21, 4, '15333', 0, NULL),
(58, 21, 5, '15333', 0, NULL),
(59, 21, 6, '15333', 0, NULL),
(60, 22, 1, '179667', 1, '2021-08-19 14:17:31'),
(61, 22, 2, '179667', 1, '2021-08-19 14:17:43'),
(62, 22, 3, '179667', 1, '2021-08-19 14:17:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_of_installments`
--

CREATE TABLE `type_of_installments` (
  `id` int(11) NOT NULL,
  `max_moon` int(4) NOT NULL,
  `dp` decimal(30,0) NOT NULL,
  `persen` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `type_of_installments`
--

INSERT INTO `type_of_installments` (`id`, `max_moon`, `dp`, `persen`) VALUES
(1, 3, '10000', 10),
(2, 6, '20000', 15),
(3, 9, '35000', 25),
(4, 12, '50000', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'wahyu', '123', 'Wahyu Hartanto'),
(2, 'hudh', '123', 'Nurul Huda');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `type_of_installments`
--
ALTER TABLE `type_of_installments`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `type_of_installments`
--
ALTER TABLE `type_of_installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
