<!DOCTYPE html>
<html>

    <head>
    <?php
    include 'releasing-class.php';
    include 'stock-class.php';
    ?>

        <title> ICEinventory | Releasing </title>

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
                        <a href = "Delete.php"> <li> Delete Record </li> </a>

                    </ul>

                </td>
               
            </tr>

            <!-- DIRECTORY -->

            <tr>

                <td class = "Directory">
                    
                    <p> Releasing Stock </p>

                </td>

            </tr>

            <!-- INPUT FORM -->
            
            <tr>

                <form action = "#" method = "GET">

                    <td class = "Data_Form">

                        <table class = "Data_Table">

                            <!-- TABLE HEADER -->

                            <tr class = "Table_Header">

                                <td> RLS Number </td>
                                <td> Supplier Name </td>
                                <td> Supplier Address </td>
                                <td> Stock Code </td>
                                <td> Stock Name </td>
                                <td> Current Stock </td>
                                <td> Quantity (-) </td>
                                <td> New Count </td>
                                <td> RLS Date </td>
    
                            </tr>
                            <?php
                    $rls = new releasing();
                    $inventory = new inventory();

                    if ($rls->list_releasing() != false) {
                        foreach ($rls->list_releasing() as $value) {
                            extract($value);
                            ?>

                            <tr>
                                <td><?php echo "RLS" . $rls_id; ?></td>
                                <td><?php echo $supplier_name; ?></td>
                                <td><?php echo $supplier_address; ?></td>
                                <td><?php echo $stock_code; ?></td>
                                <td><?php echo $inventory->get_name($stock_code); ?></td>
                                <td><?php echo $inventory->get_count($stock_code) + $rls_qty; ?></td>
                                <td><?php echo $rls_qty; ?></td>
                                <td><?php echo $inventory->get_count($stock_code); ?></td>
                                <td><?php echo $rls_date; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>NO DATA</td></tr>";
                    }
                    ?>


                        </table>

                    </td>

                </form>
                
            </tr>

        </table>

    </body>

</html>