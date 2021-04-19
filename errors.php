<?php

function displayErrors($errors) {
    if (count($errors) > 0) {
        echo "<div>";
            foreach ($errors as $error) {
                echo "<p>";
                echo "***" . $error . "***";
                echo "</p>";
            }
        echo "</div>";
    }
}