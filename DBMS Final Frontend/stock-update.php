<!DOCTYPE html>
<html>

    <head>

        <title> ICEinventory | Stock </title>

        <link rel = "stylesheet" href = "Style2.css">

    </head>

    <body>
    <?php 
        include 'category-class.php';
        include 'stock-class.php'; 
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
                        <a href = "Delete.php"> <li> Delete Record </li> </a>

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
                            <?php 
                            $stock_code = $_GET['stock_code'];
                            $inventory = new inventory();
                            ?>

                                <!-- CODE -->
                                <label for = "code"> <p> Code </p></label>
                                <input type = "text" name = "code" value="<?php echo $stock_code; ?>" required>
        
                                <!-- NAME -->
                                <label for = "name"> <p> Name </p></label>
                                <input type = "text" name = "name"  value="<?php echo $inventory->get_name($stock_code); ?>"required>
        
                                <!-- EXPIRATION DATE -->
                                <label for = "bday"> <p> Expiry Date </p></label>
                                <input type = "date" name = "bday" value="<?php echo $inventory-> get_exp_date($stock_code); ?>">
        
                            </div>
            
                            <div class = "Col2">
        
                                <!-- CATEGORY -->
                                <label for = "category"> <p> Category </p></label>
                                
                                <select id="category" name="category" required>
            <option value="">Select Category</option>
            <?php
            $category = new category();
            $categories = $category->list_category();
            if ($categories != false) {
              foreach ($categories as $value) {
                $category_name = $value['category_name'];
                ?>
                <option value="<?php echo $category_name; ?>"><?php echo $category_name; ?></option>
                <?php
              }
            }
            ?>
          </select>
          <?php
          // Assuming you have the category ID available, replace 'category_id' with the actual ID value
          $category_id = 'category_id';
          ?>
                            
                                <!-- COUNT -->
                                <label for = "count"> <p> Count </p></label>
                                <input type = "number" name = "count" value = "<?php echo $inventory->get_count($stock_code);?>" required>
        
                                </br></br>
                            
                                <!-- SUBMIT BUTTON -->
                                <input type = "submit" value = "Save">

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

    // Prepare and execute the SQL query for updating data
    $sql = "UPDATE stock_inventory SET stock_name='$name', stock_exp='$expiryDate', stock_category='$category', stock_count='$count' WHERE stock_code='$code'";

    if ($conn->query($sql) === TRUE) {
        echo 'Data updated successfully!';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}
?> 