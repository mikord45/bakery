-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Sty 2021, 18:46
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `piekarnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_wypiekow`
--

CREATE TABLE `kategorie_wypiekow` (
  `id` int(11) NOT NULL,
  `nazwa_kategorii` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategorie_wypiekow`
--

INSERT INTO `kategorie_wypiekow` (`id`, `nazwa_kategorii`) VALUES
(1, 'chleby'),
(2, 'bułki'),
(3, 'wyroby drożdżowe'),
(4, 'ciasta'),
(5, 'ciastka'),
(6, 'torty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `login`, `haslo`) VALUES
(1, 'Jan', 'Kowalski', 'u1', '$2y$10$Lpr5jxlhUWcLXDgmWwQGaugk4YuOzjjlO/L0knFbqL05IL5DLvlm2'),
(2, 'Patrycja', 'Jeż', 'u2', '$2y$10$Lpr5jxlhUWcLXDgmWwQGaugk4YuOzjjlO/L0knFbqL05IL5DLvlm2'),
(3, 'Filip', 'Stolarz', 'u3', '$2y$10$Lpr5jxlhUWcLXDgmWwQGaugk4YuOzjjlO/L0knFbqL05IL5DLvlm2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypieki`
--

CREATE TABLE `wypieki` (
  `id` int(11) NOT NULL,
  `nazwa_wypieku` varchar(255) NOT NULL,
  `kategoria` int(11) NOT NULL,
  `cena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wypieki`
--

INSERT INTO `wypieki` (`id`, `nazwa_wypieku`, `kategoria`, `cena`) VALUES
(1, 'Chleb szefa mieszany', 1, 4.2),
(2, 'Chleb włoski (oliwkowy) pszenny', 1, 4.8),
(3, 'Chleb dobczycki mieszany', 1, 5.1),
(4, 'Bułka kaszubska', 2, 0.39),
(5, 'Bułka kebab', 2, 1.25),
(6, 'Bułka hamburger', 2, 0.49),
(7, 'Chałka zwykła pszenna', 3, 4.5),
(8, 'Drożdżówka z budyniem\r\n', 3, 1.8),
(9, 'Drożdżówka z serem', 3, 1.7),
(10, 'Ambasador', 4, 29.9),
(11, 'Ptasie mleczko owocowe', 4, 20.9),
(12, 'Sernik', 4, 21.9),
(13, 'Ptyś', 5, 2),
(14, 'Napoleon', 5, 5),
(15, 'Ekler', 5, 2.69),
(16, 'Tort urodzinowy ', 6, 210),
(17, 'Tort weselny (100 osób)', 6, 1000),
(18, 'Tort weselny (150 osób)', 6, 2000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `klient` int(11) NOT NULL,
  `produkt_1` int(11) NOT NULL,
  `ilosc_produkt_1` int(11) NOT NULL,
  `produkt_2` int(11) NOT NULL,
  `ilosc_produkt_2` int(11) NOT NULL,
  `produkt_3` int(11) NOT NULL,
  `ilosc_produkt_3` int(11) NOT NULL,
  `szczegoly_zamowienia` text NOT NULL,
  `cena_calkowita` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `klient`, `produkt_1`, `ilosc_produkt_1`, `produkt_2`, `ilosc_produkt_2`, `produkt_3`, `ilosc_produkt_3`, `szczegoly_zamowienia`, `cena_calkowita`) VALUES
(3, 1, 3, 3, 3, 5, 3, 1, '', 45.9),
(4, 1, 4, 9, 18, 1, 17, 9, '', 11003.5),
(5, 2, 4, 1, 10, 2, 8, 10, '', 78.19),
(6, 1, 5, 1, 2, 1, 5, 1, '', 7.3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie_wypiekow`
--
ALTER TABLE `kategorie_wypiekow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wypieki`
--
ALTER TABLE `wypieki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria` (`kategoria`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klient` (`klient`),
  ADD KEY `produkt_1` (`produkt_1`),
  ADD KEY `produkt_2` (`produkt_2`),
  ADD KEY `produkt_3` (`produkt_3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kategorie_wypiekow`
--
ALTER TABLE `kategorie_wypiekow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `wypieki`
--
ALTER TABLE `wypieki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wypieki`
--
ALTER TABLE `wypieki`
  ADD CONSTRAINT `wypieki_ibfk_1` FOREIGN KEY (`kategoria`) REFERENCES `kategorie_wypiekow` (`id`);

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`klient`) REFERENCES `klienci` (`id`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`produkt_1`) REFERENCES `wypieki` (`id`),
  ADD CONSTRAINT `zamowienia_ibfk_3` FOREIGN KEY (`produkt_2`) REFERENCES `wypieki` (`id`),
  ADD CONSTRAINT `zamowienia_ibfk_4` FOREIGN KEY (`produkt_3`) REFERENCES `wypieki` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
