<?php
namespace notification\components;

// @todo: messaging tab = profielpagina van een persoon
// mail for mail
use booking\models\Booking;
use booking\models\Payout;
use Item\models\Item;
use Carbon\Carbon;
use notification\components\renderer\BookingRenderer;
use notification\components\renderer\ItemRenderer;
use notification\components\renderer\PayoutRenderer;
use notification\components\renderer\UserRenderer;
use user\models\User;
use Yii;

class Renderer
{

    /** @var BookingRenderer */
    public $bookingRenderer;
    /** @var PayoutRenderer */
    public $payoutRenderer;
    /** @var ItemRenderer */
    public $itemRenderer;
    /** @var UserRenderer */
    public $userRenderer;

    // E-mail sender
    public $sender_name = null;
    public $sender_email = null;

    // E-mail receiver
    public $receiver_name = null;
    public $receiver_email = null;
    public $receiver_language = null;

    // Item renter
    public $contact_renter_url = null;
    public $renter_phone_url = null;
    public $renter_email_url = null;
    public $renter_name = null;

    // Booking
    public $booking_id = null;
    public $accept_url = null;
    public $decline_url = null;
    public $booking_date = null;
    public $booking_start_date = null;
    public $booking_end_date = null;

    // Item owner
    public $contact_owner_url;
    public $owner_phone_url = null;
    public $owner_email_url = null;
    public $owner_name = null;

    // Item
    public $finish_product_url = null;
    public $rent_url = null;
    public $rent_out_url = null;
    public $item_name = null;
    public $total_payout_amount = null;
    public $time_before = null;

    // Review
    public $reviewer_name = null;
    public $days_left = null;
    public $review_url = null;

    // User
    public $confirm_url = null;
    public $recovery_url = null;
    public $profile_url = null;
    public $social_media_url = null;

    // Reviewer name, depending on receiver/sender
    public $name = null;

    // General
    public $app_url = null;
    public $email_support = null;
    public $faq_url = null;
    public $title = null;

    // Variables
    public $vars = [];

    // Templating
    protected $templateFolder = null;

    public function renderFromFile($template) {
        $vars = $this->getVariables();
        return \Yii::$app->view->renderFile($this->templateFolder . '/' . $template . '.twig', $vars);
    }

    public function getVariables() {
        return $this->vars;
    }

    public function setVariables($vars) {
        $this->vars = array_merge($vars, $this->vars);
    }

    /**
     * Set a title.
     *
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Load the booking.
     *
     * @param Booking $booking
     */
    public function loadBooking(Booking $booking) {
        $vars = $this->bookingRenderer->loadBooking($booking);
        $this->setVariables($vars);
    }

    /**
     * Load the payout.
     *
     * @param Payout $payout
     */
    public function loadPayout(Payout $payout) {
        $vars = $this->payoutRenderer->loadPayout($payout);
        $this->setVariables($vars);
    }

    /**
     * Load the item.
     *
     * @param Item $item
     */
    public function loadItem(Item $item) {
        $vars = $this->itemRenderer->loadPayout($item);
        $this->setVariables($vars);
    }

    /**
     * Load the renter.
     *
     * @param User $user
     */
    public function loadRenter(User $user) {
        $vars = $this->userRenderer->loadRenter($user);
        $this->setVariables($vars);
    }

    /**
     * Load the owner.
     *
     * @param User $user
     */
    public function loadOwner(User $user) {
        $vars = $this->userRenderer->loadOwner($user);
        $this->setVariables($vars);
    }

    /**
     * Load the sender.
     *
     * @param User $user
     */
    public function loadSender(User $user) {
        $vars = $this->userRenderer->loadSender($user);
        $this->setVariables($vars);
    }

    /**
     * Load the retriever.
     *
     * @param User $user
     */
    public function loadRetriever(User $user) {
        $vars = $this->userRenderer->loadR($user);
        $this->setVariables($vars);
    }

    /**
     * Display a UNIX timestamp in a conventional way.
     *
     * @param $unixTimestamp The UNIX timestamp.
     * @return string The conventional display of the timestamp.
     */
    public static function displayDateTime($unixTimestamp) {
        return Carbon::createFromTimestamp($unixTimestamp)->format("d-m-y H:i");
    }

}