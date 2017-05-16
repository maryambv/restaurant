<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $this->visit('/admin/foods/create')
            ->type('test', 'name')
            ->type('100', 'price')
            ->type('1', 'category_id')
            ->press('Create Food')
            ->seePageIs('/admin/foods');

        $this->visit('/admin/foods/34/edit')
            ->type('editTest', 'name')
            ->type('100', 'price')
            ->type('3', 'category_id')
            ->press('Edit Food')
            ->seePageIs('/admin/foods');

        $this->visit('/admin/foods/36/edit')
            ->press('Delete Food')
            ->seePageIs('/admin/foods');
    }
}
