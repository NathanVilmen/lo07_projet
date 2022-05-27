<?php

// 20/03/2019 : bibliotheque fonctions formulaire avec bootstrap
// Marc LEMERCIER


// =========================
// form_begin
// =========================

function form_begin($class, $method, $action) {
    echo ("\n<!-- ============================================== -->\n");
    echo ("<!-- form_begin : $class $method $action) -->\n");
    printf("<form class='%s' method='%s' action='%s'>\n", $class, $method, $action);
}

// =========================
// form_input_text
// =========================

function form_input_text($label, $name, $size) {
    echo ("\n<!-- form_input_text : $label $name $size -->\n");
    echo ("  <p>\n");

    echo ("<div class='form-group'>");
    echo (" <label for='$label'>$label</label>");
    echo (" <input type='text' class='form-control' name='$name' size='$size'>");
    echo ("</div>");
}

// --------------------------------------------------
// form_input_hidden
// --------------------------------------------------

function form_input_hidden($name, $value) {
    echo ("\n<!-- form_input_hidden : $name $value -->\n");

    echo ("<input type='hidden' name='$name' value='$value' />");
}

// =========================
// form_select
// =========================

// Parametre $label    : permet un affichage (balise label)
// Parametre $name     : attribut pour identifier le composant du formulaire
// Parametre $multiple : si cet attribut n'est pas vide alors sélection multiple possible
// Parametre $size     : attribut size de la balise select
// Parametre $liste    : un liste d'options. Vous utiliserez un foreach pour générer les balises option

function form_select($label, $name, $liste) {
    echo "<div class='form-group'>";
    echo "<label for='$label'>$label</label>";

    echo ("<select name='$name' id='$label' class='form-control'>");
    foreach ($liste as $value){
        echo "<option value='$value'>$value</option>";
    }
    echo "</select></div>";
}

// =========================

function form_input_reset($value) {
    echo "<button type='reset' class='btn btn-danger'>$value</button>";
}

// =========================

function form_input_submit($value) {
    echo "<button type='submit' class='btn btn-primary'>$value</button>";
}

// =========================


function form_end() {
    echo "</form>";
}

// =========================

?>