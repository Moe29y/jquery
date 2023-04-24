<?php
$servername = "localhost";
$username = "root";
$userpassword ="07084802023";
$dbname ="db";

$conn = new mysqli($servername,$username,$userpassword,$dbname);

if($conn->connect_error){
die ("Error" . $conn->connect_error);
}

$sql = "SELECT * FROM example";
$result = $conn->query($sql);

$conn->close();

?>
<table id="uTable">
<thead>
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Delete</th>
</tr>
</thead>
<tbody>
    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>";

            echo "<td>". $row["id"] . "</td>";
            echo"<td>" . $row["name"]. "</td>";
            echo "<td><button class='btn_delete' data-id='" . $row["id"] . "'>Delete</button></td>"; // Delete button

            echo "</tr>";
        }
    }else {
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
    $('#uTable').DataTable();

    //delete operation
    $("#uTable").on('click', '.btn_delete', function(){
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        $.ajax({
            url : "exampleDelete.php",
            type : "POST",
            data : {
                id : id
            },
            dataType : "json",
            success :function(response){
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

        //for 

    });
    });
    </script>
