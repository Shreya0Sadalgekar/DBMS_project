<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conn.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .navbar {
      background-color: #333333;
      padding: 10px 10px;
      color: #FF0404;
    }

    .navbar a {
      float: left;
      color: white;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
    }

    .navbar-brand {
      font-size: 25px;
      font-weight: bold;
    }

    .navbar a {
      float: none;
      display: block;
      text-align: left;
    }

    .navbar-right {
      float: none;
    }

    #qq:hover {
      background-color: #E5E8E8;
      border-radius: 5px;
    }
  </style>
</head>
<body style="color:black">
<div id="header">
  <?php include 'header.php'; ?>
</div>
<div id="sidebar">
  <?php $active="query"; include 'sidebar.php'; ?>
</div>
<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">
          <h1 class="page-title">User Query</h1>
        </div>
      </div>
      <hr>

      <?php
      $limit = 10;
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $offset = ($page - 1) * $limit;
      $count = $offset + 1;

      $sql = "SELECT * FROM contact_query LIMIT {$offset}, {$limit}";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
      ?>
      <div class="table-responsive">
        <table class="table table-bordered" style="text-align:center">
          <thead>
            <th>S.no</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Mobile Number</th>
            <th>Message</th>
            <th>Posting Date</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['query_name']; ?></td>
                <td><?php echo $row['query_mail']; ?></td>
                <td><?php echo $row['query_number']; ?></td>
                <td><?php echo $row['query_message']; ?></td>
                <td><?php echo $row['query_date']; ?></td>
                <td><?php echo $row['query_status'] == 1 ? 'Read' : '<a href="query.php?id=' . $row['query_id'] . '" onclick="clickme()"><b>Pending</b></a>'; ?></td>
                <td id="he" style="width:100px">
                  <a style="background-color:aqua" href='delete_query.php?id=<?php echo $row['query_id']; ?>'> Delete </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php } else {
        echo '<div class="alert alert-warning">No records found.</div>';
      } ?>

      <div class="table-responsive" style="text-align:center;">
        <?php
        $sql1 = "SELECT * FROM contact_query";
        $result1 = mysqli_query($conn, $sql1);
        $total_records = mysqli_num_rows($result1);
        $total_page = ceil($total_records / $limit);

        echo '<ul class="pagination admin-pagination">';
        if ($page > 1) {
          echo '<li><a href="query.php?page=' . ($page - 1) . '">Prev</a></li>';
        }
        for ($i = 1; $i <= $total_page; $i++) {
          $active = $i == $page ? "active" : "";
          echo '<li class="' . $active . '"><a href="query.php?page=' . $i . '">' . $i . '</a></li>';
        }
        if ($total_page > $page) {
          echo '<li><a href="query.php?page=' . ($page + 1) . '">Next</a></li>';
        }
        echo '</ul>';
        ?>
      </div>
    </div>
  </div>
</div>

<?php
} else {
  echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
  ?>
  <form method="post" action="login.php" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-8 col-sm-offset-4" style="float:left">
        <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
      </div>
    </div>
  </form>
<?php } ?>
</body>
</html>
