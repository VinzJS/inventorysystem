<!DOCTYPE html>
<html>

    <head>
    <?php 
include 'receiving-class.php';
include 'stock-class.php';
?>

        <title> ICEinventory | Receiving </title>

        <link rel = "stylesheet" href = "Style5.css">

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

                <form action = "#" method = "GET">

                    <td class = "Data_Form">

                        <table class = "Data_Table">

                            <!-- TABLE HEADER -->

                            <tr class = "Table_Header">

                                <td> RCS Number </td>
                                <td> Supplier Name </td>
                                <td> Supplier Address </td>
                                <td> Stock Code </td>
                                <td> Stock Name </td>
                                <td> Current Stock </td>
                                <td> Quantity (+) </td>
                                <td> New Count </td>
                                <td> RCS Date </td>
    
                            </tr>
                            <?php 
                                $rec = new receiving();
                                if($rec->list_receiving() != false){
                                foreach($rec->list_receiving() as $value){
                                extract($value);

                                $inventory = new inventory();
                                if($inventory->list_inventory() != false){
                                foreach($rec->list_receiving() as $value){
                                extract($value);
                            ?>
                                
                            <tr>
                            <td><?php echo "RCS" . $RCS_number;?></td>
                            <td><?php echo $supplier_name;?></td>
                            <td><?php echo $supplier_address;?></td>
                            <td><?php echo $stock_code;?></td>
                            <td><?php echo $stock_name;?></td>
                            <td><?php echo $inventory->get_count($stock_code);?></td>
                            <td><?php echo $quantity;?></td>
                            <td><?php echo $inventory->get_count($stock_code);?></td>
                            <td><?php echo $RCS_date;?></td>
                            </tr>
                            <?php 
                                }
                            }else{
                                echo "NO DATA";
                            }}}
                            ?>

                        </table>

                    </td>

                </form>
                
            </tr>

        </table>

    </body>

</html>