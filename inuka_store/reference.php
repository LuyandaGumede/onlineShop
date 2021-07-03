<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php
$page = "refer";

include 'includes/head.php';
?>

<body>
  <div class="cover">

    <?php include 'includes/navbar.php'; ?>

    <div id="refer">
      <div id="refer-content" style="display: none">
        <div class="reference">
          <h2>Thank you!</h2>
          <p>Your order has been processed.</p>
          <p class="bank">
            <span>Bank details:</span><br>
            Account Holder: <span>Inuka</span><br>
            Bank Name: <span>Standard Bank</span><br>
            Account Number: <span>987456321</span><br>
            Reference: <span class="ref-num"><?php echo $_GET["ref"]; ?></span><br>
          </p>
          <p>
            Please make sure that you provide the correct <span class="ref-num">reference number</span> when making the payment!<br>
              Once the payment has been recieved, delivery process will begin.<br>
              You should expect the product to arrive within 5-7 business days.
          </p>
          <button id="btn-refer-close" onclick="closeRefer()">Done</button>
        </div>
      </div>
    </div>

    <script>
      referDialog();
    </script>


    <?php include 'includes/footer.php'; ?>

  </div>
</body>

</html>