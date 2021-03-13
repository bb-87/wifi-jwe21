<?php
include "functions.php";
isLoggedIn();

$error = array();
$success = false;

// Prüfen, ob Formular abgeschickt wurde
if (!empty($_POST)) {
    // SQL Injection verhindern
    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);

    // Validierung
    if (empty($_POST["titel"])) {
        $error[] = "Bitte gib einen Namen für die neue Zutat ein.";
    } else {
        // Überprüfe, ob die Zutat bereits existiert
        $result = query("SELECT * FROM zutaten WHERE titel = '{$sql_titel}'");
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $error[] = "Diese Zutat existiert bereits.";
        }
    }

    // Wenn kein Validierungsfehler -> in DB speichern
    if (empty($error)) {
        if ($sql_kcal_pro_100 == "") {
            $sql_kcal_pro_100 = "NULL";
        }
        query("INSERT INTO zutaten SET titel = '{$sql_titel}', kcal_pro_100 = {$sql_kcal_pro_100}");
        $success = true;
    }
}

include "header.php";
?>

    <h1>Neue Zutat anlegen</h1>

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
        echo "<p><strong>Zutat wurde angelegt</strong><br>";
        echo "<a href='zutaten_list.php'>Zurück zur Liste</a></p>";
    }
    ?>

    <form action="zutaten_new.php" method="POST">
        <div>
            <label for="titel">Zutat:</label>
            <input 
                type="text" 
                name="titel" 
                id="titel" 
                value="<?php if (!empty($_POST["titel"]) && !$success) echo htmlspecialchars($_POST["titel"]); ?>"
            >
        </div>

        <div>
            <label for="kcal_pro_100">KCal / 100g:</label>
            <input 
                type="number" 
                step="0.01" 
                min="0" 
                placeholder="(optional)" 
                name="kcal_pro_100" 
                id="kcal_pro_100" 
                value="<?php if (!empty($_POST["kcal_pro_100"]) && !$success) echo $_POST["kcal_pro_100"] ?>"
            >
        </div>

        <div>
            <button type="submit">Zutat anlegen</button>
        </div>
    </form>

<?php 
include "footer.php";
?>