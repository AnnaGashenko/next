<h1>Калькулятор!</h1>
<form action="" method="post">
  <?php if(!empty($result)) { ?>
    <h2>Результат вычислений: <?php echo $_POST['num1'].$_POST['action'].$_POST['num2'].' = '.$result; ?></h2>
  <?php } ?>
  NUM1 <input type="text" name="num1"><br> 
  NUM2 <input type="text" name="num2"><br> 
  ACTION <input type="text" name="action"><br>
  <input type="submit" name="submit" value="Считать на калькуляторе"> 
</form>