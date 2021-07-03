<nav>
  <div class="logo"><a href="home.php">Affordable beauty</a></div>
  <ul>
    <li <?php if ($page == 'home') echo 'class="active"' ?>><a href="home.php">HOME</a></li>
    <li <?php if ($page == 'about') echo 'class="active"' ?>><a href="about.php">ABOUT</a></li>
    <li <?php if ($page == 'cart') echo 'class="active"' ?>><a href="cart.php"><?php echo file_get_contents("img/cart-icon.svg") ?></a></li>
  </ul>
</nav>

<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div id="dialogbox_body"></div>
</div>