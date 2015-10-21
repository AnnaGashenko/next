          <select class="goods_cat" name="cat">
            <option selected="selected" disabled>Выбирите категорию</option>           
            <option value="Холодильники">Холодильники</option>
            <option value="Пылесосы">Пылесосы</option>
            <option value="Телевизоры">Телевизоры</option>
          </select>



          <select class="goods_cat" name="cat">
            <option selected="selected" disabled>Выбирите категорию</option>           
            <option <?php if(isset($_POST['cat']) && $_POST['cat'] == 'Холодильники') echo 'selected="selected"'; ?> value="Холодильники">Холодильники</option>
            <option <?php if(isset($_POST['cat']) && $_POST['cat'] == 'Пылесосы') echo 'selected="selected"'; ?> value="Пылесосы">Пылесосы</option>
            <option <?php if(isset($_POST['cat']) && $_POST['cat'] == 'Телевизоры') echo 'selected="selected"'; ?> value="Телевизоры">Телевизоры</option>
          </select>
        
 echo '<option '.($v == $row['cat'] ? 'selected="selected" ' : '').' value="'.htmlspecialchars($v).'">'.htmlspecialchars($v).'</option>';

 value="<?php echo htmlspecialchars($row['cod']); ?>">
 
         <td><input name="title" type="text" value="<?php 
        if(isset($_POST['edit'])){
        echo htmlspecialchars($_POST['title']);
        } 
        else{ echo htmlspecialchars($row['title']);}
        ?>">
        </td>

