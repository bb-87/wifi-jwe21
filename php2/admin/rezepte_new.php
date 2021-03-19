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

    // Validierung
    if (empty($_POST["titel"])) {
        $error[] = "Bitte gib einen Namen für das neue Rezept ein.";
    }

    // Wenn kein Validierungsfehler -> in DB speichern
    if (empty($error)) {
        query("INSERT INTO rezepte SET 
            benutzer_id = '{$sql_benutzer_id}', 
            titel = '{$sql_titel}', 
            beschreibung = '{$sql_beschreibung}'
        ");
        // https://www.php.net/mysqli_insert_id
        $new_recipe_id = mysqli_insert_id($db);

        // Zuordnung zu Zutaten anlegen
        foreach($_POST["zutaten_id"] as $key => $zutat_id) {
            // Überspringe, wenn eine leere Zutat abgeschickt wird
            if (empty($zutat_id)) {
                continue;
            }

            $sql_zutaten_id = escape($zutat_id);
            $sql_menge = escape($_POST["menge"][$key]);
            $sql_einheit = escape($_POST["einheit"][$key]);

            query("INSERT INTO rezepte_zu_zutaten SET 
                rezepte_id = '{$new_recipe_id}', 
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

    <h1>Neues Rezept anlegen</h1>

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
        echo "<p><strong>Rezept wurde angelegt</strong><br>";
        echo "<a href='rezepte_list.php'>Zurück zur Liste</a></p>";
    }
    ?>

    <form action="rezepte_new.php" method="POST">
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
                    } else if ((empty($_POST["benutzer_id"]) || $success) && $_SESSION["benutzer_id"] == $user["id"]) {
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
                value="<?php if (!empty($_POST["titel"]) && !$success) echo htmlspecialchars($_POST["titel"]); ?>"
            >
        </div>

        <div>
            <label for="beschreibung">Beschreibung:</label>
            <textarea name="beschreibung" id="beschreibung"><?php 
                if (!empty($_POST["beschreibung"]) && !$success) echo htmlspecialchars($_POST["beschreibung"]);
            ?></textarea>
        </div>
        
        <div class="ingredient-list">
            <?php 
            // Ermitteln, wie viele Zutaten-Blöcke wir brauchen (zum Vorausfüllen im Fehlerfall)
            $blocks = 1;
            if (!empty($_POST["zutaten_id"]) && !$success) {
                $blocks = count($_POST["zutaten_id"]);
            }

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
                        }
                    ?>">
                </div>

                <div>
                    <label for="einheit">Einheit:</label>
                    <input type="text" name="einheit[]" id="einheit" value="<?php 
                        if (!empty($_POST["einheit"]) && !$success) {
                            echo htmlspecialchars($_POST["einheit"][$i]);
                        }
                    ?>">
                </div>
            </div>
            <?php } ?> <!-- Ende der for-Schleife --> 
        </div>

        <a class="ingredient-new" href="#" onclick="newRecipe();">Zutat hinzufügen</a>

        <div>
            <button type="submit">Rezept anlegen</button>
        </div>
    </form>

<?php 
include "footer.php";
?>