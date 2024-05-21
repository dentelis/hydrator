<?php
declare(strict_types=1);

namespace tests\unit\Factory\Datetime;

use DateTime;
use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use Dentelis\Hydrator\Factory\HydratorFactoryTraitInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\Datetime\Objects\HydratorDatetimeWithConstructor;


#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class DTOFactoryDatetimeTest extends TestCase
{

    public static function datetimeProvider(): array
    {
        return [
            [
                'json' => (object)[
                    'title' => 'title',
                    'dateTimeRequired' => (object)['datetime' => '2023-10-01 10:15:00'],
                    'dateTimeNullable' => null,
                ],
                'instance' => new HydratorDatetimeWithConstructor(
                    'title',
                    new DateTime('2023-10-01 10:15:00'),
                    null,
                )
            ],
            [
                'json' => (object)[
                    'title' => 'title',
                    'dateTimeRequired' => (object)['datetime' => '2023-10-01 10:15:00'],
                    #'dateTimeNullable' => null, //optional
                ],
                'instance' => new HydratorDatetimeWithConstructor(
                    'title',
                    new DateTime('2023-10-01 10:15:00'),
                    null,
                )
            ],
            [
                'json' => (object)[
                    'title' => 'title',
                    'dateTimeRequired' => '2023-10-01 10:15:55',
                    'dateTimeNullable' => '2023-10-01 10:30:11',
                ],
                'instance' => new HydratorDatetimeWithConstructor(
                    'title',
                    new DateTime('2023-10-01 10:15:55'),
                    new DateTime('2023-10-01 10:30:11'),
                )
            ],
            [
                'json' => (object)[
                    'title' => 'title',
                    'dateTimeRequired' => '2023-10-01 10:15:55',
                    'dateTimeNullable' => '2023-10-01 10:30:11',
                ],
                'instance' => new HydratorDatetimeWithConstructor(
                    'title',
                    new DateTime('2023-10-01 10:15:55'),
                    new DateTime('2023-10-01 10:30:11'),
                )
            ],
            [
                'json' => (object)[
                    'title' => 'title',
                    'dateTimeRequired' => '2023-10-01 10:15:55',
                    'dateTimeNullable' => '2023-10-01 10:30:11',
                ],
                'instance' => new HydratorDatetimeWithConstructor(
                    'title',
                    new DateTime('2023-10-01 10:15:55'),
                    new DateTime('2023-10-01 10:30:11'),
                )
            ],
            [
                'json' => (object)[
                    'title' => 'title',
                    'dateTimeRequired' => '2023-10-01 10:15:55',
                    'dateTimeNullable' => '2023-10-01 10:30:11',
                ],
                'instance' => new HydratorDatetimeWithConstructor(
                    'title',
                    new DateTime('2023-10-01 10:15:55'),
                    new DateTime('2023-10-01 10:30:11'),
                )
            ],

        ];
    }

    #[
        DataProvider('datetimeProvider')
    ]
    public function testDatetime(object $json, HydratorFactoryTraitInterface $instance): void
    {

        /**
         * @var HydratorFactoryTraitInterface $instance
         */
        $newInstance = $instance::getHydratorFactory()->createObject($json);
        $this->assertEqualsCanonicalizing($instance, $newInstance);

    }


}
