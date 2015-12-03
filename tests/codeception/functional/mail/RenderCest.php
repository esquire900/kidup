<?php
namespace codecept\functional\booking;

use mail\components\MailRenderer;
use functionalTester;
use codecept\_support\MuffinHelper;
use codecept\muffins\Booking;
use codecept\muffins\Item;
use codecept\muffins\User;
use codecept\muffins\Message;
use League\FactoryMuffin\FactoryMuffin;
use mail\models\UrlFactory;
use Yii;

/**
 * Functional test for mail rendering.
 *
 * Class RenderCest
 * @package codecept\functional\mail
 */
class RenderCest
{

    /**
     * @var FactoryMuffin
     */
    protected $fm = null;

    public function _before()
    {
        $this->fm = (new MuffinHelper())->init();
    }

    public function testPartialRender(FunctionalTester $I)
    {
        $booking = $this->fm->create(Booking::class);
        $mail = (new \mail\mails\bookingOwner\ConfirmationFactory())->create($booking);
        $renderer = MailRenderer($mail);
        $I->assertTrue(strlen($renderer->renderPartial()) > 0);
    }

}

?>