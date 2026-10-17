<?php

namespace App\Enums;

enum RealtyService: string
{
    case BUY_SELL = 'Купівля та продаж квартир у новобудовах';
    case RENT = 'Оренда житлової та комерційної нерухомості';
    case LEGAL_SUPPORT = 'Юридичний супровід та перевірка документів';
    case VALUATION = 'Оцінка ринкової вартості об’єктів';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}