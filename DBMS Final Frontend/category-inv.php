<!DOCTYPE html>
<html>

    <head>
        <?php 
include 'category-class.php';
?>

        <title> ICEinventory | Stock Inventory </title>

        <link rel = "stylesheet" href = "Style4.css">

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
                    
                    <p> Stock Inventory </p>

                </td>

            </tr>

            <!-- INPUT FORM -->
            
            <tr>


                    <td class = "Data_Form">

                        <table class = "Data_Table">

                            <!-- TABLE HEADER -->

                            <tr class = "Table_Header">

                                <td> Category Name </td>
                                <td> Description </td>
                                <td> Delete </td>
    
                            </tr>
                            <?php 
                                $category = new category();
                                if($category->list_category() != false){
                                foreach($category->list_category() as $value){
                                extract($value);
                            ?>
                            <tr>
                                <td><?php echo $category_name?></td>
                                <td><?php echo $category_description;?></td>
                                <td>
                                <form action="" method="POST">
                                <input type="hidden" name="category_id" value ="<?php echo $category->get_category_id($supply_category)?>" required>
                                <input type="submit" value="Delete">
                                </form>

                            </tr>
                            <?php 
                                }
                            }else{
                                echo "NO DATA";
                            }
                            ?>
                            

                        </table>

                    </td>

                
            </tr>

        </table>

    </body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $category_id = $_POST['category_id'];

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
    $sql = "DELETE FROM categories WHERE category_id = '$category_id'";

    if ($conn->query($sql) === TRUE) {
        echo 'Data deleted successfully!';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }

    $conn->close();
}
?>