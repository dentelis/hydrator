<?php
declare(strict_types=1);

namespace tests\unit\Factory\Datetime;

use DateTime;
use Dentelis\Hydrator\Factory\DTOFactory;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use Dentelis\Hydrator\Factory\DTOFactoryTraitInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\Datetime\Objects\DTODatetimeWithConstructor;


#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
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
                'instance' => new DTODatetimeWithConstructor(
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
                'instance' => new DTODatetimeWithConstructor(
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
                'instance' => new DTODatetimeWithConstructor(
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
                'instance' => new DTODatetimeWithConstructor(
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
                'instance' => new DTODatetimeWithConstructor(
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
                'instance' => new DTODatetimeWithConstructor(
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
    public function testDatetime(object $json, DTOFactoryTraitInterface $instance): void
    {

        /**
         * @var DTOFactoryTraitInterface $instance
         */
        $newInstance = $instance::getFactory()->createObject($json);
        $this->assertEqualsCanonicalizing($instance, $newInstance);

    }


}
