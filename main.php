<?php

interface Animals
{
    public function getProduct(): int;

    public function animalsCount(): int;

    public function getUniqueData(): array;
}

class Farm
{
    protected $cows;
    protected $chickens;
    protected $eggs;
    protected $milk;

    protected function __construct()
    {
        $this->cows = 10;
        $this->chickens = 20;
    }

    protected function getCows(): int
    {
        return $this->cows;
    }

    protected function getChickens(): int
    {
        return $this->chickens;
    }
}

class Cows extends Farm implements Animals
{
    private $cowsIds;

    public function __construct($cows = 0)
    {
        parent::__construct();
        return $this->addCows($cows) + parent::getCows();
    }

    /**
     * @param int $cows
     */
    private function addCows(int $cows)
    {
        $this->cows += $cows;
    }

    /**
     * @return int
     */
    public function getProduct(): int
    {
        for ($i = 0; $i < $this->cows; $i++) {
            try {
                $this->milk += random_int(8, 12);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return $this->milk;
    }

    /**
     * @return int
     */
    public function animalsCount(): int
    {
        return $this->cows;
    }

    /**
     * @return array
     */
    public function getUniqueData(): array
    {
        for ($i = 1; $i <= $this->cows; $i++) { //животных обычно считают с единицы
            try {
                $this->cowsIds[$i] = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return $this->cowsIds;
    }
}

class Chickens extends Farm implements Animals
{
    private $chickensIds;

    public function __construct($chickens = 0)
    {
        parent::__construct();
        return $this->addChickens($chickens) + parent::getChickens();
    }

    /**
     * @param int $chickens
     */
    private function addChickens(int $chickens)
    {
        $this->chickens += $chickens;
    }

    /**
     * @return int
     */
    public function getProduct(): int
    {
        for ($i = 0; $i < $this->chickens; $i++) {
            try {
                $this->eggs += random_int(0, 1);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return $this->eggs;
    }

    /**
     * @return int
     */
    public function animalsCount(): int
    {
        return $this->chickens;
    }

    /**
     * @return array
     */
    public function getUniqueData(): array
    {
        for ($i = 1; $i <= $this->chickens; $i++) {
            try {
                $this->chickensIds[$i] = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return $this->chickensIds;
    }
}


function getFullInfo($cowsCount, $chickensCount, $showUniqueData = 'n')
{
    $cows = new Cows($cowsCount);
    print_r("Количество коров: {$cows->animalsCount()}. Получено молока: {$cows->getProduct()}.\n");

    $chickens = new Chickens($chickensCount);
    print_r("Количество куриц: {$chickens->animalsCount()}. Получено яиц: {$chickens->getProduct()}.\n");

    if ($showUniqueData == 'y') {
        print_r("Уникальные номера коров:\n");
        print_r($cows->getUniqueData());
        print_r("Уникальные номера куриц:\n");
        print_r($chickens->getUniqueData());
    }
}

print_r("Использование: php main.php [cows] [chickens] [y/n] для добавления коров, куриц и вывода уникальных номеров\n\n");
getFullInfo(
    isset($argv[1]) ? $argv[1] : 0,
    isset($argv[2]) ? $argv[2] : 0,
    isset($argv[3]) ? $argv[3] : 'n'
);
