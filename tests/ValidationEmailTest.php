<?php

use \Raisins\Validation;
use PHPUnit\Framework\TestCase;

class ValidationEmailTest extends TestCase
{
    /**
     * \Raisins\Validation
     *
     * @var \Raisins\Validation
     */
    private $validation;

    /**
     * setup
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->validation = new Validation;
    }

    /**
     * Test Email
     *
     * @dataProvider emailProvider
     */
    public function testEmail($value, $expected)
    {
        $this->validation
            ->name("email")
            ->value($value)
            ->pattern('email')
            ->required();

        $this->assertEquals($expected, $this->validation->isSuccess());
    }

    /**
     * Test Email
     *
     * @dataProvider emailMinLength14Provider
     */
    public function testMinLength14Email($value, $expected)
    {
        $this->validation
            ->name("email")
            ->value($value)
            ->pattern('email')
            ->min(14)
            ->required();

        $this->assertEquals($expected, $this->validation->isSuccess());
    }

    /**
     * Test Email
     *
     * @dataProvider emailMaxLength21Provider
     */
    public function testMaxLength21Email($value, $expected)
    {
        $this->validation
            ->name("email")
            ->value($value)
            ->pattern('email')
            ->max(21)
            ->required();

        $this->assertEquals($expected, $this->validation->isSuccess());
    }

    public function testEmailRequiredErrorMsg()
    {
        $value = null;

        $name = "email";
        $expected = "Схоже ти забув що поле {$name} є обов'язковим.";

        $this->validation->setErrMsg([
            "required" => "Схоже ти забув що поле {name} є обов'язковим."
        ]);

        $this->validation->name($name)->value($value)
            ->required();

        $actual = $this->validation->getErrors();

        $this->assertEquals($expected, $actual[$name][0]);
    }

    public function testEmailInvalidErrorMsg()
    {
        $value = "invalid#email.com";

        $name = "email";
        $expected = "Поле {$name} інвалід.";

        $this->validation->setErrMsg([
            "pattern" => "Поле {name} інвалід."
        ]);

        $this->validation->name($name)->value($value)
            ->pattern('email');

        $actual = $this->validation->getErrors();

        $this->assertEquals($expected, $actual[$name][0]);
    }

    public function emailProvider()
    {
        return [
            ["rodzyk@programmer.net", true],
            ["rodzyk@program", false],
            ["rodzyk@programmer.1234", false],
            ["rodzyk@programmer.net.", false],
            ["rodzyk#programmer.net", false],
            [null, false],
            ["rodzyk@usa.com", true],
            ["", false]
        ];
    }

    public function emailMaxLength21Provider()
    {
        return [
            ["rodzyk@programmer.net", true],
            ["rodzyk@usa.com", true],
            ["rodzyk@programmer.com.ua", false],
            ["rodzyk@super.mega.long.domein.com.ua", false]
        ];
    }
    public function emailMinLength14Provider()
    {
        return [
            ["rodzyk@programmer.net", true],
            ["rodzyk@usa.com", true],
            ["rodzy@usa.ua", false],
        ];
    }
}
