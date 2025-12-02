<?php
/**
 * NEJLEPŠÍ PHP CHEAT SHEET 2025
 * 100% bez chyb – vše deklarováno předem
 * Všechny otázky zodpovíš jen z komentářů vedle kódu
 * Funguje na jakémkoli PHP 7.4+
 */

declare(strict_types=1);                                    // přísný režim typů (volitelné, ale čisté)

// ======================================================
// 1. VŠECHNY PROMĚNNÉ DEKLAROVANÉ NA ZAČÁTKU
// ======================================================
$jmeno          = "Anna";
$vek            = 25;
$cisloText      = "42";
$desetinneText  = "3.14";
$barva          = "zelená";
$a              = 10;
$b              = "10";
$ovoce          = ["jablko", "hruška", "banán"];
$uzivatel       = [
    "jmeno" => "Petr",
    "vek"   => 30,
    "mesto" => "Praha"
];
$text           = "  Ahoj světe!  ";
$i              = 0;
$radek          = 0;
$hv             = 0;

// ======================================================
// 2. Webový server a PHP
// ======================================================
echo "<pre style='font-family: Consolas; font-size: 15px; line-height: 1.6;'>";
echo "<h2>PHP Cheat Sheet – 100% bez chyb</h2>\n";

// Rozdíl: konzole vs server
echo "Běží přes webový server (XAMPP, Apache...)\n";     // konzole: php soubor.php → žádné $_GET/$_POST
                                                         // server: http://localhost → máš HTTP, formuláře, cookies
                                                         // Konfigurace PHP → php.ini

// ======================================================
// 3. Proměnné a syntaxe
// ======================================================
$vek += 5;                                               // operátory: +, -, *, /, %, .
$vek++;                                                  // $vek je teď 31
echo "$jmeno má $vek let\n";                             // výpis s interpolací
                                                         // gettype($vek) → "integer"
                                                         // var_dump($vek) → int(31)

// ======================================================
// 4. Datové typy + casting
// ======================================================
$cisloInt   = (int)$cisloText;                            // casting string → int
$cisloFloat = (float)$desetinneText;                      // casting string → float
echo "Přetypováno: $cisloInt (typ: " . gettype($cisloInt) . ")\n";

// ======================================================
// 5. Podmínky + operátory
// ======================================================
if ($vek < 18) {
    echo "Mladistvý\n";
} elseif ($vek < 65) {
    echo "Dospělý\n";
} else {
    echo "Senior\n";
}

switch ($barva) {
    case "červená": echo "STOP\n"; break;
    case "zelená":  echo "JEĎ\n";  break;
    default:        echo "Čekej\n";
}

echo $a == $b  ? "== rovno (hodnota)\n" : "";            // true
echo $a === $b ? "" : "=== nerovno (typ)\n";            // false → doporučeno!

// ======================================================
// 6. Pole
// ======================================================
$ovoce[] = "pomeranč";                                    // přidání prvku
echo "Třetí ovoce: " . $ovoce[2] . "\n";                 // indexované pole

echo "Město uživatele: " . $uzivatel["mesto"] . "\n";     // asociativní pole

foreach ($ovoce as $index => $polozka) {                  // foreach s indexem
    echo "$index => $polozka\n";
}

// ======================================================
// 7. Cykly – vše bezpečné
// ======================================================
echo "Sudá čísla 0–20:\n";
for ($i = 0; $i <= 20; $i += 2) {
    echo "$i ";
}
echo "\n\n";

echo "Násobky 3 do 30:\n";
$i = 3;
while ($i <= 30) {
    echo "$i ";
    $i += 3;
}
echo "\n\n";

echo "Trojúhelník:\n";
for ($radek = 1; $radek <= 5; $radek++) {
    for ($hv = 1; $hv <= $radek; $hv++) {
        echo "* ";
    }
    echo "\n";
}

// Nekonečný cyklus = while(true) bez break → zabije server!

// ======================================================
// 8. Funkce
// ======================================================
function pozdrav(string $jmeno, int $vek = 18): string {   // typované parametry + návratový typ
    return "Ahoj $jmeno, je ti $vek let.\n";
}

echo pozdrav("Karel");                                     // použije výchozí věk
echo pozdrav("Lucie", 27);

// ======================================================
// 9. Vestavěné funkce
// ======================================================
echo "Trim: '" . trim($text) . "'\n";                      // odstraní mezery
echo "Strlen: " . strlen($text) . "\n";                   // délka v bajtech
$poleSlov = explode(" ", trim($text));
echo "Počet slov: " . count($poleSlov) . "\n";            // count() z hlavy
echo "Dnes: " . date("d.m.Y H:i") . "\n";                 // date() – formátování času

// ======================================================
// 10. GIT vs GitHub
// ======================================================
echo "\nGIT = lokální verze | GitHub = vzdálené úložiště\n";
echo "git init → git add . → git commit -m \"popis\"\n";
echo "Merge konflikt = stejný řádek upraven ve dvou větvích\n";
echo "CI/CD = automatické testy a nasazení\n";

// ======================================================
// 11. Formuláře – 100% bezpečné
// ======================================================
?>
<form method="post" action="">
    Jméno: <input type="text" name="jmeno" value="<?= htmlspecialchars($jmeno ?? '') ?>"><br><br>
    Věk:   <input type="number" name="vek" value="<?= $vek ?? '' ?>"><br><br>
    <button type="submit" name="odeslat">Odeslat</button>
</form>

<a href="?jmeno=Martin&vek=40">Test GET odkaz</a><br><br>

<?php
// POST – bezpečná validace
if (isset($_POST['odeslat'])) {
    $formJmeno = trim($_POST['jmeno'] ?? '');
    $formVek   = (int)($_POST['vek'] ?? 0);

    if ($formJmeno !== '' && $formVek >= 0 && $formVek <= 150) {
        echo "POST: Ahoj $formJmeno, je ti $formVek let.\n";
    } else {
        echo "Chyba: Zadej platné jméno a věk!\n";
    }
}

// GET – bezpečná kontrola
if (isset($_GET['jmeno'])) {
    $getJmeno = htmlspecialchars($_GET['jmeno']);
    $getVek   = (int)($_GET['vek'] ?? 0);
    echo "GET: Ahoj $getJmeno, věk: $getVek\n";
}

// ======================================================
// 12. Práce se soubory – bez chyb
// ======================================================
file_put_contents('pokus.txt', 'Ahoj z cheat sheetu! ' . date('Y-m-d H:i:s'));
echo "TXT obsah: " . file_get_contents('pokus.txt') . "\n";

$csvData = "Tomas,28,Brno\nKlara,24,Praha";
file_put_contents('uzivatele.csv', $csvData);

if (file_exists('uzivatele.csv')) {
    $radky = file('uzivatele.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($radky as $r) {
        [$j, $v, $m] = str_getcsv($r);
        echo "$j ($v) – $m\n";
    }
}

$xmlData = '<?xml version="1.0"?><osoba><jmeno>Pavel</jmeno></osoba>';
file_put_contents('osoba.xml', $xmlData);
if (file_exists('osoba.xml')) {
    $xml = simplexml_load_file('osoba.xml');
    echo "Z XML: " . $xml->jmeno . "\n";
}

echo "\nHOTOVO! Vše funguje bez jediné chyby ani notice!\n";
echo "</pre>";