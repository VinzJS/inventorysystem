<!DOCTYPE html>
<html>

    <head>

        <title> ICEinventory | Receiving Stock </title>

        <link rel = "stylesheet" href = "Style2.css">
        <?php 
include 'receiving-class.php';
include 'stock-class.php';
?>

    </head>

    <body>
        
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
                    
                    <p> Receiving Stock </p>

                </td>

            </tr>

            <!-- INPUT FORM -->
            
            <tr>

                <form action = "#" method = "POST">

                    <td class = "Data_Form"> 

                        <div class = "Container">

                            <!-- COLUMN 1 (Left Side) -->

                            <div class = "Col1">
                                <?php 
                            $stock_code = $_GET['stock_code'];
                            $inventory = new inventory();
                            ?>

                                <!-- RCS NUMBER -->
                                <label for = "rcs_no"> <p> RCS Number </p></label>
                                <input type = "number" name = "rcs_no" required>
        
                                <!-- SUPPLIER NAME -->
                                <label for = "supp_nm"> <p> Supplier Name </p></label>
                                <input type = "text" name = "supp_nm" required>
        
                                <!-- EXPIRATION DATE -->
                                <label for = "rcs_date"> <p> RCS Date </p></label>
                                <input type = "date" name = "rcs_date">

                                <!-- STOCK CODE -->
                                <?php
                                $inventory = new inventory();;
                                ?>
                                <label for = "code"> <p> Stock Code </p></label>
                                <input type = "number" name = "code" value = "<?php echo $stock_code;?>" readonly>
                            

                            </div>

                            <!-- COLUMN 2 (Right Side) -->
            
                            <div class = "Col2">
                            <?php
                                $inventory = new inventory();;
                                ?>

                                <!-- QUANTITY -->
                                <label for = "qty"> <p> Quantity </p></label>
                                <input type = "number" name = "qty" required>
        
                                <!-- SUPPLIER ADDRESS -->
                                <label for = "supplier_add"> <p> Supplier Address </p></label>
                                <input type = "text" name = "supplier_add" required>
                                
                                <!-- STOCK NAME -->
                                <label for = "name"> <p> Stock Name </p></label>
                                <input type = "text" name = "name" value="<?php echo $inventory->get_name($stock_code); ?>"readonly>

                                <!-- CURRENT STOCK -->
                                <label for = "current_stock"> <p> Current Stock </p></label>
                                <input type = "number" name = "current_stock" value = "<?php echo $inventory->get_count($stock_code);?>"readonly>
        
                                </br></br>
                            
                                <!-- SUBMIT BUTTON -->
                                <input type = "submit" value = "Submit">

                                <!-- CLEAR BUTTON -->
                                <input type = "submit" value = "Clear">
        
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
    // Check if form fields are set
    if (isset($_POST['rcs_no'], $_POST['code'], $_POST['rcs_date'], $_POST['qty'], $_POST['supplier_add'], $_POST['supp_nm'])) {
        // Retrieve form data
        $rcs_no = $_POST['rcs_no'];
        $stock_code = $_POST['code'];
        $rcs_date = $_POST['rcs_date'];
        $rcs_qty = $_POST['qty'];
        $supplier_address = $_POST['supplier_add'];
        $supplier_name = $_POST['supp_nm'];

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

        // Check if the stock item already exists in the table
        $checkQuery = "SELECT * FROM stock_inventory WHERE stock_code = '$stock_code'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // Stock item exists, update the stock count only for the specific stock item
            $updateQuery = "UPDATE stock_inventory
                            SET stock_count = stock_count + $rcs_qty
                            WHERE stock_code = '$stock_code'";

            if ($conn->query($updateQuery) === TRUE) {
                echo 'Stock count updated successfully!';
            } else {
                echo 'Error updating stock count: ' . $conn->error;
            }
        } else {
            // Stock item does not exist, insert a new record into stock_inventory table
            $insertStockQuery = "INSERT INTO stock_inventory (stock_code, stock_count)
                                 VALUES ('$stock_code', '$rcs_qty')";

            if ($conn->query($insertStockQuery) === TRUE) {
                echo 'New stock item added to stock_inventory!';
            } else {
                echo 'Error adding new stock item to stock_inventory: ' . $conn->error;
            }
        }

        // Check if the receiving record already exists in the receiving_stock table
        $checkReceivingQuery = "SELECT * FROM receiving_stock WHERE rcs_id = '$rcs_no' AND stock_code = '$stock_code'";
        $receivingResult = $conn->query($checkReceivingQuery);

        if ($receivingResult->num_rows === 0) {
            // Receiving record does not exist, insert a new record into receiving_stock table
            $insertReceivingQuery = "INSERT INTO receiving_stock (rcs_id, stock_code, rcs_date, rcs_qty, supplier_address, supplier_name)
                                     VALUES ('$rcs_no', '$stock_code', '$rcs_date', '$rcs_qty', '$supplier_address', '$supplier_name')";

            if ($conn->query($insertReceivingQuery) === TRUE) {
                echo 'New stock item added to receiving_stock!';
            } else {
                echo 'Error adding new stock item to receiving_stock: ' . $conn->error;
            }
        } else {
            echo 'Receiving record already exists in receiving_stock table!';
        }

        $conn->close();
    } else {
        echo 'Form fields are not set!';
    }
}



?>



