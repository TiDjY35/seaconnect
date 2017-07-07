<form action="addalerte.php" method="POST">
                <table border="0" align="center" cellspacing="2" cellpadding="2">
                    <tr align="center">
                        <td>Id Arduino</td>
                        <td><input type="text" placeholder="idkeyarduino" name="idkeyarduino"></td>
                    </tr>
                    <tr align="center">
                        <td>Name Aquarium</td>
                        <td><input type="text"  placeholder="nameaquarium" name="nameaquarium"></td>
                    </tr>
                    <tr align="center">
                        <td>Date de mise en route</td>
                        <td><input type="date" placeholder="datelaunch" name="datelaunch" ></td>
                    </tr>
                    <tr align="center">
                        <td>Temperature Min</td>
                        <td><input type="text" placeholder="tempmin" name="tempmin"></td>
                    </tr>
                    <tr align="center">
                        <td>Temperature Max</td>
                        <td><input type="text" placeholder="tempmax" name="tempmax"></td>
                    </tr>
                    <tr align="center">
                        <td>Population</td>
                        <td><input type="text" placeholder="species" name="species"></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><input type="submit" value="Ajouter"></td>
                    </tr>
                </table>
            </form>