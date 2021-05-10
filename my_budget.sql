-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Maj 2021, 07:32
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `my budget`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expense_category_asigned_to_user_id` int(11) DEFAULT NULL,
  `payment_methods_asigned_to_user_id` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `date_of_expense` date DEFAULT NULL,
  `expense_comment` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `expense_category_asigned_to_user_id`, `payment_methods_asigned_to_user_id`, `amount`, `date_of_expense`, `expense_comment`) VALUES
(11, 10, 80, 70, '345.55', '2021-05-16', 'BOOKS GOTOWKA'),
(12, 10, 84, 70, '1234.00', '2021-05-06', 'HEALTH GOTOWKA'),
(13, 9, 98, 73, '4890.00', '2021-05-27', 'koljena kwota'),
(14, 9, 105, 73, '765.00', '2021-05-15', 'TRIP GOTOWKA'),
(15, 9, 101, 73, '789.00', '2021-05-20', 'CLOTHES GOTÓWKA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses_category_asigned_to_users`
--

CREATE TABLE `expenses_category_asigned_to_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses_category_asigned_to_users`
--

INSERT INTO `expenses_category_asigned_to_users` (`id`, `user_id`, `name`) VALUES
(79, 10, 'Transport'),
(80, 10, 'Books'),
(81, 10, 'Food'),
(82, 10, 'Apartments'),
(83, 10, 'Telecommunication'),
(84, 10, 'Health'),
(85, 10, 'Clothes'),
(86, 10, 'Hygiene'),
(87, 10, 'Kids'),
(88, 10, 'Recreation'),
(89, 10, 'Trip'),
(90, 10, 'Savings'),
(91, 10, 'For Retirement'),
(92, 10, 'Debt Repayment'),
(93, 10, 'Gift'),
(94, 10, 'Another'),
(95, 9, 'Transport'),
(96, 9, 'Books'),
(97, 9, 'Food'),
(98, 9, 'Apartments'),
(99, 9, 'Telecommunication'),
(100, 9, 'Health'),
(101, 9, 'Clothes'),
(102, 9, 'Hygiene'),
(103, 9, 'Kids'),
(104, 9, 'Recreation'),
(105, 9, 'Trip'),
(106, 9, 'Savings'),
(107, 9, 'For Retirement'),
(108, 9, 'Debt Repayment'),
(109, 9, 'Gift'),
(110, 9, 'Another');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses_category_default`
--

CREATE TABLE `expenses_category_default` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `expenses_category_default`
--

INSERT INTO `expenses_category_default` (`id`, `name`) VALUES
(1, 'Transport'),
(2, 'Books'),
(3, 'Food'),
(4, 'Apartments'),
(5, 'Telecommunication'),
(6, 'Health'),
(7, 'Clothes'),
(8, 'Hygiene'),
(9, 'Kids'),
(10, 'Recreation'),
(11, 'Trip'),
(12, 'Savings'),
(13, 'For Retirement'),
(14, 'Debt Repayment'),
(15, 'Gift'),
(16, 'Another');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `income_category_asigned_to_user_id` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `date_of_income` date DEFAULT NULL,
  `income_comment` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes`
--

INSERT INTO `incomes` (`id`, `user_id`, `income_category_asigned_to_user_id`, `amount`, `date_of_income`, `income_comment`) VALUES
(32, 10, 25, '123.00', '2021-05-09', 'nowa katego'),
(33, 10, 26, '999.00', '0000-00-00', 'taki jest'),
(34, 9, 27, '342.00', '2021-05-04', 'nowa'),
(35, 9, 28, '5678.67', '2021-05-19', 'nowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes_category_asigned_to_user`
--

CREATE TABLE `incomes_category_asigned_to_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes_category_asigned_to_user`
--

INSERT INTO `incomes_category_asigned_to_user` (`id`, `user_id`, `name`) VALUES
(25, 10, 'SALARY'),
(26, 10, 'CIOCIA'),
(27, 9, 'SALARY'),
(28, 9, 'ZUPELNIE NOWA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `incomes_category_default`
--

CREATE TABLE `incomes_category_default` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `incomes_category_default`
--

INSERT INTO `incomes_category_default` (`id`, `name`) VALUES
(1, 'Salary'),
(2, 'Interest'),
(3, 'Allegro'),
(4, 'Another');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_asigned_to_users`
--

CREATE TABLE `payment_methods_asigned_to_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_methods_asigned_to_users`
--

INSERT INTO `payment_methods_asigned_to_users` (`id`, `user_id`, `name`) VALUES
(70, 10, 'GOTÓWKA'),
(71, 10, 'KARTA KREDYTOWA'),
(72, 10, 'KARTA DEBETOWA'),
(73, 9, 'GOTÓWKA'),
(74, 9, 'KARTA KREDYTOWA'),
(75, 9, 'KARTA DEBETOWA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods_default`
--

CREATE TABLE `payment_methods_default` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `payment_methods_default`
--

INSERT INTO `payment_methods_default` (`id`, `name`) VALUES
(1, 'GOTÓWKA'),
(2, 'KARTA KREDYTOWA'),
(3, 'KARTA DEBETOWA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(9, 'bnares', '$2y$10$Ef7gqfuZFxNBWmYKoO1uBuAzoKTNpNGMKSrmkAJuVOA8nrbVMQQEu', 'polo-1989@o2.pl'),
(10, 'piotr', '$2y$10$gKyVVpg3RRsX91/yf.yadOEsgYLJ8b6aiR3rrEICYKWIeu0wxlvEq', 'piotr@gmail.com'),
(11, 'wojtek', '$2y$10$UGCwHwxi/vdSvQui8szkFOf2PXcJKXx5CXKky4DM9biib.G6yyXIK', 'wojtek@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nowe` (`payment_methods_asigned_to_user_id`),
  ADD KEY `expense_category_asigned_to_user_id` (`expense_category_asigned_to_user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `expenses_category_asigned_to_users`
--
ALTER TABLE `expenses_category_asigned_to_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id_fk` (`user_id`);

--
-- Indeksy dla tabeli `expenses_category_default`
--
ALTER TABLE `expenses_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_fk` (`user_id`),
  ADD KEY `income_category_asigned_to_user_id` (`income_category_asigned_to_user_id`);

--
-- Indeksy dla tabeli `incomes_category_asigned_to_user`
--
ALTER TABLE `incomes_category_asigned_to_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_category_fk` (`user_id`);

--
-- Indeksy dla tabeli `incomes_category_default`
--
ALTER TABLE `incomes_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment_methods_asigned_to_users`
--
ALTER TABLE `payment_methods_asigned_to_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_aisgned_id_fk` (`user_id`);

--
-- Indeksy dla tabeli `payment_methods_default`
--
ALTER TABLE `payment_methods_default`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `expenses_category_asigned_to_users`
--
ALTER TABLE `expenses_category_asigned_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT dla tabeli `expenses_category_default`
--
ALTER TABLE `expenses_category_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `incomes_category_asigned_to_user`
--
ALTER TABLE `incomes_category_asigned_to_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT dla tabeli `incomes_category_default`
--
ALTER TABLE `incomes_category_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `payment_methods_asigned_to_users`
--
ALTER TABLE `payment_methods_asigned_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT dla tabeli `payment_methods_default`
--
ALTER TABLE `payment_methods_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`expense_category_asigned_to_user_id`) REFERENCES `expenses_category_asigned_to_users` (`id`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nowe` FOREIGN KEY (`payment_methods_asigned_to_user_id`) REFERENCES `payment_methods_asigned_to_users` (`id`);

--
-- Ograniczenia dla tabeli `expenses_category_asigned_to_users`
--
ALTER TABLE `expenses_category_asigned_to_users`
  ADD CONSTRAINT `users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `incomes_ibfk_1` FOREIGN KEY (`income_category_asigned_to_user_id`) REFERENCES `incomes_category_asigned_to_user` (`id`);

--
-- Ograniczenia dla tabeli `incomes_category_asigned_to_user`
--
ALTER TABLE `incomes_category_asigned_to_user`
  ADD CONSTRAINT `incomes_category_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `payment_methods_asigned_to_users`
--
ALTER TABLE `payment_methods_asigned_to_users`
  ADD CONSTRAINT `payment_methods_aisgned_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
