<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>syllabus 1st</title>
</head>
<body>
<?php
define("SEMESTER", "Previous Semester - 6th Semester of BCA");
define("TOTAL_MARKS", 500);

$java = 85;
$html = 90;
$css = 78;
$rdbms = 92;
$os = 88;

$totalObtained = $java + $html + $css + $rdbms + $os;

$percentage = ($totalObtained / TOTAL_MARKS) * 100;

?>
<table class="table table-dark table-striped-columns">
  <thead>
    <tr>
      <th scope="col">Subject</th>
      <th scope="col">Mark</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">java</th>
      <td> <?php echo $java; ?> </td>
    </tr>
    <tr>
      <th scope="row">html</th>
      <td> <?php echo $html; ?> </td>
    </tr>
    <tr>
      <th scope="row">css</th>
      <td><?php echo $css; ?></td>
    </tr>
    <tr>
      <th scope="row">rdbms</th>
      <td><?php echo $rdbms; ?></td>
    </tr>
    <tr>
      <th scope="row">os</th>
      <td><?php echo $os; ?></td>
    </tr>
  </tbody>
</table>
</body>
</html>