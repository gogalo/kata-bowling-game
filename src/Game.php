<?php


namespace App;


class Game
{
    const NUMBER_OF_FRAMES = 10;

    const TOTAL_PINS = 10;

    private array $rolls;
    private int $score;
    private int $rollIndex;

    public function __construct()
    {
        $this->rolls = [];
        $this->score = 0;
        $this->rollIndex = 0;
    }

    public function roll($pins)
    {
        array_push($this->rolls, $pins);
    }

    public function score()
    {
        for ($frameIndex = 1; $frameIndex <= self::NUMBER_OF_FRAMES; $frameIndex++) {
            $this->score += $this->calculateFrameScore();
            $this->goToNextFrame();
        }

        return $this->score;
    }

    private function calculateFrameScore()
    {
        if ($this->isStrike()) {
            return $this->strikeBonus();
        }

        if ($this->isSpare()) {
            return $this->spareBonus();
        }

        return $this->frameScore();
    }

    private function isStrike()
    {
        return $this->getTheScoreOfTheFirstRollOfTheFrame() == self::TOTAL_PINS;
    }

    private function strikeBonus()
    {
        return self::TOTAL_PINS + $this->getTheScoreOfTheNextFrame();
    }

    private function isSpare()
    {
        return $this->frameScore() == self::TOTAL_PINS;
    }

    private function spareBonus()
    {
        return self::TOTAL_PINS + $this->getTheScoreOfTheFirstRollOfNextFrame();
    }

    private function frameScore()
    {
        return $this->getTheScoreOfTheFirstRollOfTheFrame() + $this->getTheScoreOfTheSecondRollOfTheFrame();
    }

    private function getTheScoreOfTheFirstRollOfTheFrame()
    {
        return $this->rolls[$this->rollIndex];
    }

    private function getTheScoreOfTheSecondRollOfTheFrame()
    {
        return $this->rolls[$this->rollIndex + 1];
    }

    private function getTheScoreOfTheNextFrame()
    {
        return $this->rolls[$this->rollIndex + 1] + $this->rolls[$this->rollIndex + 2];
    }

    private function getTheScoreOfTheFirstRollOfNextFrame()
    {
        return $this->rolls[$this->rollIndex + 2];
    }

    private function goToNextFrame()
    {
        if ($this->isStrike()) {
            $this->rollIndex++;
            return;
        }

        $this->rollIndex += 2;
    }

}