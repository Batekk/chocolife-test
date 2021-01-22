<?php

namespace TaskApp;

use TaskApp\App\Model\Sales;
use TaskApp\Database\DB;

class Application
{
    /**
     * @var array
     */
    private array $storage = [];

    /**
     * Запуск нашего приложения
     *
     * @return void
     */
    public function run()
    {
        $this->bindParams();
        $this->callAction(new Router());
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
    public function getStorage(string $name)
    {
        return $this->storage[$name];
    }

    /**
     * @param Router $router
     * @return string
     */
    private function callAction(Router $router)
    {
        $router->load($this);
    }
}
