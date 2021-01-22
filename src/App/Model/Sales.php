<?php

namespace TaskApp\App\Model;

use TaskApp\Database\QueryBuilder;
use TaskApp\Helpers;

class Sales extends QueryBuilder
{
    /**
     * @var string
     */
    public string $table = 'sales';

    /**
     * Sales constructor.
     * @param $pdo
     */
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->createTable();
    }

    /**
     * @param string $csvName
     */
    public function loadCSV(string $csvName): void
    {
        $this->insertToTable(
            Helpers::parseCsv($csvName)
        );
    }

    /**
     * @param array $data
     */
    private function insertToTable(array $data)
    {
        foreach ($data as $chunk) {
            $this->insert([
                'id' => $chunk[0],
                'name' => $chunk[1],
                'start_date' => strtotime(date('Y-m-d', strtotime($chunk[2]))),
                'end_date' => strtotime(date('Y-m-d', strtotime($chunk[3]))),
                'status' => $chunk[4]
            ]);
        }
    }

    /**
     * Достаем рандомную запись
     * меняем статус по условию
     * @return array
     */
    public function random(): array
    {
        $sale = $this->selectRandom();
        $sale['status'] = ($sale['status'] === 'Off') ? 'On' : 'Off';
        return ['content' => $sale];
    }

    /**
     * Достаем весь список записей
     * и присваиваем slug
     * @return array
     */
    public function list(): array
    {
        return ['content' => Helpers::slug($this->all())];
    }

    /**
     * Достаем все записи
     * только с name и slug
     * @return array
     */
    public function links(): array
    {
        return ['content' => Helpers::slug($this->field('name'))];
    }

    /**
     * Достаем определенную запись по id
     * @param $id
     * @return array
     */
    public function show($id)
    {
        return ['content' => $this->find($id)];
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return ['deleted' => $this->delete($id)];
    }
}
