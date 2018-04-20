<?php

declare(strict_types=1);

class Bugs
{
    /**
     * Number of stones
     *
     * @var int
     */
    private $bugs;

    /**
     * Number of bugs
     *
     * @var int
     */
    private $stones;

    /**
     * Bugs constructor.
     *
     * @param int $bugs
     * @param int $stones
     *
     * @throws Exception
     */
    public function __construct(int $bugs, int $stones)
    {
        $this->bugs = $bugs;
        $this->stones = $stones;
        $this->checkValues();

        return $this;
    }

    private function checkValues()
    {
        if ($this->stones < $this->bugs) {
            throw new Exception('Number of stones should not be less then number of bugs');
        }
    }

    /**
     * Return number of stones to left and right of last bug settled
     *
     * @return array
     */
    public function lastBug(): array
    {
        $packs = $this->bugsPacksSettled();

        // get max stone row for current pack
        $maxRow = $this->stonesForPack($packs);

        // calculate stones to left and right for last bug
        $stonesDividedByTwo = ($maxRow - 1) / 2;

        return [
            'stones_left' => ceil($stonesDividedByTwo),
            'stines_right' => floor($stonesDividedByTwo)
        ];
    }

    /**
     * Get number of bugs packs already settled when last bug comes
     *
     * @return int
     */
    private function bugsPacksSettled(): int
    {
        $bugsLeft = $this->bugs - 1;
        $packNumber = 0;

        while ($bugsLeft >= 0) {
            $bagsInCurrentPack = 2 ** $packNumber;
            $bugsLeft -= $bagsInCurrentPack;
            $packNumber++;
        }

        return $packNumber - 1;
    }

    /**
     * get max free stone row for pack
     *
     * @param $packs
     *
     * @return int
     */
    private function stonesForPack($packs): int
    {
        $maxRow = $this->stones;
        for ($i = 1; $i <= $packs; $i++) {
            $maxRow = ceil(($maxRow - 1) / 2);
        }

        return (int)$maxRow;
    }
}