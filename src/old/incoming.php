<?php
require_once 'app.php';

// Get message
$message = trim( $_POST['Body'] );

// Get command
$command = substr($message, 0, 4);

// Get the query
$query = trim( substr($message, 4) );

switch ($command) {
    case 'wiki':
        // Fetch the user's results from Wikipedia
        $output = wikipedia_fetch($query);

        // Sanity checks failed
        if($output === false) {
            send_message( "Slow down cowboy. You need to provide something to search for 😝😝" );

            break;
        }
        
        // Not results found
        if($output === null) {
            send_message( "Wow! Well, this is embarassing 🙈 I can't seem to find anything that matches that 🙁" );

            break;
        }

        // Send the results
        send_message( "Here's your search results for '{$query}'\n\n\n{$output}" );
        break;

    case 'help':
        send_message( "Available commands:\n\n*wiki* query - Searches for the query on Wikipedia and returns the top result\n*pict* query - Finds images that match the query and returns the top 3 results" );
        break;

    case 'pict':
        $images = image_search($query);


        // Sanity checks failed
        if($images === false) {
            send_message( "Slow down cowboy. You need to provide something to search for 😝😝" );

            break;
        }
        
        // Not results found
        if($images === null) {
            send_message( "Wow! Well, this is embarassing 🙈 I can't seem to find anything that matches that 🙁" );

            break;
        }

        send_media_message($images);

        break;


    case 'math':
        $output = math_eval($query);
        break;
    
    default:
        send_message( "Aww schucks! That command does not exist! 😅" );
        break;
}