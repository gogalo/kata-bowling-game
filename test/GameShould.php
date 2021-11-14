<?php


namespace App\Test;


use App\Game;
use PHPUnit\Framework\TestCase;

class GameShould extends TestCase
{
    public $game;

    public function setUp(): void
    {
        parent::setUp();
        $this->game = new Game();
    }

    /**
     * @test
     */
    public function create_a_game()
    {
        $this->assertInstanceOf('App\\Game', $this->game);
    }

    /**
     * @test
     */
    public function can_be_rolled()
    {
        $this->assertTrue(method_exists($this->game,'roll'));
    }

    /**
     * @test
     */
    public function can_be_scored()
    {
        $this->assertTrue(method_exists($this->game,'score'));
    }

    /**
     * @test
     */
    public function return_0_for_a_game_of_all_zeros()
    {
        $this->manyRolls(0, 20);
        $this->assertTrue($this->game->score() ===  0);
    }

    /**
     * @test
     */
    public function return_20_for_a_game_of_all_ones()
    {
        $this->manyRolls(1, 20);
        $this->assertThat($this->game->score(), $this->equalTo(20));
    }


    /**
     * @test
     */
    public function return_correct_score_when_frame_is_spare()
    {
        $this->game->roll(1);
        $this->game->roll(9);
        $this->game->roll(1);
        $this->manyRolls(0, 17);
        $this->assertThat($this->game->score(), $this->equalTo(12));
    }

    /**
     * @test
     */
    public function return_correct_score_when_frame_is_strike()
    {
        $this->game->roll(10);
        $this->game->roll(1);
        $this->game->roll(1);
        $this->manyRolls(0, 17);
        $this->assertThat($this->game->score(), $this->equalTo(14));
    }

    /**
     * @test
     */
    public function return_correct_score_when_perfect_game()
    {
        $this->manyRolls(10, 10);
        $this->game->roll(10);
        $this->game->roll(10);

        $this->assertThat($this->game->score(), $this->equalTo(300));
    }

    private function manyRolls($pins, $rolls): void
    {
        for ($i = 1; $i <= $rolls; $i++) {
            $this->game->roll($pins);
        }
    }

}