<?php
include "functions.php";
isLoggedIn();

$error = array();
$success = false;

// Prüfen, ob Formular abgeschickt wurde
if (!empty($_POST)) {
    // SQL Injection verhindern
    $sql_benutzer_id = escape($_POST["benutzer_id"]);
    $sql_titel = escape($_POST["titel"]);
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_id = escape($_GET["id"]);

    // Validierung
    if (empty($_POST["titel"])) {
        $error[] = "Bitte gib einen Namen für das neue Rezept ein.";
    }

    // Wenn kein Validierungsfehler -> in DB speichern
    if (empty($error)) {
        query("UPDATE rezepte SET 
            benutzer_id = '{$sql_benutzer_id}', 
            titel = '{$sql_titel}', 
            beschreibung = '{$sql_beschreibung}' 
            WHERE id = '{$sql_id}'
        ");

        // Alle Zutaten-Zuordnungen löschen und neu anlegen
        query("DELETE FROM rezepte_zu_zutaten WHERE rezepte_id = '{$sql_id}");
        foreach($_POST["zutaten_id"] as $key => $zutat_id) {
            // Überspringe, wenn eine leere Zutat abgeschickt wird
            if (empty($zutat_id)) {
                continue;
            }

            $sql_zutaten_id = escape($zutat_id);
            $sql_menge = escape($_POST["menge"][$key]);
            $sql_einheit = escape($_POST["einheit"][$key]);

            query("INSERT INTO rezepte_zu_zutaten SET 
                rezepte_id = '{$sql_id}', 
                zutaten_id = '{$sql_zutaten_id}',
                menge = '{$sql_menge}',
                einheit = '{$sql_einheit}'
            ");
        }

        $success = true;
    }
}

include "header.php";
?>

    <h1>Rezept bearbeiten</h1>

    <?php
    // Eventuelle Fehler ausgeben
    if (!empty($error)) {
        echo "<ul>";
        foreach ($error as $ein_fehler) {
            echo "<li>{$ein_fehler}</li>";
        }
        echo "</ul>";
    }

    // Erfolgsmeldung ausgeben
    if ($success) {
        echo "<p><strong>Rezept wurde bearbeitet</strong><br>";
        echo "<a href='rezepte_list.php'>Zurück zur Liste</a></p>";
    }

    // DB nach Rezept-Datensatz fragen (zur Vorausfüllung)
    $sql_id = escape($_GET["id"]);
    $result = query("SELECT * FROM rezepte WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);
    ?>

    <form action="rezepte_edit.php?id=<?php echo $row["id"]; ?>" method="POST">
        <div>
            <label for="benutzer_id">Benutzer:</label>
            <select name="benutzer_id" id="benutzer_id">
                <?php 
                $result = query("SELECT * FROM benutzer ORDER BY benutzername ASC");

                while ($user = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$user["id"]}'";
                    if (!empty($_POST["benutzer_id"]) && !$success && $_POST["benutzer_id"] == $user["id"]) {
                        // Formular wurde mit Fehlern abgeschickt -> mit POST-Werten vorausfüllen
                        echo " selected";
                    } else if ((empty($_POST["benutzer_id"]) || $success) && $row["benutzer_id"] == $user["id"]) {
                        // Wir sind frisch zum Formular gekommen -> mit Session-Benutzer-ID vorausfüllen
                        echo " selected";
                    }
                    echo ">{$user["benutzername"]}</option>";
                }
            ?></select>
        </div>

        <div>
            <label for="titel">Rezepttitel:</label>
            <input 
                type="text" 
                name="titel" 
                id="titel" 
                value="<?php 
                    if (!empty($_POST["titel"]) && !$success) { 
                        echo htmlspecialchars($_POST["titel"]);
                    } else {
                        echo htmlspecialchars($row["titel"]);
                    }
                ?>"
            >
        </div>

        <div>
            <label for="beschreibung">Beschreibung:</label>
            <textarea name="beschreibung" id="beschreibung"><?php 
                    if (!empty($_POST["beschreibung"]) && !$success) { 
                        echo $_POST["beschreibung"]; 
                    } else {
                        echo htmlspecialchars($row["beschreibung"]);
                    }
                ?></textarea>
        </div>

        <div class="ingredient-list">
            <?php 
            // Ermitteln, wie viele Zutaten-Blöcke wir brauchen (zum Vorausfüllen im Fehlerfall)
            $blocks = 1;
            if (!empty($_POST["zutaten_id"]) && !$success) {
                $blocks = count($_POST["zutaten_id"]);
            } else {
                // DB nach den bisherigen Zutaten-Zuordnungen fragen
                $result = query("SELECT * FROM rezepte_zu_zutaten WHERE rezepte_id = '{$sql_id}' ORDER BY id ASC");

                // mysqli_num_rows gibt die Anzahl der Zeilen zurück: https://www.php.net/mysqli_num_rows
                $blocks = mysqli_num_rows($result);

                $zutaten_zuordnungen = array();
                while ($zuordnung = mysqli_fetch_assoc($result)) {
                    $zutaten_zuordnungen[] = $zuordnung;
                }
            }

            // Sicherstellen, dass immer 1 Block besteht
            if ($blocks < 1) $blocks = 1;

            for ($i = 0; $i < $blocks; $i++) {
            ?>
                <div class="ingredient-block">
                    <div>
                        <label for="zutaten_id">Zutaten:</label>
                        <select name="zutaten_id[]" id="zutaten_id">
                            <option value="">Bitte wählen...</option>

                            <?php 
                            $result = query("SELECT * FROM zutaten ORDER BY titel ASC");

                            while ($zutat = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$zutat["id"]}'";
                                if (!empty($_POST["zutaten_id"]) && !$success && $_POST["zutaten_id"][$i] == $zutat["id"]) {
                                    // Formular wurde mit Fehlern abgeschickt -> mit POST-Werten vorausfüllen
                                    echo " selected";
                                } else if (
                                    (empty($_POST["zutaten_id"]) || $success) 
                                    && !empty($zutaten_zuordnungen[$i]) 
                                    && $zutaten_zuordnungen[$i]["zutaten_id"] == $zutat["id"]) {
                                    // Wir sind frisch zum Formular gekommen -> mit Zutaten-ID vorausfüllen
                                    echo " selected";
                                }
                                echo ">{$zutat["titel"]}</option>";
                            }
                        ?></select>
                    </div>

                    <div>
                        <label for="menge">Menge:</label>
                        <input type="number" name="menge[]" id="menge" value="<?php 
                            if (!empty($_POST["menge"]) && !$success) {
                                echo htmlspecialchars($_POST["menge"][$i]);
                            } else if (!empty($zutaten_zuordnungen[$i])) {
                                echo htmlspecialchars($zutaten_zuordnungen[$i]["menge"]);
                            }
                        ?>">
                    </div>

                    <div>
                        <label for="einheit">Einheit:</label>
                        <input type="text" name="einheit[]" id="einheit" value="<?php 
                            if (!empty($_POST["einheit"]) && !$success) {
                                echo htmlspecialchars($_POST["einheit"][$i]);
                            } else if (!empty($zutaten_zuordnungen[$i])) {
                                echo htmlspecialchars($zutaten_zuordnungen[$i]["einheit"]);
                            }
                        ?>">
                    </div>
                </div>
            <?php } ?> <!-- Ende der for-Schleife --> 
        </div>

        <a class="ingredient-new" href="#" onclick="newRecipe();">Zutat hinzufügen</a>

        <div>
            <button type="submit">Rezept speichern</button>
        </div>
    </form>

<?php 
include "footer.php";
?>