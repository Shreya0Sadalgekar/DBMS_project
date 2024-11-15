<html>

<head>


<style>

.header {
  overflow:hidden;
  background-color:#c42f12; /* background color header */
  top: 0;
  width:100%;
  padding: 10px 5px;
  color:#39494a  ;
}

/* Style the header links */
.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
  font-weight:bold;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 25px;
  font-weight: bold;
  color:#fff  ; /* Heading 'Blood */
  font-family: "Lucida Handwriting", Cursive;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #fff; /*box after clicking on blood donation*/
  color: black;
}




/* Float the link section to the right */
.header-right {
  float: right;
  font-family: "Arial", sans-serif;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}
/* Style the active/current link*/
a.act{
  background: linear-gradient(to right, #14aaf5 0%, #79e0f7 100%);
  color: white;
border-radius:30px;
}
a.logo2{
  background-color: #333;
}
</style>
</head>

<body>
  <div class="header">
    <a href="home.php" class="logo"<?php if($active=='home') echo "class='logo2'"; ?>>Blood Bank & Donation </a>
    <div class="header-right">
      <a href="about_us.php"  <?php if($active=='about') echo "class='act'"; ?> >About Us</a>
      <a href="donate_blood.php"  <?php if($active=='donate') echo "class='act'"; ?>>Become A Donor</a>
      <a href="need_blood.php" <?php if($active=='need') echo "class='act'"; ?>>Need Blood</a>
      <a href="contact_us.php" <?php if($active=='contact') echo "class='act'"; ?>>Contact Us</a>
    </div>
  </div>

</body>
</html>
