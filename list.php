<?php
$dir = 'tests';
$tests = scandir($dir);

foreach ($tests as $test){
    if ($test !=='..' and $test!=='.' and $test!=='test.php'){
      
      $testname=json_decode(file_get_contents('http://university.netology.ru/user_data/azaplutakhin/tests/'.urlencode($test)), true);
      $name=$testname['0']['testname'];
      echo "<p><a href='tests/test.php?test=$test'> $name </a></p>";
   }
}
?>