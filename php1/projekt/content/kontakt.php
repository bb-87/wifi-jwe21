<section>
    <?php 
    // echo "<pre>"; 
    // print_r($_POST);
    // echo "</pre>";

    $errormsgs = array();
    $success = false;

    if (!empty($_POST)) {
        if (empty($_POST["name"])) {
            $errormsgs[] = "Bitte geben Sie einen Namen ein.";
        } else if (mb_strlen($_POST["name"]) <= 2) {
            $errormsgs[] = "Ihr Name muss mehr als 2 Zeichen enthalten.";
        }

        if (empty($_POST["email"])) {
            $errormsgs[] = "Bitte geben Sie Ihre E-Mail Adresse ein.";
        } else if (!preg_match("/^.+@[a-z0-9\-\.äöüÄÖÜ]+\.[a-z]{2,15}$/i", $_POST["email"])) { // error prone, should not be used
            $errormsgs[] = "Dies ist keine gültige E-Mail Adresse.";
        }

        if (empty($_POST["message"])) {
            $errormsgs[] = "Bitte geben Sie eine Nachricht ein.";
        }

        if (empty($errormsgs)) {
            $success = true;

            $mailContent = "Anfrage aus dem Kontaktformular: Name: {$_POST["name"]} E-Mail: {$_POST["email"]} Nachricht: {$_POST["message"]}";

            // echo "<pre>{$mail_inhalt}</pre>";

            // Anfrage in Datei am Server speichern (Permissions müssen passen!)
            // $filename = date("Y-m-d_H-i-s");
            // file_put_contents("mailbackup/".$filename, $mailContent);

            // E-Mail versenden (Mail Server muss vorhanden sein)
            // https://www.php.net/manual/de/function.mail.php
            // mail("rainer.christian@gmx.at", "Kontaktformular von {$_POST["name"]}", $mailContent);
        }
    }
    ?>

    <div class="text">
        <h1>Kontakt</h1>

        <div class="left">
            <h2>Wifi Salzburg</h2>
            <p>
                Musterhausstraße 13<br>
                5020 Salzburg<br>
                Österreich<br>
                <br>
                0043-662-12345<br>
                <a href="mailto:rainer.christian@gmx.at">rainer.christian@gmx.at</a><br>
                <a href="http://www.wifisalzburg.at" target="_blank">www.wifisalzburg.at</a><br>
                <br>
                <br>
                Oder einfach Formular ausfüllen, abschicken, fertig!<br>
                Wir werden uns umgehend um Ihr Anliegen bemühen.
            </p>
        </div>

        <div class="contact right">
            <?php 
                if (!empty($errormsgs)) {
                    echo "<strong>Es sind Fehler aufgetreten</strong>";

                    echo "<ul>";
                    foreach ($errormsgs as $key => $errormsg) {
                        echo "<li>{$errormsg}</li>";
                    }
                    echo "</ul>";
                }

                if ($success) {
                    echo "<h3>Vielen Dank für Ihre Anfrage!</h3>";
                } else {
            ?> 

            <form method="POST"> <!-- https://www.w3schools.com/tags/att_form_method.asp --> 
                <div>
                    <input type="text" id="name" name="name" value="<?php if (!empty($_POST["name"])) echo $_POST["name"] ?>" placeholder="Name">
                </div>
                <div>
                    <input type="text" id="email" name="email" value="<?php if (!empty($_POST["email"])) echo $_POST["email"] ?>" placeholder="E-Mail">
                </div>
                <div>
                    <textarea id="message" name="message" placeholder="Ihre Nachricht"><?php if (!empty($_POST["message"])) echo $_POST["message"] ?></textarea>
                </div>
                <div style="text-align: right;">
                    <button type="submit" id="submit" name="submit">Absenden</button>
                </div>
            </form>
            <?php } ?> <!-- Schließende Klammer für die else von $success -->
        </div>

        <div class="clear"></div>
    </div>
    
    <div class="clear"></div>
</section>