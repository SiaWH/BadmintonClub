<?php
    $title = 'Check Reviews';
    $heading = 'Check Reviews';
    require_once 'header.php';
?>
        <script src="./checkReview.js"></script>
        <link href="./checkReview.css" rel="stylesheet">
  
        <style>
            #delete{
                margin: 5%;
                padding: 1%;
            }
        </style>
        
        <?php
            if (isset($_POST['delete']))
            {
                $checked = $_POST['checked'];

                if (!empty($checked)) 
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    foreach ($checked as $value)
                    {
                        $escaped[] = $con->real_escape_string($value);
                    }

                    echo $sql = "DELETE FROM form WHERE ID IN ('" .
                           implode("','", $escaped) . "')";

                    if ($con->query($sql))
                    {
                        printf('
                            <div class="info">
                            <strong>%d</strong> record(s) has been deleted.
                            </div>',
                            $con->affected_rows);
                    }

                    $con->close();
                }
            }
        ?>
        
        <form action="" method="post">
        
        <table id="reviewTable">
            <tr style="font-size: 2vw; color: white; background-color: black;" id="tr">
                <th></th>
                <th>No.</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Faculty</th>
                <th>Review</th>
            </tr>
            
            <?php
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = "SELECT * FROM form";
                $count = 1;
                
                if ($result = $con->query($sql))
                {            
                    while ($row = $result->fetch_assoc()){
                        printf('<tr>
                                    <td>
                                        <input type="checkbox" name="checked[]" value="%d" />
                                    </td>
                                    <td>%d.</td>
                                    <td>%s</td>
                                    <td><a href="mailto:%s">%s</a></td>
                                    <td>%s</td>
                                    <td>%s</td>
                                </tr>', $row['ID'], $count, $row['Name'], $row['Email'], $row['Email'], $row['Faculty'], $row['Message']);
                        $count++;
                    }
                }
                else {
                    printf('<tr><td colspan="6" style="text-align: center;">No reviews</td></tr></table>');
                }
                $con->close();
            ?>

        </table>
                        <input type="submit" name="delete" value="Delete Checked"
           onclick="return confirm('This will delete all checked records.\nAre you sure?')" id="delete"/>
        
        </form>
        

    </body>
</html>



