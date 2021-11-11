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
        for ($i = 0; $i < 20; $i++) {
            $this->game->roll(0);
        }

        $this->assertTrue($this->game->score() ===  0);
    }

    /**
     * @test
     */
    public function return_20_for_a_game_of_all_ones()
    {
        for ($i = 0; $i < 20; $i++) {
            $this->game->roll(1);
        }

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

        for ($i = 0; $i < 18; $i++) {
            $this->game->roll(0);
        }

        $this->assertThat($this->game->score(), $this->equalTo(12));
    }

}