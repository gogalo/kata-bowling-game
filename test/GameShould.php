<?php


namespace App\Test;


use App\Game;
use PHPUnit\Framework\TestCase;

class GameShould extends TestCase
{
    /**
     * @test
     */
    public function create_a_game()
    {
        $game = new Game();
        $this->assertInstanceOf('App\\Game', $game);
    }

    /**
     * @test
     */
    public function can_be_rolled()
    {
        $game = new Game();
        $this->assertTrue(method_exists($game,'roll'));
    }

    /**
     * @test
     */
    public function can_be_scored()
    {
        $game = new Game();
        $this->assertTrue(method_exists($game,'score'));
    }

}