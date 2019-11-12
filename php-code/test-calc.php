<style>
        .main_tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .main_tbl td, .main_tbl th {
            border: 1px solid #dddd;
            padding : 5px;
        }
        .main_tbl .num_in {
            padding: 5px;
        }
        .disabled {
            width: 20%;
            background-color: grey;
            color: #fff;
        }
    </style>
</head>
<body>
<form method="post" action="">
<table class = "main_tbl">
    <thead>
        <tr><th>one</th><th>two</th><th>three</th><th>four</th></tr>
    </thead>
    <tbody>
<?php
    $rows = 5;
    $cols = 4;
    $arr = array_fill(0, $rows*$cols, 0);

    if(isset($_POST['compute'])){

        for ($i=0; $i <$rows*$cols; $i++) { 
            $myin = $_POST['myin'.$i];
            $math_act = $_POST['math_act'.$i];
            $res = $_POST['res'.$i];

            switch ($math_act) {
                case 'add':
                    $arr[$i] = $res + $myin;
                    break;
                case 'sub':
                    $arr[$i] = $res - $myin;
                    break;
                case 'mul':
                    $arr[$i] = $res * $myin;
                    break;
                case 'div':
                    $arr[$i] = $res / $myin;
                    break;
                default:
                    $arr[$i] = $res;
                    break;
              }
        }
    }
    if(isset($_POST['reset'])){
        $arr = array_fill(0, $rows*$cols, 0);
    }

    $counter = 0;
    for($i = 0; $i < $rows; $i++) {
        echo "<tr>";
         
        for ($j=0; $j< $cols; $j++) { 
            echo '
            <td>
            <input class="disabled" type="text" name="res'.$counter.'" value="'.$arr[$counter].'">
            <select class="math_act" name="math_act'.$counter.'">
            <option selected disabled>action</option>
            <option value="add">+</option>
            <option value="sub">-</option>
            <option value="mul">*</option>
            <option value="div">/</option>
            </select>
            <input type="number" name="myin'.$counter.'" value="0">
            </td>';
            $counter++;
            }
            echo "</tr>";
        }
    $counter = 0;    
        ?>

</tbody>
</table>
<input type="submit" name="compute" value="compute">
<input type="submit" name="reset" value="reset">
</form>
</body>

