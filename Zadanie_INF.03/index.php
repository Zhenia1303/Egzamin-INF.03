<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>AutoSerwis-Panel Obslugi Zgloszen</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "warsztat");
    ?>
    <header>
        <h1>AutoSerwis-Panel Obslugi Zgloszen</h1>
    </header>
    <main>
        <section id="left">
            <h2>Nowe zgloszenie</h2>
            <form action="index.php" method="post">
                <label for="imie">imie</label>
                <input type="text" id="imie" name="imie">
                <label for="nazwisko">nazwisko</label>
                <input type="text" id="nazwisko" name="nazwisko">
                <label for="nr">Numer rejestracyjny pojazdu</label>
                <input type="text" id="nr" name="nr">
                <div id="select_con">
                    <select name="usluga">
                        <?php
                        $query = "SELECT id, nazwa, cena FROM `uslugi`";

                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id']}'>{$row['nazwa']} {$row['cena']} zł</option>";
                        }
                        ?>
                    </select>
                </div>
                <textarea name="uwagi">Uwagi i opis usterk</textarea>
                <button type="submit">Dodaj zgloszenie</button>
                <?php

                if (!empty($_POST["imie"]) && !empty($_POST["nazwisko"]) && !empty($_POST["nr"])) {
                    $imie = $_POST["imie"];
                    $nazwisko = $_POST["nazwisko"];
                    $nr_rejestr = $_POST["nr"];
                    $usluga = $_POST["usluga"];
                    $opis = $_POST["uwagi"];


                    $query = "INSERT INTO `zgloszenia`(`klient`, `nr_rejestracyjny`, `uslugi_id`, `opis`) VALUES ('{$imie}
                {$nazwisko}','{$nr_rejestr}','{$usluga}','{$opis}')";

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        echo ("Zgłoszenie zostało pomyślnie dodane");
                    }
                }
                ?>
            </form>
        </section>
        <section id="right">
            <h2>Ostatnie naprawy</h2>
            <table>
                <tr>
                    <th>Klient</th>
                    <th>Rejestracja</th>
                    <th>Usługa</th>
                    <th>Cena</th>
                    <th>Opis usterki</th>
                </tr>
                <?php

                $query = "SELECT zgloszenia.klient, zgloszenia.nr_rejestracyjny, uslugi.nazwa, uslugi.cena, zgloszenia.opis FROM zgloszenia JOIN uslugi ON zgloszenia.uslugi_id = uslugi.id ORDER BY zgloszenia.id DESC;";

                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['klient']}</td>
                        <td>{$row['nr_rejestracyjny']}</td>
                        <td>{$row['nazwa']}</td>
                        <td>{$row['cena']}</td>
                        <td>{$row['opis']}</td>
                        </tr>
                        ";
                }
                ?>
            </table>
        </section>
        <?php
        mysqli_close($conn);
        ?>
    </main>
    <footer>00000000000000000</footer>
</body>

</html>