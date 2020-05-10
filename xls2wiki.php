<?php header("Content-type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" charset="utf-8">
        function selText()
          {
          document.getElementById("txt1").select()
          }
        </script>

                <style type="text/css">
                body {
                        font: .8em "Trebuchet MS", Verdana, Arial, Sans-Serif;
                        text-align: center;
                        color: #333;
                        background-color: #fff;
                        margin-top: 0em;
                }

                h1 {
                        font-size: 2em;
                        padding: 0;
                        margin: 0;
                }

                h5 {
                        font-size: 1em;
                        color: #09c;
                        font-weight: bold;
                }

                form {
                        background-color: #eee;
                        border: 1px solid #ccc;
                        margin-left: auto;
                        margin-right: auto;
                        padding: 1em;
                }


                a {
                        color: #09c;
                        text-decoration: none;
                        font-weight: bold;
                }


                </style>

</head>
        <?php
                $s = $_POST['s'];
                $fromto = $_POST['fromto'];

                if ($fromto=="E2W"){


                        $s = str_replace("\r\n", " |\n| ", $s);
                        $s = str_replace("\t", " | ", $s);
                        //$s = str_replace("|  |", "| . |", $s);

                        $s = "| ".$s;
                        $s = substr($s,0,-2); //get rid of last newline conversion


                        //explode the source by line
                        $arrayS = preg_split ("/[\n,]+/", $s);
                        $nb_lines = count ($arrayS)-1;
                        $s = $s . $nb_lignes;
                        $s = "";
                        foreach ( $arrayS as $key => $lines ){
                        if ($key == 0) {
                        $lines = str_replace("|", "^", $lines);
                        }//end if
                        $s = $s . $lines .  "\n";
                        }//end for

                        $s = substr($s,0,-2); //get rid of last newline conversion
                }elseif ($fromto=="E2Wnoheader"){
            $s = str_replace("\r\n", " |\n| ", $s);
            $s = str_replace("\t", " | ", $s);
            $s = str_replace("|  |", "|  |", $s);
            $s = str_replace("|  |", "|  |", $s);
            $s = str_replace("|  |", "|  |", $s);
            $s = str_replace("|  |", "|  |", $s);
            $s = "| ".$s;
            $s = substr($s,0,-2); //get rid of last newline conversion
                }else{
            $s = str_replace("^", "|", $s);
            $s = str_replace("|\r\n|", "\r\n", $s);
            $s = str_replace("\r\n ", "\r\n", $s);
            $s = str_replace(" |", "|", $s);
            $s = str_replace("| ", "|", $s);
            $s = str_replace("|", "\t", $s);
            $s = substr($s,1); // get rid of first | without /r/n

                }

        ?>
<body onload="selText()">
<center>
<h5>Excel2DokuWiki converter</h5>

Copy and paste your Excel or Wiki table below and press [Convert!]<br/>
        <form method=POST action="">
                <input type="radio" name="fromto" value="E2W" checked>Excel to DokuWiki(header on first Line)<br>
                <input type="radio" name="fromto" value="E2Wnoheader" checked>Excel to DokuWiki(no header)<br>
                <input type="radio" name="fromto" value="W2E">Wiki to Excel<br>
                <INPUT TYPE=SUBMIT VALUE="Convert!"><br/>
                <textarea id="txt1" name="s" wrap="off" cols=110 rows=20 style="width:400; height:450"><?php echo $s; ?></textarea>
        </form>
<span style="font-size:90%">
<strong>Version 0.2 : </strong>
<ul>
<li>Original from https://www.dokuwiki.org/tips:xls2wiki</li>
<li>Changed by Takaaki Kurihara</li>
</ul>
</span>
</center>
</body></html>