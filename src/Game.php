<?php


namespace App;


class Game
{
    private $rolls;

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

        for ($frameIndex = 0; $frameIndex < 10; $frameIndex++) {
            $frameScore = $this->rolls[$roleIndex] + $this->rolls[$roleIndex + 1];

            // spare
            if ($frameScore == 10) {
                $frameScore += $this->rolls[$roleIndex + 2];
            }

            $score += $frameScore;
            $roleIndex += 2;
        }

        return $score;
    }
}