

 
 <?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 session_start();

 if (!isset($_SESSION['wishlist'])) {
     $_SESSION['wishlist'] = [];
 }
 
 $productId = $_POST['productId'] ?? '';
 $action = $_POST['action'] ?? '';
 
 if ($action === 'add') {
     if (!in_array($productId, $_SESSION['wishlist'])) {
         $_SESSION['wishlist'][] = $productId;
         echo 'added';
     }
 } elseif ($action === 'remove') {
     $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$productId]);
     echo 'removed';
 } else {
     echo 'error';
 }
 ?>


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}


//session_start();

// Initialize wishlist array if not set
//if (!isset($_SESSION['wishlist'])) {
  //  $_SESSION['wishlist'] = [];
//}

// Get the action from the request
//$action = $_POST['action'] ?? '';
//$productId = $_POST['productId'] ?? '';

//if ($action === 'add' && !in_array($productId, $_SESSION['wishlist'])) {
  //  $_SESSION['wishlist'][] = $productId;
    //echo json_encode(['status' => 'added']);
//} elseif ($action === 'remove' && in_array($productId, $_SESSION['wishlist'])) {
  //  $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$productId]);
    //echo json_encode(['status' => 'removed']);
//} else {
  //  echo json_encode(['status' => 'error']);
//} 



