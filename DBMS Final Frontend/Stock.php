<!DOCTYPE html>
<html>

    <head>

        <title> ICEinventory | Stock </title>

        <link rel = "stylesheet" href = "Style2.css">
        <script>
            function clearForm() {
            document.getElementById("code").value = "";
            document.getElementById("name").value = "";
            document.getElementById("bday").value = "";
            document.getElementById("category").selectedIndex = 0;
            document.getElementById("count").value = "";
    }
    
  </script>

    </head>

    <body>
    <?php 
        include 'category-class.php';
  ?>
        
        <table>

            <!-- HEADER (ICEinventory Text) -->

            <tr>
                
                <td class = "Header">
    
                    <h2> ICEinventory </h2>
                    <p> HVG Warehouse, Bacolod City </p>
    
                </td>

            </tr>

            <!-- NAVIGATION BAR -->

            <tr>

                <td class = "Nav_Bar">

                    <ul>

                        <a href = "Menu.php"> <li> Menu </li> </a>
                        <a href = "Stock.php"> <li> Stock </li> </a>
                        <a href = "Category.php"> <li> Category </li> </a>
                        <a href = "Stock_Inv.php"> <li> Stock Inventory </li> </a>
                        <a href = "Receiving.php"> <li> Receiving </li> </a>
                        <a href = "Releasing.php"> <li> Releasing </li> </a>
                        <a href = "#"> <li> Delete Record </li> </a>

                    </ul>

                </td>
               
            </tr>

            <!-- DIRECTORY -->

            <tr>

                <td class = "Directory">
                    
                    <p> New Stock </p>

                </td>

            </tr>

            <!-- INPUT FORM -->
            
            <tr>

                <form action = "" method = "POST">

                    <td class = "Data_Form"> 

                        <div class = "Container">

                            <!-- COLUMN 1 (Left Side) -->

                            <div class = "Col1">

                                <!-- CODE -->
                                <label for = "code"> <p> Code </p></label>
                                <input type = "text" id = "code" name = "code"  required>
        
                                <!-- NAME -->
                                <label for = "name"> <p> Name </p></label>
                                <input type = "text" id = "name" name = "name" required>
        
                                <!-- EXPIRATION DATE -->
                                <label for = "bday"> <p> Expiry Date </p></label>
                                <input type = "date" id = "bday" name = "bday">
        
                            </div>
            
                            <div class = "Col2">
        
                                <!-- CATEGORY -->
                                <label for = "category"> <p> Category </p></label>
                                
                                <select id="category" id = "category" name="category" required>
            <option value="">Select Category</option>
            <?php
            $category = new category();
            $categories = $category->list_category();
            if ($categories != false) {
              foreach ($categories as $value) {
                $supply_category = $value['supply_category'];
                ?>
                <option value="<?php echo $supply_category; ?>"><?php echo $supply_category; ?></option>
                <?php
              }
            }
            ?>
          </select>
          <?php
          // Assuming you have the category ID available, replace 'category_id' with the actual ID value
          $category_id = 'category_id';
          ?>

                                <!-- DELETE CATEGORY BUTTON -->
                                <a href="category-inv.php" style="display: inline-block; padding: 10px 20px; background-color: #e74c3c; color: #fff; text-decoration: none; border-radius: 5px;">Delete Category</a>



                                
                                <!-- COUNT -->
                                <label for = "count"> <p> Count </p></label>
                                <input type = "number" id = "count" name = "count" required>
        
                                </br></br>
                            
                                <!-- SUBMIT BUTTON -->
                                <input type = "submit" value = "Save">

                                <!-- CLEAR BUTTON -->
                                <input type="button" value="Clear" onclick="clearForm()">
        
        
                            </div>
        
                        </div>
        
                    </td>

                </form>
                
            </tr>

        </table>

    </body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $code = $_POST['code'];
    $name = $_POST['name'];
    $expiryDate = $_POST['bday'];
    $category = $_POST['category'];
    $count = $_POST['count'];

    // Perform database connection and query execution
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'finalproject';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO stock_inventory (stock_code, stock_name, stock_exp, stock_category, stock_count)
            VALUES ('$code', '$name', '$expiryDate', '$category', '$count')";

    if ($conn->query($sql) === TRUE) {
        echo 'Data saved successfully!';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}
?>
