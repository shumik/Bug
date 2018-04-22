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

    private $bugsInPack;
    private $maxBugsInPack;
    private $minRow;
    private $bugsInPrevPacks;

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
        $this->bugs = $bugs - 1;
        $this->stones = $stones;
        $this->checkValues();

        return $this;
    }

    /**
     * Return number of stones to left and right of last bug settled
     *
     * @return array
     */
    public function lastBug(): array
    {
        $this->calculate();

        // get max stone row
        $maxRowLeft = $this->maxRowLeft();

        // calculate stones to left and right for last bug
        $rowDividedByTwo = ($maxRowLeft - 1) / 2;

        return [
            'stones_left' => ceil($rowDividedByTwo),
            'stones_right' => floor($rowDividedByTwo)
        ];
    }

    /**
     * Check input values
     *
     * @throws Exception
     */
    private function checkValues()
    {
        if ($this->stones < $this->bugs + 1) {
            throw new Exception('Number of stones should not be less then number of bugs');
        }
    }

    /**
     * Prepare all needed data
     *
     */
    private function calculate()
    {
        $packsSettled = (int)floor(log($this->bugs + 1, 2));
        $this->bugsInPrevPacks = (2 ** $packsSettled) - 1;
        $this->maxBugsInPack = 2 ** $packsSettled;
        $this->bugsInPack = $this->bugs - $this->bugsInPrevPacks;
        $this->minRow = $this->getMinRow();
    }

    /**
     * get min free stone row for pack
     *
     * @return int
     */
    private function getMinRow(): int
    {
        $bugs = $this->bugsInPrevPacks;
        $rows = $bugs + 1;
        $minRow = floor(($this->stones - $bugs) / $rows);

        return (int)$minRow;
    }

    /**
     * Return length of max row left
     *
     * @return int
     */
    private function maxRowLeft()
    {
        return $this->bugsInPack >= $this->maxRowsCount() ? $this->minRow : $this->minRow + 1;
    }

    /**
     * Return number of rows of maximum length for current pack
     *
     * @return int
     */
    private function maxRowsCount()
    {
        return ($this->stones - $this->bugsInPrevPacks) % $this->maxBugsInPack;
    }
}