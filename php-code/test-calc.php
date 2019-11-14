<head>
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
        .err-messg {
            color: red;
        }
    </style>
</head>
<body>
    
<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
<table class = "main_tbl">
    <thead>
        <tr><th>one</th><th>two</th><th>three</th><th>four</th></tr>
    </thead>
    <tbody>
<?php
    $rows = 5;
    $cols = 4;
    $arr = array_fill(0, $rows*$cols, 0);
    $err_messg = "";
    $res_err = "disabled";
    $data_err = "";

    function fields_validate($data){
        $data = htmlspecialchars($data);
        if (is_numeric($data)){
            return true;
        }
        return false;
    }

    
    
    if(isset($_POST['compute'])){
        
        for ($i=0; $i <$rows*$cols; $i++) { 
            $myin = $_POST['myin'.$i];
            $math_act = $_POST['math_act'.$i];
            $res = $_POST['res'.$i];
            
            if(!fields_validate($myin)){
                $myin = 0;
                $err_messg = "not valid data enter correct data";

            }
            if(!fields_validate($res)){
                $err_messg = "not valid data check fields";
                $arr[$i] = 0;
            }
            
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

echo '<p><span class="err-messg">'.$err_messg.'</span></p>';
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
            <input type="number" placeholder="0" step="0.00001" name="myin'.$counter.'" value="0">
            </td>';
            $counter++;
    }
            echo "</tr>";
}
?>

</tbody>
</table>
<input type="submit" name="compute" value="compute">
<input type="submit" name="reset" value="reset">
</form>
</body>

