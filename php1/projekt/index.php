<?php
    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";

    // Default Wert setzen falls $_GET["seite"] leer ist
    if (empty($_GET["seite"])) {
        $seite = "home";
    } else {
        $seite = $_GET["seite"];
    }

    // Die einzubindende content-Datei ermitteln
    if ($seite == "home") {
        $includeFile = "home.php";
        $docTitle = "Der Friseur Ihrer Wahl";
    } else if ($seite == "leistungen") {
        $includeFile = "leistungen.php";
        $docTitle = "Leistungen";
    } else if ($seite == "öffnungszeiten") {
        $includeFile = "oeffnungszeiten.php";
        $docTitle = "Öffnungszeiten";
    } else if ($seite == "kontakt") {
        $includeFile = "kontakt.php";
        $docTitle = "Kontaktieren Sie uns";
    } else {
        $includeFile = "error404.php";
        $docTitle = "Seite nicht gefunden";
    }

    // HTML blockweise wieder zusammensetzen
    include "header.php";
    include "content/{$includeFile}"; // Seitenspezifischer Inhalt
    include "footer.php";
?>