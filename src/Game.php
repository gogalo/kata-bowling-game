<?php


namespace App;


class Game
{
    const NUMBER_OF_FRAMES = 10;

    const TOTAL_PINS = 10;

    private array $rolls;

    public function __construct()
    {
        $this->rolls = [];
    }

    public function roll($pins)
    {
        array_push($this->rolls, $pins);
    }

    public function score()
    {
        $score = 0;
        $roleIndex = 0;

        for ($frameIndex = 0; $frameIndex < self::NUMBER_OF_FRAMES; $frameIndex++) {
            $score += $this->getFrameScore($roleIndex);

            if ($this->rolls[$roleIndex] == 10) {
                $roleIndex += 1;
            } else {
                $roleIndex += 2;
            }
        }

        return $score;
    }

    private function getFrameScore(int $roleIndex)
    {
        if ($this->rolls[$roleIndex] == 10) {
            return $this->rolls[$roleIndex] + $this->rolls[$roleIndex + 1] + $this->rolls[$roleIndex + 2];
        }

        $frameScore = $this->rolls[$roleIndex] + $this->rolls[$roleIndex + 1];

        if ($this->isSpare($frameScore)) {
            $frameScore += $this->rolls[$roleIndex + 2];
        }

        return $frameScore;
    }

    private function isSpare($frameScore)
    {
        return $frameScore == self::TOTAL_PINS;
    }
}