<?php


namespace TaskApp\App\Controllers;

use TaskApp\App\Model\Sales;
use TaskApp\Helpers;

class MainController
{
    /**
     * @param Sales $sales
     * @return string
     */
    public function index(Sales $sales): string
    {
        /* Загружаем csv данные в базу */
        $sales->loadCSV('data.csv');
        /* Выбираем случайную запись и меняем его статус*/
        $random = $sales->random();
        /* Достаем все записи */
        $list = $sales->list();

        return Helpers::view('home.php', compact('random', 'list'));
    }
}
