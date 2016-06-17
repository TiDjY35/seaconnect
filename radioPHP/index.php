<?php
include ('functions.inc.php');
?>

<html>
    <head>
        <meta http-equiv="Refresh" content="50; url=index.php">
        <title>Dashboard</title>
        <script language="javascript">
            function confirme(identifiant)
            {
                var confirmation = confirm("Voulez-vous vraiment supprimer cet aquarium ?");
                if (confirmation)
                {
                    document.location.href = "alerte/deletealerte.php?idkeyarduino=" + identifiant;
                }
            }
        </script>
        <script src="js/jquery-2.1.4.min.js"></script>
        <script>
        $(function() {
        $( "#datepicker" ).datepicker();
        });
        </script>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="css/popup.css" />
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all" />
       <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
    </head>
    <body>
        <div style="text-align: center;">
            <h1><span style="font-family: Bell MT;">Dashboard</span></h1>
            <table align="center" style="text-align: center;" border="1"
                   cellpadding="10" cellspacing="2">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; font-family: Fantasy;">Mes Aquariums</td>
                        <td style="vertical-align: top; font-family: Fantasy;">Population</td>
                        <td style="vertical-align: top; font-family: Fantasy;">Dernier contact</td>
                        <td style="vertical-align: top; font-family: Fantasy;">Temp&eacute;rature (&deg;C)</td>
                        <td style="vertical-align: top; font-family: Fantasy;">PH</td>
                        <td style="vertical-align: top; font-family: Fantasy;">EC</td>
                        <td style="vertical-align: top; font-family: Fantasy;">KH</td>
                        <td style="vertical-align: top; font-family: Fantasy;">GH</td>
                    </tr>
                    <tr>
                        <?php
                        table_dashboard();
                        ?>
                    </tr>
                </tbody>
            </table>
            <br>
            <tr><td>
                    <a href=config/index.php>Settings</a> 
                </td></tr> 
        </div>
    </body>
</html>