<?php

namespace TaskApp;

use TaskApp\App\Controllers\MainController;
use TaskApp\App\Model\Sales;
use TaskApp\Database\DB;

class Application
{
    /**
     * @var array
     */
    private array $storage = [];

    /**
     * Запуск приложение
     *
     * @return void
     */
    public function run()
    {
        $this->bindParams();
        $this->callAction(new MainController());
    }

    /**
     * Сохроняем параметры в контейнер
     *
     * @return void
     */
    private function bindParams(): void
    {
        $this->bind('database', require 'configs/database.php');
        $this->bind('sales', new Sales(
            DB::connection($this->getStorage('database'))
        ));
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    private function bind(string $name, $value): void
    {
        $this->storage[$name] = $value;
    }

    /**
     * @param $name
     * @return array|object
     */
    private function getStorage(string $name)
    {
        return $this->storage[$name];
    }

    /**
     * @param MainController $mainController
     * @return string
     */
    private function callAction(MainController $mainController): string
    {
        return $mainController->index(
            $this->getStorage('sales')
        );
    }
}
