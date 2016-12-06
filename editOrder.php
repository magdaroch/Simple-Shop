<?php
    require_once __DIR__ . '/src/Order.php';
    require_once __DIR__ . '/config.php';
    $updateOrder='';
    
if (isset($_GET['id'])) {

    ?>
    <form action="editOrder.php" method="POST">

        ilosc :<input  type="number" name="quantity" value="1" min="1">
        <input type="submit" name="wyslij" value="Update">

    </form>
    <?php
    $updateOrder = Order::loadOrderById($conn, $_GET['id']);
    
}elseif ($_POST('quantity')) {
    
    var_dump($updateOrder);
}

else {
   // header('Location: basket.php');
}
?>
