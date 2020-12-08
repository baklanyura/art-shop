<?php

    if(isset( $_COOKIE["basket"] )) {
        $basket = json_decode($_COOKIE["basket"], true);
        for($i = 0; $i < count($basket["basket"]); $i++) {
            if($basket["basket"][$i]["product_id"] == $_POST["id"]) {
                $basket["basket"][$i]["count"] = $_POST["count"];
            }

            //
            $jsonProduct = json_encode($basket);

            // Очищаем куки
            setcookie("basket", "", 0, "/");

            // Добавляем куки
            setcookie("basket", $jsonProduct, time() + 60*60, "/");

        }
    }

?>