<?php

    class Utility
    {
        public function produceErrorMsg($msg)
        {
            echo "<div class='error'>";
            echo "<p>".$msg."</p>";
            echo "</div>";
        }

        public function produceSuccessMsg($msg)
        {
            echo "<div class='success'>";
            echo "<p>".$msg."</p>";
            echo "</div>";
        }

        public function produceErrors($title,$errors)
        {
            echo "<div class='error'>";
            echo "<h3>".$title."</h3>";
            foreach($errors as $error):
                echo "<p>".$error."</p>";
            endforeach;
            echo "</div>";
        }

        public function produceWarning($msg)
        {
            echo "<div class='warning'>";
            echo "<p>".$msg."</p>";
            echo "</div>";
        }

        public function createTable($rows,$headers)
        {
            if($rows !== null && $headers !== null):
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                    foreach($headers as $header):
                        echo "<th>".$header."</th>";
                    endforeach;
                echo "</tr>";
                
                    foreach($rows as $row):
                        echo "<tr>";
                        foreach($row as $key => $value):
                            echo "<td>".$value."</td>";
                        endforeach;
                        echo "</tr>";
                    endforeach;
                    
                echo "</table>";
            endif;
        }
    }

?>