<?php
session_start();
require_once("controller.php");
$controller = new DBController();
if (!empty($_GET["action"])) {
  switch ($_GET["action"]) {
    case "add":
      if (!empty($_POST["quantity"])) {
        $prod = $controller->getQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
        $itemArray = array(
          $prod[0]["code"] => array(
            'name' => $prod[0]["name"],
            'code' => $prod[0]["code"],
            'price' => $prod[0]["price"],
            'image' => $prod[0]["image"],
            'quantity' => $_POST["quantity"]
          )
        );

        if (!empty($_SESSION["cart_item"])) {
          if (in_array($prod[0]["code"], array_keys($_SESSION["cart_item"]))) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
              if ($prod[0]["code"] == $k) {
                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
              }
            }
          } else {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
        }
        $quan = $_POST["quantity"];
        $code = $_GET["code"];
        $controller->giveQuery("UPDATE products SET stock = stock - $quan WHERE code = '$code'");
      }
      header("Location: /student-toys/home.php");
      break;
    case "remove":
      if (!empty($_SESSION["cart_item"])) {
        foreach ($_SESSION["cart_item"] as $k => $v) {
          if ($_GET["code"] == $k)
            unset($_SESSION["cart_item"][$k]);
          if (empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
        }
        $quan = $_GET["qty"];
        $code = $_GET["code"];
        $controller->giveQuery("UPDATE products SET stock = stock + $quan WHERE code = '$code'");
      }
      header("Location: /student-toys/cart.php");
      break;
    case "empty":
      unset($_SESSION["cart_item"]);
      break;
  }
}
?>