<?php
if(isset($_SESSION['client'],$_SESSION['server'])) { ?>
    <div  class="form-container">
        <div class="form-title"><h2>
        <?php
            echo $_SESSION['client'].':'.$_SESSION['server'];
            unset($_SESSION['client'],$_SESSION['server']);
            echo '<br> Вы выиграили у сервера!';
        ?>
        </h2></div>
    </div>
<?php } ?>