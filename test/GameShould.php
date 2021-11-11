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

}