<?php

$bom = pack('H*','EFBBBF');

var_dump($bom);
$sample = "sample";

$withbom = $sample.$bom;
echo bin2hex($withbom);

$ascii_char = array();
echo "\n";

for ($i = 0; $i < strlen($sample); $i++){
    $ord_char = ord($sample[$i]);
    $ascii_char[] = $ord_char;
    echo dechex($ord_char);
}

var_dump($ascii_char);

echo "ascii to chr:\n";
foreach($ascii_char as $c){
    echo chr($c)."\n";
}
echo "\nend ascii to chr\n";

echo "replacing bom\n";
$removedbom = preg_replace("/$bom/",'',$withbom);
for($i = 0;$i < strlen($removedbom);$i++){
    echo dechex(ord($removedbom[$i]));
}
echo "\nbom replaced\n";
function hex_dump($data, $newline="\n")
{
  static $from = '';
  static $to = '';

  static $width = 16; # number of bytes per line

  static $pad = '.'; # padding for non-visible characters

  if ($from==='')
  {
    for ($i=0; $i<=0xFF; $i++)
    {
      $from .= chr($i);
      $to .= ($i >= 0x20 && $i <= 0x7E) ? chr($i) : $pad;
    }
  }

  $hex = str_split(bin2hex($data), $width*2);
  $chars = str_split(strtr($data, $from, $to), $width);

  $offset = 0;
  foreach ($hex as $i => $line)
  {
    echo sprintf('%6X',$offset).' : '.implode(' ', str_split($line,2)) . ' [' . $chars[$i] . ']' . $newline;
    $offset += $width;
  }
}
echo "\n";
hex_dump($withbom);
