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
                        <a href = "Delete.php"> <li> Delete Record </li> </a>

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
                                <label for = "rls_no"> <p> RLS Number </p></label>
                                <input type = "number" name = "rls_no" required>
        
                                <!-- SUPPLIER NAME -->
                                <label for = "supp_nm"> <p> Supplier Name </p></label>
                                <input type = "text" name = "supp_nm" required>
        
                                <!-- EXPIRATION DATE -->
                                <label for = "rls_date"> <p> RLS Date </p></label>
                                <input type = "date" name = "rls_date">

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
    if (isset($_POST['rls_no'], $_POST['code'], $_POST['rls_date'], $_POST['qty'], $_POST['supplier_add'], $_POST['supp_nm'])) {
        // Retrieve form data
        $rls_no = $_POST['rls_no'];
        $stock_code = $_POST['code'];
        $rls_date = $_POST['rls_date'];
        $rls_qty = $_POST['qty'];
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

        // Check if the stock item exists in the table
        $checkQuery = "SELECT * FROM stock_inventory WHERE stock_code = '$stock_code'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // Stock item exists, subtract the quantity from the stock count
            $updateQuery = "UPDATE stock_inventory
                            SET stock_count = stock_count - $rls_qty
                            WHERE stock_code = '$stock_code'";

            if ($conn->query($updateQuery) === TRUE) {
                echo 'Stock count updated successfully!';
            } else {
                echo 'Error updating stock count: ' . $conn->error;
            }
        } else {
            echo 'Stock item does not exist in stock_inventory!';
        }

        // Insert a record into the releasing_stock table
        $insertReleasingQuery = "INSERT INTO releasing_stock (stock_code, rls_id, rls_date, rls_qty, supplier_address, supplier_name)
                                 VALUES ('$stock_code', '$rls_no', '$rls_date', '$rls_qty', '$supplier_address', '$supplier_name')";

        if ($conn->query($insertReleasingQuery) === TRUE) {
            echo 'New stock item added to releasing_stock!';
        } else {
            echo 'Error adding new stock item to releasing_stock: ' . $conn->error;
        }

        $conn->close();
    } else {
        echo 'Form fields are not set!';
    }
}




?>



