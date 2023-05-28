<?php

/**
 * require_hash
 * 
 * Безопасное подключение зависимостей для PHP 8.0.0+
 * https://github.com/deathscore13/require_hash
 */

if (defined('DEATHSCORE13_REQUIRE_HASH'))
    return;

const DEATHSCORE13_REQUIRE_HASH = true;

/**
 * Аналог require_once, но не подключает файл с одинаковым содержанием
 * 
 * @param string $file      Путь к файлу
 * 
 * @return mixed            Возвращаемое значение из файла или true если уже подключен
 */
function require_hash(string $file): mixed
{
    static $data = [];
    
    if (!is_file($file))
        throw new Exception('Failed opening required \''.$file.'\' (include_path=\''.get_include_path().'\')');
    
    $hash = hash_file('md5', $file);
    
    if (in_array($hash, $data))
        return true;
    
    $data[] = $hash; 
    return require($file);
}

/**
 * Аналог include_once, но не подключает файл с одинаковым содержанием
 * 
 * @param string $file      Путь к файлу
 * 
 * @return mixed            Возвращаемое значение из файла, true если уже подключен или false если файл не найден
 */
function include_hash(string $file): mixed
{
    static $data = [];
    
    if (!is_file($file))
    {
        trigger_error('Failed opening \''.$file.'\' for inclusion (include_path=\''.get_include_path().'\')', E_USER_WARNING);
        return false;
    }
    
    $hash = hash_file('md5', $file);
    
    if (in_array($hash, $data))
        return true;
    
    $data[] = $hash; 
    return require($file);
}
