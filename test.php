<?php 
echo "<p><b>Список тестов:</b></p>";
$dir = 'tests';
$tests = scandir($dir);
foreach ($tests as $test){
    if ($test !=='..' and $test!=='.' and $test!=='test.php'){
       $testname=json_decode(file_get_contents('tests/'.urlencode($test)), true);
       $name=$testname['0']['testname'];
       echo "<p><a href='test.php?test=$test'> $name </a></p>";
}
}
echo '<hr>';
if (!$_GET) exit; 
else{
$test=file_get_contents('tests/'.$_GET["test"]);
$test=json_decode($test,true);
$description=$test['0']['testname'];
echo "<h3>$description:</h3>";
$i=1;
?>
<html lang="ru">
  <head>
    <title>Тесты</title>
    <meta charset="utf-8">
  </head>
<body>

<?php foreach ($test as $points){
$rigthanswers[$i]=$points['answer'];
?>

<form action="" method="POST">
       <fieldset>
         <legend> <?php echo $points['question']; ?> </legend>
         <?php foreach ($points['variants'] as $vars) { ?>
          <label><input required type="radio" name="<?php echo $i; ?>" value="<?php echo $vars; ?>"> <?php echo $vars; ?> </label>
          <?php } $i++; ?>
        </fieldset>
<?php } ?>

<p><input type="submit" value="Отправить"></p>
</form>
</body>
</html>

<?php
$i=1;
if (!empty($_POST)){
   echo "<p><h3>Результат:</h3></p>";
   foreach ($rigthanswers as $right){
   if ($_POST[$i]==$right) echo "<p>Ответ на вопрос $i ($_POST[$i]) верный</p>"; else echo "<p>Ответ на вопрос $i ($_POST[$i]) неверный</p>";
    $i++;
} 
}
}
?>