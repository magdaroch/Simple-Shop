<?php ?>
<html>
    <head>
        <title>Order</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/script.js"></script>
    </head>
    <body>


        <table>
            <tr>
                <td>Produkt
                </td>
                <td>
                    ilosc
                </td>
            </tr>  
<?php
require_once __DIR__ . '/src/Photo.php';
require_once __DIR__ . '/src/Product.php';
require_once __DIR__ . '/src/Order.php';
require_once __DIR__ . '/config.php';
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location:login.php');
}
if (isset($_GET['id']) && isset($_POST['quantity'])) {
    $idProduct = $_GET['id'];
    $productQuantity = $_POST['quantity'];


    $addToBacket = Product::loadProductById($conn, $idProduct);
    
    var_dump(($updateOrder=Order::loadOrderByproductId($conn, $idProduct)));
    
  if($updateOrder=Order::loadOrderByproductId($conn, $idProduct)){
      $updateOrder->addOrderToTheBD($conn, $idProduct);
  }
    $newOrder = new Order();
    $newOrder->setProductId($idProduct);
    $newOrder->setQuantity($productQuantity);
    $newOrder->addOrderToTheBD($conn);
}
    $loadorder = Order::loadALLOrders($conn);




    $productPrice = 0;
    foreach ($loadorder as $key => $value) {


        $product = Product::loadProductById($conn, $value->getProductId());



        $productName = $product->getName();
        $productQuantityVal = $value->getQuantity();

        $productPrice +=$product->getPrice();
        echo '<tr>';
        echo "<td> $productName; </td>";
        echo "<td> $productQuantityVal; </td>";
        echo '<td> <a href="del_order.php?id=' . $value->getOrderId() . '">Usun</a>  </td>';
        echo '<td> <a href="editOrder.php?id=' . $value->getOrderId() . '">Edytuj</a>  </td>';
        echo '</tr>';
    }
    echo'</table>';

    echo "Suma: $productPrice";

?>

    </body>
</html>


