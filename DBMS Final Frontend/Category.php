<!DOCTYPE html>
<html>

    <head>

        <title> ICEinventory | Category </title>

        <link rel = "stylesheet" href = "Style3.css">

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
                    
                    <p> New Category </p>

                </td>

            </tr>

            <!-- INPUT FORM -->
            
            <tr>

                <form action = "" method = "POST">

                    <td class = "Data_Form"> 

                        <div class = "Container">

                            <!-- COLUMN 1 (Left Side) -->

                            <div class = "Col1">

                                <!-- NAME -->
                                <label for = "code"> <p> Name </p></label>
                                <input type = "text" name = "code" required>
        
                                <!-- DESCRIPTION -->
                                <label for = "name"> <p> Description </p></label>
                                <input type = "text" name = "name">

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
    // Retrieve form data
    $name = $_POST['code'];
    $category_desc = $_POST['name'];

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
    $sql = "INSERT INTO categories (supply_category, category_desc)
            VALUES ('$name', '$category_desc')";

    if ($conn->query($sql) === TRUE) {
        echo 'Data saved successfully!';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}
?>
