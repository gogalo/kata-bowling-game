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

}