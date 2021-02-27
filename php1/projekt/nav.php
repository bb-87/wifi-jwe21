<?php 
    echo "<nav><ul>";
    $nav_punkte = array(
        "home" => "Home",
        "leistungen" => "Leistungen",
        "öffnungszeiten" => "Öffnungszeiten",
        "kontakt" => "Kontakt"
    );

    foreach ($nav_punkte as $href => $nav_punkt) {
        echo "<li";

        if ($href == $seite) {
            echo " class='active'";
        }

        echo "><a href='?seite={$href}'>{$nav_punkt}</a></li>";
    }

    echo "</ul></nav>";
?>