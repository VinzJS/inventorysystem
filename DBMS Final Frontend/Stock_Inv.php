<!DOCTYPE html>
<html>

    <head>
        <?php 
include 'stock-class.php';
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
                        <a href = "Delete.php"> <li> Delete Record </li> </a>

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

                                <td> Code </td>
                                <td> Name </td>
                                <td> Category </td>
                                <td> Expiry Date </td>
                                <td> Count </td>
                                <td> Receiving </td>
                                <td> Releasing </td>
    
                            </tr>
                            <?php 
                                $inv = new inventory();
                                if($inv->list_inventory() != false){
                                foreach($inv->list_inventory() as $value){
                                extract($value);
                            ?>
                            <tr>
                            <td><a href="stock-update.php?stock_code=<?php echo $stock_code; ?>"><?php echo "C" . $stock_code; ?></a></td>

                            <td><?php echo $stock_name;?></td>
                            <td><?php echo $stock_category;?></td>
                            <td><?php echo $stock_exp;?></td>
                            <td><?php echo $stock_count;?></td>
                            <td><a href="Receiving_Stock.php?stock_code=<?php echo $stock_code; ?>">Receiving</a></td>
                            <td><a href="Releasing_Stock.php?stock_code=<?php echo $stock_code; ?>">Releasing</a></td>
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