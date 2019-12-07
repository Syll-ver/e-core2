<?php
        $connstr = "dbname=coursereservation user=postgres password=postgres
host=localhost port=5432";
        $dbh = pg_connect($connstr);

        if      ($dbh)
        {
                echo "the connection to the database has been established<br>";
        }
        else
        {
                echo "no connection has been established<br>";
        }
?>
