<?php 
include "setup.php";
isLoggedIn();

$erfolg = false;

if (!empty($_POST)) {
    // Formular wurde abgeschickt -> Validierung
    $validieren = new fdb_validieren();
    $validieren->ist_ausgefuellt($_POST["marken_id"], "Marke");
    $validieren->ist_ausgefuellt($_POST["modell"], "Modell");
    $validieren->ist_ausgefuellt($_POST["farbe"], "Farbe");
    $validieren->fin($_POST["fin"], "Fahrzeug-Identifikationsnr.");
    $validieren->eindeutig(
        "fahrzeuge", // DB-Tabelle
        "fin", // Spalte, die eindeutig sein soll
        $_POST["fin"], // Übergebene FIN aus Formular
        $_GET["id"] ?? null, // Bearbeiten-ID, wenn vorhanden
        "Fahrzeug-Identifikationsnr." // Feldname für Fehlermeldung
    );

    if ($validieren->keine_fehler()) {
        // Keine Fehler aufgetreten -> speichern
        $fahrzeug = new fdb_fahrzeug(array(
            // Wenn id vorhanden, dann id verwenden, sonst den Wert rechts von "??"
            // https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
            "id" => $_GET["id"] ?? null, 
            "fin" => strtoupper($_POST["fin"]),
            "marken_id" => $_POST["marken_id"],
            "modell" => $_POST["modell"],
            "farbe" => $_POST["farbe"]
        ));

        $fahrzeug->speichern();
        $erfolg = true;
    }
}

include "header.php";

echo "<h1>Fahrzeug bearbeiten</h1>";

// Erfolgsmeldung
if ($erfolg == true) {
    echo "<p>Fahrzeug wurde erfolgreich gespeichert.<br><a href='fahrzeuge_list.php'>Zurück zur Liste</a></p>"; 
}

// Fehlermeldung ausgeben, wenn eine aufgetreten ist
if (!empty($validieren)) {
    echo $validieren->fehler_html();
}

// Wenn $_GET["id"] gegeben ist -> Bearbeiten-Modus
// Daten aus DB holen und vorausfüllen
if (!empty($_GET["id"])) {
    $row = new fdb_fahrzeug($_GET["id"]);
}
?>

<form action="fahrzeuge_edit.php<?php if (!empty($row)) echo "?id={$row->id}";?>" method="POST">
    <div>
        <label for="marken_id">Marke:</label>
        <select name="marken_id" id="marken_id">
            <option value="">Bitte wählen...</option>
            <?php
            $marken = fdb_marken::get_all();
            foreach ($marken as $marke) {
                echo "<option value='{$marke->id}'";
                if (!$erfolg && !empty($_POST["marken_id"]) && $_POST["marken_id"] == $marke->id) {
                    echo " selected";
                } else if (!empty($row) && $row->marken_id == $marke->id) {
                    echo " selected";
                }
                echo ">{$marke->titel}</option>";
            }
            ?>
        </select>
    </div>

    <div>
        <label for="modell">Modell:</label>
        <input type="text" name="modell" id="modell" value="<?php
        if (!$erfolg && !empty($_POST["modell"])) {
            echo htmlspecialchars($_POST["modell"]);
        } else if (!empty($row)) {
            echo htmlspecialchars($row->modell);
        }
        ?>">
    </div>

    <div>
        <label for="farbe">Farbe:</label>
        <input type="text" name="farbe" id="farbe" value="<?php
        if (!$erfolg && !empty($_POST["farbe"])) {
            echo htmlspecialchars($_POST["farbe"]);
        } else if (!empty($row)) {
            echo htmlspecialchars($row->farbe);
        }
        ?>">
    </div>

    <div>
        <label for="fin">Fahrzeug-Identifikationsnr.:</label>
        <input type="text" name="fin" id="fin" value="<?php
        if (!$erfolg && !empty($_POST["fin"])) {
            echo htmlspecialchars($_POST["fin"]);
        } else if (!empty($row)) {
            echo htmlspecialchars($row->fin);
        }
        ?>">
    </div>

    <div>
        <button type="submit">Speichern</button>
    </div>
</form>

<?php 
include "footer.php";
?>