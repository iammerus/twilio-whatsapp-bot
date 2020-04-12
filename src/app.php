<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');


require_once 'vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

$sid = "ACCOUNT_SID";
$token = "ACCOUNT_TOKEN";
$twilio = new Client($sid, $token);
$sender = "whatsapp:ACCOUNT_NUMBER";


/**
 * Send a WhatsApp message to the specified number
 *
 * @param string $body The body of the message
 *
 * @return void
 */
function send_message($body)
{
    $response = new MessagingResponse();

    // Print out the TwiML for the response
    $message = $response->message('');

    // Set the body to the
    $message->body($body);

    echo $response;
}

/**
 * Send a media WhatsApp message to the specified number
 *
 * @param string|array $mediaUrl The URL for the media object to be sent
 * @param string $body The body of the message
 *
 * @return void
 */
function send_media_message($mediaUrl, $body = "")
{
    $response = new MessagingResponse();

    // Print out the TwiML for the response
    $message = $response->message('');

    if (!is_array($mediaUrl)) {
        $message->media($mediaUrl);
    } else {
        foreach ($mediaUrl as $item) {
            $message->media($item->media);
        }
    }

    echo $response;
}

/**
 * Fetches an article matching the query from Wikipedia
 *
 * @param string $query The query to search for
 *
 * @return string|null|bool Article text if successful, null if there when no matches are found, false if validation fails
 */
function wikipedia_fetch($query)
{
    // Sanity checks
    if (strlen($query) <= 0) {
        return false;
    }

    // Base url for querying wikipedia public api
    $base = 'https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&redirects=1&titles=%s';

    // The short form for accessing a page using its page id
    $shortBase = 'https://en.wikipedia.org/?curid=%d';

    // HTTP Request
    $url = sprintf($base, urlencode($query));

    // Get the JSON data
    $json = file_get_contents($url);

    // Decode data
    $data = json_decode($json);

    // Cast data to array
    $pages = (array)$data->query->pages;

    if (count($pages) <= 0) {
        return null;
    }

    // Reverse array
    $reversed = array_reverse($pages);

    // Get the last element from reversed array
    $article = array_pop($reversed);

    // More checks
    if (property_exists($article, "missing")) {
        return null;
    }

    // Get article Text and cap to 500 characters
    $link = sprintf($shortBase, $article->pageid);

    // Compose the actual text to be sent to user
    $text = trim(substr($article->extract, 0, 500)) . "...\n\nRead more at: {$link}";

    return $text;
}

/**
 * Search for the specified image and send the top three matching
 * images to the user
 * 
 * @param string $query The image to search for
 * 
 * @return void
 */
function image_search($query)
{
    // Sanity checks
    if (strlen($query) <= 0) {
        return false;
    }

    // Base URL for using Qwant Image Search API
    $base = 'https://api.qwant.com/api/search/images?count=3&t=images&safesearch=0&locale=en_US&uiv=4&q=%s';

    // Send http request
    $url = sprintf($base, urlencode($query));

    // Get JSON response
    $options = array('http' => array('user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36'));

    // Create stream context
    $context = stream_context_create($options);

    // Get the JSON
    $json = file_get_contents($url, false, $context);

    // Log out the request
    log_requests($url, $json);

    // Decode the data
    $data = json_decode($json);

    // 
    if ($data->status !== 'success') {
        return null;
    }

    // Retrieve the results
    $results = $data->data->result->items;

    return $results;
}

function math_eval($query)
{
    // Get the individual expressions from the query
    $parts = explode("\n", $query);

}

/**
 * Log out HTTP requests made by the application
 */
function log_requests($url, $response)
{
    file_put_contents('./logs/http_requests_out.log', "URL: {$url}\nBegin Body\n{$response}\n\n", FILE_APPEND);
}

function log_statuses($data)
{
    $data = json_encode($data);

    file_put_contents('./logs/status_updates_out.log', "Status Update:\n{$data}\n\n", FILE_APPEND);
}
