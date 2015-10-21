1. Добавить пользователя:
1)
    INSERT INTO `users`SET
    `login` = 'Петрович'

2)
    INSERT INTO `users` SET 
    `login` = ' Yamamoto',
    `age` = 10

3)
    INSERT INTO `users` SET 
    `login` = 'inpost',
    `age` = 2,
    `password` = '123',
    `email` = 'inpost@list.ru'

4)
    INSERT INTO `users` SET 
    `login` = 'milko',
    `age` = 22,
    `password` = '678',
    `email` = 'milko@mail.ru'

5)
    INSERT INTO `users` SET 
    `login` = 'gann',
    `age` = 36,
    `password` = 'dfhfg23',
    `email` = 'gann@mail.ru'

6)
    INSERT INTO `users` SET 
    `login` = 'lewiy',
    `age` = 40,
    `password` = 'hugooguh',
    `email` = 'lewiy@mail.ru'

7)
    INSERT INTO `users` SET 
    `login` = 'boss',
    `age` = 33

8)
    INSERT INTO `users` SET 
    `login` = 'jim',
    `age` = 25

9)
    INSERT INTO `users` SET 
    `login` = 'VelsoN  ',
    `age` = 21

10)
    INSERT INTO `users` SET 
    `login` = 'Kvinto ',
    `age` = 28

11)
    INSERT INTO `users` SET 
    `login` = 'waldicom',
    `age` = 30

12)
    INSERT INTO `users` SET 
    `login` = 'smrweb',
    `age` = 34

13)
    INSERT INTO `users` SET 
    `login` = 'Romm',
    `age` = 39

2. Отредактировать пользователя:
    1) Yamamoto => возраст исправить на 9 лет
    UPDATE `users` SET
    `age` = 9
    WHERE `id` = 5

3. Удалить данные:
    1) Удалить Петровича
    DELETE FROM `users`
    WHERE `id` = 4

4. Выбрать данные:
    1) Выбрать всех пользователей в возрасте от 20 до 25 лет и отсортировать по позрасту DESC (в обратном порядке)
    SELECT *
    FROM `users`
    WHERE `age` >=20 AND `age` <=25
    ORDER BY `age` DESC
    
    2) Выбрать пользователя inpost
    SELECT *
    FROM `users`
    WHERE `login` = 'inpost'
    
    4) Выбрать 4 пользователей.
    SELECT *
    FROM `users`
    LIMIT 4
    
    SELECT *
    FROM `users`
    LIMIT 1,2
