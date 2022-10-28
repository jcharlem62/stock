<?php

class Utils
{

    public static function upload($extensions, $fichier)
    {

        $file_name = $fichier['name']; // nom sur le poste client
        $file_size = $fichier['size']; // taille
        $file_tmp = $fichier['tmp_name']; // fichier dans la memoire tampon
        $file_ext = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION)); // extension

        $uploadOk = false; // par defaut false avant que je fasse les controles
        $errors = ""; // chaine contient les messages d'erreurs s'il y en a

        // ctrl sur le nom ==> regex (pas de caract speciaux)
        // ctrl sur les extensions autorisees
        // ctrl sur la taille
        // ne pas ecraser un fichier existant

        $pattern = "/^[\p{L}\w\s\-\.]{3,}$/";
        if (!preg_match($pattern, $file_name)) {
            $errors .= "Nom de fichier non valide. <br/>";
        }

        if (!in_array($file_ext, $extensions)) {
            $errors .= "extension non autorisée. <br/>";
        }

        if ($file_size > 3000000) {
            $errors .= "taille du fichier ne doit pas dépasser 3 Mo. <br/>";
        }

        $file_name = substr(md5($fichier['name']), 10) . ".$file_ext";

        while (file_exists("images/$file_name")) {
            $file_name = substr(md5($file_name), 10) . ".$file_ext";
        }

        if ($errors === "") {
            if (move_uploaded_file($file_tmp,  "images/" . $file_name)) {
                $uploadOk = true;
            } else {
                $errors .= "Echec de l'upload. <br/>";
            }
        }
        return ["uploadOk" => $uploadOk, "file_name" => $file_name, "errors" => $errors];
    }

    public static function validation($str, $type)
    {
        $valide = false;
        // nettoyage
        $str = trim(strip_tags((string)$str));

        //https://www.php.net/manual/fr/regexp.reference.unicode.php
        $tabRegex = [
            "non" => "//",
            "test" => '/[\w]123/',
            "nom" => "/^[\p{L}\s]{2,}$/u",
            "prenom" => "/^[\p{L}\s]{2,}$/u",
            "tel" => "/^[\+]?[0-9]{10}$/",
            "photo" => "/^[\w\s\-\.]{1,22}(.jpg|.jpeg|.png|.gif)$/",
            "id" => "/[\d]+/",
            "pass" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/"
        ];

        //https://www.php.net/manual/fr/filter.filters.validate.php
        switch ($type) {
            case "email":
                if (filter_var($str, FILTER_VALIDATE_EMAIL) !== false) {
                    $valide = true;
                }
                break;
            case "url":
                if (filter_var($str, FILTER_VALIDATE_URL) !== false) {
                    $valide = true;
                }
                break;
            case "non":
                $valide = true;
            default:
                // chercherr la  correspondance avec le type associé
                if (preg_match($tabRegex[$type], $str)) {
                    $valide = true;
                }
        }

        $message =  $valide === true ?  "" : "Le champ $type n'est pas au format demandé.[ctrl serveur]<br/>";
        return  [$str, $message];
    }

    public static function valider($donnes, $types)
    {
        $erreurs = "";
        for ($i = 0; $i < count($donnes); $i++) {
            // tab contient cette structure : [$str, $message]
            $tab = Utils::validation($donnes[$i], $types[$i]);
            // si j'ai un message ==> c'est qu'il y a une erreur ==> chaine pas conforme au type
            if ($tab[1]) {
                $erreurs .= $tab[1];
            }
            $donneesValides[] =      $tab[0];
        }

        if ($erreurs) {
            return ["erreurs" => $erreurs];
        }
        return $donneesValides;
    }
}
