<?php
namespace mail\mails\bookingOwner;

use mail\mails\MailUserFactory;
use yii\helpers\Url;

/**
 * Owner booking request.
 */
class RequestFactory
{

    public function create(\booking\models\Booking $booking)
    {
        $receiver = (new MailUserFactory())->createForUser($booking->item->owner);

        $e = new Request();
        $e->setReceiver($receiver);
        $e->startDate = $booking->time_from;
        $e->endDate = $booking->time_to;
        $e->numberOfDays = $booking->getNumberOfDays();
        $e->renterName = $booking->renter->profile->getFullName();
        $e->itemName = $booking->item->name;
        $e->payout = $booking->amount_payout . ' DKK';
        $e->dayPrice = $booking->getDayPrice();
        $e->responseUrl = Url::to('@web/booking/' . $booking->id . '/request', true);
        if (is_object($booking->conversation)) {
            $e->message = $booking->conversation->messages[0];
            $e->chatUrl = Url::to('@web/messages/' . $booking->conversation->id, true);
        }

        return $e;
    }

}