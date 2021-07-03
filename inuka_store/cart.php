<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php
$page = "cart";

include 'includes/head.php';
?>

<body>
	<div class="cover">

		<?php include 'includes/navbar.php'; ?>

		<div id="cart">
			<?php
			if (isset($_SESSION["cart_item"])) {
				$total_quantity = 0;
				$total_price = 0;
				?>

			<ul>
				<li class="table-header">
					<div class="col col-1">Name</div>
					<div class="col col-2">Unit Price</div>
					<div class="col col-3">Quantity</div>
					<div class="col col-4"></div>
				</li>

				<?php
					foreach ($_SESSION["cart_item"] as $item) {
						$item_price = $item["quantity"] * $item["price"];
						?>
				<li class="table-row">
					<div class="col col-1" data-label="Name:">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($item["image"]) ?>" alt="item-image" class="item-image" />
						<p><?php echo $item["name"]; ?></p>
					</div>

					<div class="col col-2" data-label="Unit Price:"><?php echo "R " . $item["price"]; ?></div>
					<div class="col col-3" data-label="Quantity:"><?php echo $item["quantity"]; ?></div>
					<div class="col col-4"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>&qty=<?php echo $item["quantity"]; ?>" id="btn-remove"><?php echo file_get_contents("img/trash.svg") ?><?php echo file_get_contents("img/trash-open.svg") ?></a>
					</div>
				</li>
				<?php
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"] * $item["quantity"]);
					}
					?>
			</ul>

			<div class="sum">
				<h2>Cart Summary</h2>
				<p>Items: <strong>
						<?php
							if (!empty($total_quantity)) {
								echo $total_quantity;
							} else {
								echo 0;
							}
							?>
					</strong></p>
				<p>Total price: <strong>
						<?php
							if (!empty($total_price)) {
								echo "R " . number_format($total_price, 2);
							} else {
								echo "R " . number_format(0, 2);
							}
							?>
					</strong></p>
				<button onclick="checkoutForm()" name="btn-check">Checkout</button>
			</div>

			<?php
			} else {
				?>
			<div class="empty"><a href="home.php">Your Cart is Empty</a></div>
			<?php
			}
			?>

			<div id="form-content" style="display: none">
				<form method="post" onsubmit="return validateAll()" name="order-form" id="order-form">
					<h3>Order Submission</h3>
					<div class="name">
						<label for="name-order">Full Name:</label>
						<input type="text" onkeyup="validateName()" placeholder="Enter Name..." id="name-order" name="name-order">
						<span class="tooltiptext">At least 3 letters, only letters</span>
					</div>
					<div class="email">
						<label for="email-order">Email:</label>
						<input type="text" onkeyup="validateEmail()" placeholder="Enter Email..." id="email-order" name="email-order">
						<span class="tooltiptext">example@place.com</span>
					</div>
					<div class="phone">
						<label for="phone-order">Phone:</label>
						<input type="tel" onkeyup="validatePhone()" placeholder="Enter Contact Number..." id="phone-order" name="phone-order">
						<span class="tooltiptext">10 digit phone number</span>
					</div>
					<div class="address">
						<label for="address-order">Address:</label>
						<input type="text" onkeyup="validateAddress()" placeholder="Enter a Detailed Address..." id="address-order" name="address-order">
						<span class="tooltiptext">Detailed and complete</span>
					</div>
					<button type="submit" name="btn-order-submit">Place order</button>
				</form>
				<button id="btn-order-cancel" onclick="closeDialog()">Cancel</button>
			</div>

			<?php
			function checkout($controller, $total_price)
			{
				$prods_arr = array();
				foreach ($_SESSION["cart_item"] as $item) {
					$quan = $item["quantity"];
					$code = $item["code"];
					$name = $item["name"];
					$prods_arr[] = array("code" => $code, "NAME" => $name,  "QTY" => $quan);
					$controller->giveQuery("UPDATE products SET stock = stock - $quan WHERE code = '$code'");
				}

				$prods_str = json_encode($prods_arr);

				$name = '';
				$email = '';
				$phone = '';
				$address = '';
				if (isset($_POST['name-order'])) {
					$name = $_POST["name-order"];
				}
				if (isset($_POST['email-order'])) {
					$email = $_POST["email-order"];
				}
				if (isset($_POST['phone-order'])) {
					$phone = $_POST["phone-order"];
				}
				if (isset($_POST['address-order'])) {
					$address = $_POST["address-order"];
				}

				$ref = uniqid('', false);
				$total = $total_price;

				$controller->giveQuery("INSERT INTO orders(id, name, email, phone, address, ref, total, prod_arr, paid, delivered) VALUES (NULL, '$name', '$email', '$phone', '$address', '$ref', '$total', '$prods_str', '0', '0')");

				echo
					'<script>',
					'window.location.replace("/student-toys/reference.php?action=empty&ref=' . $ref . '");',
					'referDialog();',
					'</script>';
			}

			if (array_key_exists('btn-order-submit', $_POST)) {
				checkout($controller, $total_price);
			}

			?>

			<div id="refer-content" style="display: none">
				<p>Thank you!</p>
				<p>Your order has been processed.</p>
				<p>
					Bank details:<br>
					Account Holder: INUKA<br>
					Bank: Standard Bank<br>
					Account Number: 987456321<br>
					Reference: <?php echo $_GET["ref"]; ?><br>
				</p>
				<p>
					Please ensure that you provide us with the correct reference number when making the payment!<br>
					Once the payment has been recieved, delivery process will begin.<br>
					You should expect the product to arrive within 5-7 business days.
				</p>
				<button id="btn-refer-close" onclick="closeRefer()">Done</button>
			</div>

		</div>

		<?php include 'includes/footer.php'; ?>

	</div>
</body>

</html>