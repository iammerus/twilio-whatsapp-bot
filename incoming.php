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
            return send_message( $_POST['From'], "Slow down cowboy. You need to provide something to search for 😝😝" );
        }
        
        // Not results found
        if($output === null) {
            return send_message( $_POST['From'], "Wow! Well, this is embarassing 🙈 I can't seem to find anything that matches that 🙁" );
        }

        // Send the results
        return send_message( $_POST['From'], "Here's your search results for '{$query}'\n\n\n{$output}" );
        break;

    case 'help':
        return send_message( $_POST['From'], "Available commands:\n\n*wiki* query - Searches for the query on Wikipedia and returns the top result\n*pict* query - Finds images that match the query and returns the top 3 results" );
        break;

    case 'pict':
        $images = image_search($query);


        // Sanity checks failed
        if($images === false) {
            return send_message( $_POST['From'], "Slow down cowboy. You need to provide something to search for 😝😝" );
        }
        
        // Not results found
        if($images === null) {
            return send_message( $_POST['From'], "Wow! Well, this is embarassing 🙈 I can't seem to find anything that matches that 🙁" );
        }

        foreach($images as $index => $image) {
            send_media_message($_POST['From'], $image->media);
        }
        
        break;

        break;
    
    default:
        send_message( $_POST['From'], "Aww schucks! That command does not exist! 😅" );
        break;
}