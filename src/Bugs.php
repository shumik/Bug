<?php


class Bugs
{
    /**
     * @var int
     */
    private $bugs;
    private $stones;

    public function __construct($bugs, $stones)
    {
        $this->bugs = $bugs;
        $this->stones = $stones;

        return $this;
    }

    public function lastBug()
    {
        // get number of bugs packs already settled
        $packs = $this->bagsPacksSettled();

        // get max stone row for current pack
        $maxRow = $this->stonesForPack($packs);

        // calculate stones to left and right for last bug
        $stonesDividedByTwo = ($maxRow -1) / 2;

        return [
            'stones_left' => ceil($stonesDividedByTwo),
            'stines_right' => floor($stonesDividedByTwo)
        ];
    }

    private function bagsPacksSettled()
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

    private function stonesForPack($packs)
    {
        $maxRow = $this->stones;
        for ($i = 1; $i <= $packs; $i++) {
            $maxRow = ceil(($maxRow - 1) / 2);
        }

        return $maxRow;
    }
}