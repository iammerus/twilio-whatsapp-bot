<?php

namespace Merus\WAB\Http;

class TwilioRequest
{
    /**
     * A 34 character unique identifier for the message. May be used to later retrieve this message from the REST API.
     *
     * @var string
     */
    private string $messageSid;

    /**
     * The 34 character id of the Account this message is associated with.
     *
     * @var string
     */
    private string $accountSid;

    /**
     * The 34 character id of the Messaging Service associated with the message.
     *
     * @var string
     */
    private string $messagingServiceSid;

    /**
     * The phone number or Channel address that sent this message.
     *
     * @var string
     */
    private string $from;

    /**
     * The phone number or Channel address of the recipient.
     *
     * @var string
     */
    private string $to;

    /**
     * The text body of the message. Up to 1600 characters long.
     *
     * @var string
     */
    private string $body;

    /**
     * TwilioRequest constructor.
     *
     * @param string $messageSid A 34 character unique identifier for the message. May be used to later retrieve this message from the REST API.
     * @param string $accountSid The 34 character id of the Account this message is associated with.
     * @param string $messagingServiceSid The 34 character id of the Messaging Service associated with the message.
     * @param string $from The phone number or Channel address that sent this message.
     * @param string $to The phone number or Channel address of the recipient.
     * @param string $body The text body of the message. Up to 1600 characters long.
     */
    public function __construct(
        string $messageSid, string $accountSid, string $messagingServiceSid, string $from, string $to, string $body)
    {
        $this->messageSid = $messageSid;
        $this->accountSid = $accountSid;
        $this->messagingServiceSid = $messagingServiceSid;
        $this->from = $from;
        $this->to = $to;
        $this->body = $body;
    }
}