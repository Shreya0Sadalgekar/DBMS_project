<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Style the header */
    .header {
      overflow: hidden;
      background-color: #c42f12; /* Header background color */
      padding: 10px 5px;
      color: #39494a;
      width: 100%;
      top: 0;
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
      font-weight: bold;
    }

    /* Style for the logo */
    .header a.logo {
      font-size: 25px;
      font-weight: bold;
      color: #fff;
      font-family: "Lucida Handwriting", Cursive;
    }

    /* Hover effect for header links */
    .header a:hover {
      background-color: #fff; /* Hover background color */
      color: black;
    }

    /* Float the right-side links */
    .header-right {
      float: right;
      font-family: Arial, sans-serif;
    }

    /* Media query for responsiveness */
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

    /* Active link style */
    a.act {
      background: linear-gradient(to right, #14aaf5 0%, #79e0f7 100%);
      color: white;
      border-radius: 30px;
    }
  </style>
</head>

<body>
  <div class="header">
    <a href="home.php" class="logo">Blood Bank & Donation</a>
    <div class="header-right">
      <a href="about_us.php" class="<?php if ($active == 'about') echo 'act'; ?>">About Us</a>
      <a href="why_donate_blood.php" class="<?php if ($active == 'why') echo 'act'; ?>">Why Donate Blood</a>
      <a href="donate_blood.php" class="<?php if ($active == 'donate') echo 'act'; ?>">Become A Donor</a>
      <a href="need_blood.php" class="<?php if ($active == 'need') echo 'act'; ?>">Need Blood</a>
      <a href="contact_us.php" class="<?php if ($active == 'contact') echo 'act'; ?>">Contact Us</a>
    </div>
  </div>
</body>
</html>
