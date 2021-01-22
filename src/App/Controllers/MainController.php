<?php

namespace TaskApp\App\Controllers;

use TaskApp\App\Model\Sales;
use TaskApp\Helpers;

class MainController
{
    private Sales $sales;

    /**
     * MainController constructor.
     * @param Sales $sales
     */
    public function __construct(Sales $sales)
    {
        $this->sales = $sales;
        // Загружаем csv данные в базу
        $this->sales->loadCSV('data.csv');
    }

    public function getRandom()
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->sales->getResponseMessage(),
                $this->sales->random()
            ), 200
        );
    }

    public function getListSales()
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->sales->getResponseMessage(),
                $this->sales->list()
            ), 200
        );
    }

    public function links()
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->sales->getResponseMessage(),
                $this->sales->links()
            ), 200
        );
    }

    public function getSale(int $id)
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->sales->getResponseMessage(),
                $this->sales->show($id)
            ), 200
        );
    }

    public function delete(int $id = 17)
    {
        echo Helpers::jsonResponse(
            array_merge(
                $this->sales->getResponseMessage(),
                $this->sales->delete($id)
            ), 200
        );
    }
}
