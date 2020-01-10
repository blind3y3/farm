<?php

class Farm
{
    private $cows;
    private $chickens;
    private $eggs;
    private $milk;
    private $uniqueData;

    public function __construct()
    {
        $this->cows = 10;
        $this->chickens = 20;
    }

    /**
     * @return array
     */
    private function makeUnique(): array
    {
        for ($i = 0; $i < $this->cows; $i++) {
            try {
                $this->uniqueData['cows'][$i] = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        for ($i = 0; $i < $this->chickens; $i++) {
            try {
                $this->uniqueData['chickens'][$i] = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return $this->uniqueData;
    }

    /**
     * @return array
     */
    private function getUniqueData(): array
    {
        return $this->uniqueData;
    }

    /**
     * @param $cows
     * @param $chickens
     */
    private function addAnimals($cows, $chickens)
    {
        $this->cows += $cows;
        $this->chickens += $chickens;
    }

    /**
     * @return int
     */
    private function getMilk(): int
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
    private function getEggs(): int
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
     * @param int $cows
     * @param int $chickens
     * @param string $showUniqueData
     */
    public function getFullInfo($cows = 0, $chickens = 0, $showUniqueData = 'n')
    {
        $this->addAnimals($cows, $chickens);
        $this->makeUnique();
        print_r("Коров: {$this->cows}, собрано литров молока: {$this->getMilk()}.\n");
        print_r("Куриц: {$this->chickens}, собрано яиц: {$this->getEggs()}.");
        if ($showUniqueData == 'y') {
            print_r("\nУникальные регистрационные номера животных:\n");
            print_r($this->getUniqueData());
        }
    }
}

print_r("Использование: php main.php cows chickens y/n для добавления коров, куриц и вывода уникальных номеров\n\n");
$farm = new Farm();
$farm->getFullInfo(
    isset($argv[1]) ? $argv[1] : 0,
    isset($argv[2]) ? $argv[2] : 0,
    isset($argv[3]) ? $argv[3] : 'n'
);
