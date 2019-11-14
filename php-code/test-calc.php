<head>
<style>
        .main-tbl {
            width: 100%;
            border-collapse: collapse;
        }
        .main-tbl td, .main-tbl th {
            border: 1px solid #dddd;
            padding : 5px;
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
<table class = "main-tbl">
    <thead>
        <tr><th>one</th><th>two</th><th>three</th><th>four</th></tr>
    </thead>
    <tbody>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$rows = 4;
$cols = 5;
$arr = array_fill(0, $rows*$cols, 0);
$err_messg = "";
$res_err = "disabled";
$data_err = "";

function fields_validate($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

if(isset($_POST['compute'])){
    
    for ($i=0; $i <$rows*$cols; $i++) { 
        $myin = fields_validate($_POST['myin'.$i]);
        $math_act = fields_validate($_POST['math-act'.$i]);
        $res = fields_validate($_POST['res'.$i]);
        
        if(!is_numeric($myin)){
            $myin = 0;
            $arr[$i] = $res;
            $err_messg = "not valid data enter correct data";
            continue;
        }
        if(!is_numeric($res)){
            $err_messg = "not valid data enter correct data";
            $arr[$i] = 0;
            continue;
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
                if($myin == 0) {
                    $err_messg = "can not devide by 0";
                break;
                }
                $arr[$i] = $res / $myin;
            break;
            case 'miss':
                $arr[$i] = $res;    
            break;
            default:
                $err_messg = "not valid action check fields"; 
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
        <select class="math-act" name="math-act'.$counter.'">
            <option selected value="miss">action</option>
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