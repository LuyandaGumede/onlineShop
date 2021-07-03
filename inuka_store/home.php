<?php include 'includes/session.php' ?>
<!DOCTYPE html>
<html lang="en">

<?php
$page = "home";

include 'includes/head.php';
?>

<body>
  <div class="cover">

    <?php include 'includes/navbar.php' ?>

    <div id="home">

      <header>
        <h1>INUKA</h1>
        <h2>Affordable beauty</h2>
      </header>

      <section class="product" id="product">
        <?php
        $products = $controller->getQuery("SELECT * FROM products ORDER BY id ASC");
        if (!empty($products)) {
          foreach ($products as $key => $value) {
            $stock_class = "has_stock";
            if ($products[$key]["stock"] == 0) {
              $stock_class = "no_stock";
            }

            ?>

            <div class="card <?php echo $stock_class ?>">
              <form method="post" action="home.php?action=add&code=<?php echo $products[$key]["code"] ?>">

                <div class="card_side card_side-front">
                  <figure>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($products[$key]['image']) ?>" alt="product-image" />
                    <figcaption><?php echo $products[$key]["name"] ?></figcaption>
                  </figure>
                  <p class="desc"><?php echo $products[$key]["desc"] ?></p>
                </div>

                <div class="card_side card_side-back">
                  <div class="add-cart">
                    <p class="price"><?php echo "R" . $products[$key]["price"] ?></p>
                    <div class="quant">
                      <input type="number" class="product-quantity" name="quantity" value="1" min='1' max="<?php echo $products[$key]["stock"] ?>" autocomplete="off" />Qty
                    </div>
                    <button>Add to Cart</button>
                  </div>
                </div>

              </form>
            </div>

          <?php
          }
        }
        ?>
      </section>

    </div>

    <?php include 'includes/footer.php' ?>
  </div>

</body>

</html>