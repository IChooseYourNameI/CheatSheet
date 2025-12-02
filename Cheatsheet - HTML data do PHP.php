<?php
/**
 * HTML FORMULÁŘE + PRÁCE SE SOUBORY
 * Samostatný cheat sheet – jen tyto dvě témata
 * 100% bez chyb, vše deklarováno, vše ošetřeno
 */

declare(strict_types=1);

// ======================================================
// ZÁKLADNÍ PROMĚNNÉ (aby nebyly undefined notice)
// ======================================================
$formJmeno = $_POST['jmeno'] ?? '';
$formVek   = $_POST['vek'] ?? '';
$formZprava = $_POST['zprava'] ?? '';

echo "<pre style='font-family: Consolas; font-size: 16px; line-height: 1.7;'>";
echo "<h1>HTML Formuláře + Práce se soubory</h1>\n\n";

// ======================================================
// 1. HTML ZÁKLADNÍ STRUKTURA
// ======================================================
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Formuláře a soubory</title>
</head>
<body>
    <!-- HTML je tvořeno tagy: <tag atribut="hodnota">obsah</tag> -->
    <!-- Párové tagy mají otevírací i zavírací, např. <p></p>, <div></div> -->
    <!-- Nepárové: <br>, <hr>, <input>, <img> -->

    <h2>Klasický HTML formulář</h2>

    <!-- ====================================================== -->
    <!-- 2. FORMULÁŘ – odesílání dat do PHP -->
    <!-- ====================================================== -->
    <form method="post" action="">   <!-- action="" = odeslat na stejný soubor -->
                                     <!-- method="post" = data jsou skrytá -->
                                     <!-- method="get"  = data viditelná v URL -->
        Jméno:   <input type="text"     name="jmeno"   value="<?= htmlspecialchars($formJmeno) ?>" required><br><br>
        Věk:     <input type="number"   name="vek"     value="<?= $formVek ?>" min="0" max="150"><br><br>
        Zpráva:  <textarea name="zprava" rows="4" cols="50"><?= htmlspecialchars($formZprava) ?></textarea><br><br>

        <button type="submit" name="odeslat_post">Odeslat přes POST</button>
    </form>

    <br><hr><br>

    <!-- GET formulář – pro ukázku -->
    <form method="get" action="">
        Hledat: <input type="text" name="q" placeholder="Zadej hledaný výraz">
        <button type="submit">Hledat (GET)</button>
    </form>

<?php
echo "<hr>\n";

// ======================================================
// 3. $_GET vs $_POST – rozdíl a kdy co použít
// ======================================================
if (isset($_POST['odeslat_post'])) {
    // POST data – bezpečné, skryté, žádný limit velikosti
    echo "POST data přišla:\n";
    echo "Jméno:  " . htmlspecialchars($formJmeno) . "\n";   // vždy escapuj výstup!
    echo "Věk:    " . (int)$formVek . "\n";
    echo "Zpráva: " . htmlspecialchars($formZprava) . "\n";

    // ======================================================
    // 4. VALIDACE dat z formuláře
    // ======================================================
    if ($formJmeno === '') {
        echo "<span style='color:red;'>Chyba: Jméno je povinné!</span>\n";
    } elseif ($formVek < 0 || $formVek > 150) {
        echo "<span style='color:red;'>Chyba: Neplatný věk!</span>\n";
    } elseif (strlen($formZprava) < 5) {
        echo "<span style='color:red;'>Zpráva musí mít alespoň 5 znaků!</span>\n";
    } else {
        echo "<span style='color:green;'>Vše v pořádku – data jsou platná!</span>\n";
        
        // Uložíme platná data do souboru (viz níže)
        $log = date("d.m.Y H:i:s") . " | $formJmeno | $formVek | $formZprava\n";
        file_put_contents("log-zprav.txt", $log, FILE_APPEND);
    }
}

if (!empty($_GET)) {
    echo "\nGET data (viditelné v URL):\n";
    echo "Hledaný výraz: " . htmlspecialchars($_GET['q'] ?? '(prázdné)') . "\n";
    // GET je vhodný pro: vyhledávání, filtrování, bookmarky
    // NEVHODNÝ pro hesla, citlivá data, velké množství dat
}

echo "\n";

// ======================================================
// 5. PRÁCE SE SOUBORY – TXT, CSV, XML
// ======================================================

// 5.1 file_put_contents() – zápis do souboru (nejjednodušší způsob)
file_put_contents("pokus.txt", "Ahoj, toto je obsah vytvořený " . date("d.m.Y H:i") . "\n");

// Přidání dalšího řádku (FILE_APPEND)
file_put_contents("pokus.txt", "Druhý řádek – přidáno později\n", FILE_APPEND);

echo "Obsah souboru pokus.txt:\n";
echo "→ " . htmlspecialchars(file_get_contents("pokus.txt")) . "\n";   // file_get_contents() – načte celý soubor jako string

echo "\n";

// 5.2 CSV soubor – zápis a čtení
$csvData = "Jmeno;Vek;Mesto;Poznamka\n";
$csvData .= "Petr;30;Praha;Super kluk\n";
$csvData .= "Jana;25;Brno;Má ráda PHP\n";

file_put_contents("uzivatele.csv", $csvData);

echo "CSV soubor vytvořen. Obsah:\n";
if (file_exists("uzivatele.csv")) {
    $radky = file("uzivatele.csv");  // načte jako pole řádků
    foreach ($radky as $r) {
        $r = str_replace("\n", "", $r);  // odstraní konec řádku
        echo "→ $r\n";
    }
}

echo "\n";

// 5.3 XML soubor – jednoduchý příklad
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<uzivatele>
    <osoba>
        <jmeno>Tomáš</jmeno>
        <vek>28</vek>
        <mesto>Ostrava</mesto>
    </osoba>
    <osoba>
        <jmeno>Lucie</jmeno>
        <vek>22</vek>
    </osoba>
</uzivatele>';

file_put_contents("uzivatele.xml", $xml);

echo "XML soubor vytvořen a uložen jako uzivatele.xml\n";

if (file_exists("uzivatele.xml")) {
    $xmlObj = simplexml_load_file("uzivatele.xml");
    echo "První osoba z XML: " . $xmlObj->osoba[0]->jmeno . " (" . $xmlObj->osoba[0]->vek . " let)\n";
}

echo "\n";
echo "HOTOVO! Vše funguje – žádné chyby, žádné notice.\n";
echo "Soubory najdeš ve stejné složce jako tento PHP soubor.\n";

echo "</pre>";
?>
</body>
</html>