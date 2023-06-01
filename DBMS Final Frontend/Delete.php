<!DOCTYPE html>
<html>

    <head>

        <title> ICEinventory | Delete Records </title>

        <link rel = "stylesheet" href = "Style6.css">

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
                    
                    <p> Delete Records </p>

                </td>

            </tr>

            <!-- INPUT FORM -->
            
            <tr>

                <form action = "#" method = "GET">

                    <td class = "Data_Form"> 

                        <div class = "Container">

                            <!-- HEADER -->
                            <p class = "Container2"> Delete Stock </p>

                            <!-- CODE -->
                            
                            <label for = "code"> <p> Code </p></label>
                            <input type = "text" name = "code" required>

                            <!-- DELETE BUTTON -->
                            <input type = "submit" value = "Delete">

                            <!-- SPACE -->

                            <!-- HEADER -->
                            <p class = "Container2"> Delete Receiving Data </p>

                            <!-- RCS NUMBER -->
                            <label for = "code"> <p> RCS Number </p></label>
                            <input type = "text" name = "code" required>

                            <!-- DELETE BUTTON -->
                            <input type = "submit" value = "Delete">

                            <!-- SPACE -->

                            <!-- HEADER -->
                            <p class = "Container2"> Delete Releasing Data </p>

                            <!-- RLS NUMBER -->
                            <label for = "code"> <p> RLS Number </p></label>
                            <input type = "text" name = "code" required>

                            <!-- DELETE BUTTON -->
                            <input type = "submit" value = "Delete">

                        </div>
        
                    </td>

                </form>
                
            </tr>

        </table>

    </body>

</html>