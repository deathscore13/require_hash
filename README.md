# require_hash
### Безопасное подключение зависимостей для PHP 8.0.0+<br><br>

**Библиотеку можно подключать в одном проекте несколько раз**<br><br>
Содержит процедуры `require_hash()` (аналог `require_once()`) и `include_hash()` (аналог `include_once()`)

<br><br>
## Пример использования
**test.php**:
```php
// допустим, подключаемому файлу он тоже нужен
require('require_hash/require_hash.php');

class BaseClass
{
}

// возвращаемое значение из файла
return 123;
```
**test2.php**:
```php
// допустим, подключаемому файлу он тоже нужен
require('require_hash/require_hash.php');

class BaseClass
{
}

// возвращаемое значение из файла
return 123;
```
**main.php**:
```php
// подключение require_hash
require('require_hash/require_hash.php');

// повторное подключение require_hash.php не вызовет ошибку и выведет 123
echo(require_hash('test.php').PHP_EOL);

// выведет 1 (true), так как файл с таким содержанием уже подключен
echo(require_hash('test2.php').PHP_EOL);

// оператор @ подавит предупреждение и выведет 0 (false), так как файла не существует
echo((@include_hash('test3.php') ? 1 : 0).PHP_EOL);
```
