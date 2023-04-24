<?php
$servername = "localhost";
$username = "root";
$userpassword = "07084802023";
$dbname = "db";

$conn = new mysqli($servername, $username, $userpassword, $dbname);

//接続

if ($conn->connect_error) {
    die("connection error" . $conn->connect_error);
}

$sql = "SELECT * FROM usersdb";
$result = $conn->query($sql);

$conn->close();

?>

<table id="userTable">
    <thead>
        <tr>
            <th>id</td>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Delete</th>
            <th>Edit</th>
            

        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td><button class='btn-delete' data-id='" . $row["id"] . "'>Delete</button></td>"; // Delete button
                echo "<td><button class='btn-update' data-id='" . $row["id"] . "' data-name='" . $row["name"] . "' data-email='" . $row["email"] . "'>Update</button>
</td>"; // Update button
                

                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td colspan='4'>No users found</td>";
            echo "</tr>";
        }



        ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="style.css">

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
    $('#userTable').DataTable();

    //  delete operation 
    $('#userTable').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr'); // Get the closest row element

        // Confirm the delete operation
        if (confirm('Are you sure you want to delete this user?')) {
            // Send AJAX request to delete.php
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {id: id},
                dataType: 'json',
                success: function(response) {
                    // Check the response status
                    if (response.status === 'success') {
                        // Remove the deleted row from the table immediately
                        row.remove();
                        // Show success message
                        alert(response.message);
                    } else {
                        // Show error message
                        alert(response.message);
                    }
                },
                error: function() {
                    // Show error message
                    alert('Error deleting user record');
                }
            });
        }
    });


   // Update operation
$('#userTable').on('click', '.btn-update', function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var email = $(this).data('email');

    // Show a prompt to get the updated values from the user
    var newName = prompt('Enter new name', name);
    var newEmail = prompt('Enter new email', email);

    // Send AJAX request to update.php
    $.ajax({
        url: 'update.php',
        type: 'POST',
        data: {id: id, name: newName, email: newEmail},
        dataType: 'json',
        success: function(response) {
            // Check the response status
            if (response.status === 'success') {
                // Show success message
                alert(response.message);
                // Reload the page to reflect the updated data
                location.reload();
            } else {
                // Show error message
                alert(response.message);
            }
        },
        error: function() {
            // Show error message
            alert('Error updating user record');
        }
    });
});


});

</script>