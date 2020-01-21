<?php

interface Collector
{
    public function getProduct(): int;
}

class Cows
{
    const COWS_START_COUNT = 10;
    protected $cows;
    private $cowsIds;

    public function addAnimals($count)
    {
        $this->cows = $count + self::COWS_START_COUNT;
    }

    public function animalsCount(): int
    {
        if (isset($this->cows)) {
            return $this->cows;
        } else {
            $this->cows = self::COWS_START_COUNT;
            return $this->cows;
        }
    }

    public function getUniqueData(): array
    {
        for ($i = 1; $i <= $this->cows; $i++) {
            try {
                $this->cowsIds[$i] = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return $this->cowsIds;
    }
}

class MilkCollector extends Cows implements Collector
{
    private $milk;

    public function __construct($cowsCount)
    {
        $this->cows = $cowsCount;
    }

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
}

class Chickens
{
    const CHICKENS_START_COUNT = 20;
    protected $chickens;
    private $chickensIds;

    public function addAnimals($count)
    {
        $this->chickens = $count + self::CHICKENS_START_COUNT;
    }

    public function animalsCount(): int
    {
        if (isset($this->chickens)) {
            return $this->chickens;
        } else {
            $this->chickens = self::CHICKENS_START_COUNT;
            return $this->chickens;
        }
    }

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

class EggsCollector extends Chickens implements Collector
{
    private $eggs;

    public function __construct($chickensCount)
    {
        $this->chickens = $chickensCount;
    }

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
}

function getFullInfo($cowsCount, $chickensCount, $showUniqueData = 'n')
{
    $cows = new Cows();
    $cows->addAnimals($cowsCount);
    $milk = new MilkCollector($cows->animalsCount());
    print_r("Количество коров: {$cows->animalsCount()}. Получено молока: {$milk->getProduct()}.\n");

    $chickens = new Chickens();
    $chickens->addAnimals($chickensCount);
    $eggs = new EggsCollector($chickens->animalsCount());
    print_r("Количество куриц: {$chickens->animalsCount()}. Получено яиц: {$eggs->getProduct()}.\n");

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