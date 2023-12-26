
<?php
include 'dashboard.php';
$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$users = [];

try {
    $conn = new mysqli('localhost', 'root', '', 'ho_tel');
    $sql_users = "SELECT * FROM users WHERE name LIKE '%$keyword%' OR username LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR address LIKE '%$keyword%' OR email LIKE '%$keyword%' OR gender LIKE '%$keyword%'";
    $res_users = $conn->query($sql_users);

    if ($res_users->num_rows > 0) {
        while ($a = $res_users->fetch_assoc()) {
            array_push($users, $a);
        }
    }
} catch (Exception $e) {
    die('Database Error : ' . $e->getMessage());
}
?>
<style>
  /* Table Styles */
  .reg_user {
            height: 700px;
            
        }

        .user {
            display: flex;
            justify-content: center;
            
        }

        .user table {
            margin-top: 150px;
            width: 1200px;
        }
  table {
    width: 100%;
     /* margin: 0 auto; Center the table */
    border-collapse: collapse;
    margin-left: 250px;
    
  }
  
  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
  
  /* Button Styles */
  .operation-btn {
    padding: 5px 10px;
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    text-decoration: none;
  }
  
  .operation-btn.edit {
    background-color: #2196F3;
  }
  
  .operation-btn.delete {
    background-color: #f44336;
  }
  .operation-btn:hover, .delete-btn:hover, .new-user-btn:hover {
      background-color: #45a049;
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
  
    
</style>


<div class="reg_user">
    
        <div class="user">
        <!-- <button class="new-user-btn" id="new_user"><i class="fa fa-plus"></i>New User</button> -->
        <a href="add_user.php" class="new-user-btn"><i class="fa fa-plus"></i>New User</a>
        <table >
            
			<thead>
			<tr>
      
                    <th>Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th colspan="3">Operation</th>
                    
                </tr>
                <?php for ($i = 0; $i < count($users); $i++) { ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td><?php echo $users[$i]['name'] ?></td>
                        <td><?php echo $users[$i]['username'] ?></td>
                        <td><?php echo $users[$i]['phone'] ?></td>
                        <td><?php echo $users[$i]['address'] ?></td>
                        <td><?php echo $users[$i]['email'] ?></td>
                        
                        <td><?php echo $users[$i]['gender'] ?></td>
                        <td>
                            <a class="operation-btn edit " href="update_user.php?user_id=<?php echo $users[$i]['user_id'] ?>"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        </td>
                        
                        <td>
                            <a class="operation-btn delete" href="usersettingdel.php?user_id=<?php echo $users[$i]['user_id'] ?>" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i>Delete</a>
                        </td>

                    </tr>
                <?php } ?>
			</tbody>
		</table>
        </div>
		</div>
	</div>

</div>
<script>
	
//   $('#new_user').click(function(){
// 	uni_modal('New User','manage_user.php')
// })
// $('.edit_user').click(function(){
// 	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
// })


</script>