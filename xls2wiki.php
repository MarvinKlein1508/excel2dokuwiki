<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">

<head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Excel2DokuWiki converter</title>
</head>
<?php
$s = $_POST['s'] ?? null;
$fromto = $_POST['fromto'] ?? null;

if ($fromto == "E2W") {


        $s = str_replace("\r\n", " |\n| ", $s);
        $s = str_replace("\t", " | ", $s);


        $s = "| " . $s;
        $s = substr($s, 0, -2); //get rid of last newline conversion


        //explode the source by line
        $arrayS = preg_split("/[\n]+/", $s);
        $nb_lines = count($arrayS) - 1;
        
        $s = $s . $nb_lines;
        $s = "";
        foreach ($arrayS as $key => $lines) {
                if ($key == 0) {
                        $lines = str_replace("|", "^", $lines);
                } //end if
                $s = $s . $lines . "\n";
        } //end for

        $s = substr($s, 0, -2); //get rid of last newline conversion
} elseif ($fromto == "E2Wnoheader") {
        $s = str_replace("\r\n", " |\n| ", $s);
        $s = str_replace("\t", " | ", $s);
        $s = str_replace("|  |", "|  |", $s);
        $s = str_replace("|  |", "|  |", $s);
        $s = str_replace("|  |", "|  |", $s);
        $s = str_replace("|  |", "|  |", $s);
        $s = "| " . $s;
        $s = substr($s, 0, -2); //get rid of last newline conversion
} else {
        $s = str_replace("^", "|", $s);
        $s = str_replace("|\r\n|", "\r\n", $s);
        $s = str_replace("\r\n ", "\r\n", $s);
        $s = str_replace(" |", "|", $s);
        $s = str_replace("| ", "|", $s);
        $s = str_replace("|", "\t", $s);
        $s = substr($s, 1); // get rid of first | without /r/n

}

?>

<body>
        <h5>Excel2DokuWiki converter</h5>
        <p>Copy and paste your Excel or Wiki table below and press [Convert!]</p>
        <form method="POST">

                <fieldset>
                        <legend>Select a converting mode:</legend>

                        <div>
                                <input type="radio" id="E2W" name="fromto" value="E2W" <?php if($fromto == null || $fromto == "E2W") echo "checked"; ?>>
                                <label for="E2W">Excel to DokuWiki(header on first Line)</label>
                        </div>

                        <div>
                                <input type="radio" id="E2Wnoheader" name="fromto" value="E2Wnoheader" <?php if($fromto == "E2Wnoheader") echo "checked"; ?>>
                                <label for="E2Wnoheader">Excel to DokuWiki(no header)</label>
                        </div>

                        <div>
                                <input type="radio" id="W2E" name="fromto" value="W2E" <?php if($fromto == "W2E") echo "checked"; ?>>
                                <label for="W2E">Wiki to Excel</label>
                        </div>
                </fieldset>

                <button type="submit">Convert!</button>
                <textarea id="txt1" name="s" wrap="off" cols="110" rows="20"><?php echo $s; ?></textarea>
        </form>
        <span style="font-size:90%">
                <strong>Version 1.0: </strong>
                <ul>
                        <li>Original from https://www.dokuwiki.org/tips:xls2wiki</li>
                        <li>Changed by Marvin Klein</li>
                </ul>
        </span>

</body>

</html>