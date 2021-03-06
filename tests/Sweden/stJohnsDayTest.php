<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\tests\Sweden;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Yasumi;

/**
 * Class for testing St. John's Day / Midsummer's Day in Sweden.
 */
class stJohnsDayTest extends SwedenBaseTestCase implements YasumiTestCaseInterface
{
    /**
     * The name of the holiday to be tested
     */
    const HOLIDAY = 'stJohnsDay';

    /**
     * Tests the holiday defined in this test.
     */
    public function testHoliday()
    {
        $year = $this->generateRandomYear();

        $holidays = Yasumi::create(self::REGION, $year);
        $holiday  = $holidays->getHoliday(self::HOLIDAY);

        // Some basic assertions
        $this->assertInstanceOf('Yasumi\Provider\\' . str_replace('/', '\\', self::REGION), $holidays);
        $this->assertInstanceOf(Holiday::class, $holiday);
        $this->assertNotNull($holiday);

        // Holiday specific assertions
        $this->assertEquals('Saturday', $holiday->format('l'));
        $this->assertGreaterThanOrEqual(20, $holiday->format('j'));
        $this->assertLessThanOrEqual(26, $holiday->format('j'));

        unset($holiday, $holidays);
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     */
    public function testTranslation()
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(),
            [self::LOCALE => 'midsommardagen']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     */
    public function testHolidayType()
    {
        $this->assertHolidayType(self::REGION, self::HOLIDAY, $this->generateRandomYear(), Holiday::TYPE_OFFICIAL);
    }
}
