<?php
ob_start();
include "dashboard.php";
include "connect.php";
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM room_categories WHERE room_id = $id");
  header('location:display_room.php');
};

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$select = mysqli_query($conn, "SELECT * FROM room_categories WHERE name LIKE '%$keyword%'");


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>





.container2 {
  max-width: 1000px;
  /* margin: 20px auto; */
  /* margin-top: 155px;
  margin-left:280px; */
  padding: 20px;
  /* background-color: #f1f1f1; */
  border-radius: 5px;
  /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
}

table {
  
  width: 100%;
  border-collapse: collapse;
}

table th,
table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

table th {
  background-color: #f2f2f2;
}

.btn-edit,
.btn-delete,
.btn-view {
  padding: 6px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-right: 5px;
  text-decoration: none;
}

.btn-edit {
  background-color: #2196f3;
  color: #fff;
}

.btn-delete {
  background-color: #f44336;
  color: #fff;
}
.btn-view{
  background-color: #ccc;
  text-decoration: none;
  color: #000;
}
.btn-edit:hover,
.btn-delete:hover,
.btn-view:hover{
  background-color: #0d8aed;
}

.management-section {
  flex: 1;
}

.new-user-btn {
    position: absolute;
    top: 0;
    right: 0;
    margin: 80px;
    padding: 8px 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top:100px;
    text-decoration: none;
  }
  

  .room table {
            margin-top: 145px;
            margin-left: 300px;
             background-color: #f1f1f1;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
  

        
</style>
</head>
<body>

<section class="page">
 <div class="container2">
   <div class="room">
   <a href="add_room.php" class="new-user-btn"><i class="fa fa-plus"></i>New Room</a>
   <?php
include "connect.php";
$select = mysqli_query($conn, "SELECT * FROM room_categories");

?>
   
   <table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Room</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                <td class="">
                    <p>Name : <b><?php echo $row['name'] ?></b></p>
                    <p>Price : <b><?php echo "Rs" . number_format($row['price'], 2) ?></b></p>
                </td>
                <td>
                    <a href="view.php?room_id=<?php echo $row['room_id']; ?>" class="btn-view"><i class="fas fa-light fa-eye"></i> View</a>
                </td>
                <td>
                    <a href="edit_room.php?edit=<?php echo $row['room_id']; ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <a href="display_room.php?delete=<?php echo $row['room_id']; ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn-delete"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
   </table>
</div>
