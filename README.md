# WhatsApp Bot Starter Project

This project helps you get started with using [Twilio's WhatsApp Business API](https://www.twilio.com/whatsapp) by laying out some of the foundations you'll need to make a bot work

## Setup Instructions

So this walkthrough assumes that you already have an account created on [Twilio](https://www.twilio.com/try-twilio). and are authenticated. It also assumes you've gone through their onboarding process for their [WhatsApp Sandbox](https://www.twilio.com/console/sms/whatsapp/sandbox). 

##### Prerequisites
1. PHP 7.4+
2. Composer
3. MySQL Server
4. Apache Web Server (You can use any other server as long as you can configure the rewrites)
5. ngrok

##### Running it locally

Once you're logged into your Twilio account and have met the requirements outlined above, you are ready to run the bot.

###### 1. Clone the project

Start off by cloning this repository into your workspace.

```sh
$> git clone https://github.com/iammerus/twilio-whatsapp-bot/ 
$> cd twilio-whatsapp-bot
```

###### 2. Install dependencies using composer

Download and install the dependencies for the project using composer

```sh
$> composer install
```

###### 3. Import the database & configure credentials

Import the SQL file `database/schema.sql` into your database. Then configure your database credentials in the file `config.php` which is located in the project root.

###### 4. Make the project accessible from the internets

We need to make sure the project is accessible from the rest of the internets (so Twilio can hit our endpoints when messages come through)

So first thing is making sure we're running the app using whatever web server software works best for us. For the sake of this demo, I'll be using PHP's built in development server.

```sh 
// Switch to the public directory (where our main entrypoint for the app is)
$> cd public/

// Run the app on port 8080 (take note of the port)
$> php -S localhost:8080
```

Once that is running, we now need to use ngrok to make our app accessible from the rest of the internet (we need this so Twilio can communicate with our app)

```sh
// 8080 is the port we were running our app on remember. 
// This might be different for you, based on how you're running this.
$> ngrok http 8080
```

But once you do that. You'll get two URLs an http one and an https one. Twilio supports both. But for this walkthrough, let's just use the HTTP one. Hade problems once with the PHP development server and the whole HTTPs thing. Copy the http url, we'll need it for the next step. 


###### 5. Configure Twilio to forward messages to our app

Head on to the Twilio WhatsApp dashboard. You will be greeted by a section titled `Sandbox Configuration`

Under this section, there are two textboxes titled `WHEN A MESSAGE COMES IN` and `STATUS CALLBACK URL`. Set the first one to `[The URL from the last step]/incoming` and the second one to `[The URL from the last step]/status`

Ensure that HTTP Post is selected on both fields. Then hit save.


###### 6. You're good to go!

Send the message `Yo` to the number that Twilio gave you in the onboarding process and see the example command included in the repo firing!

Going to make a few detailed articles in the Wiki explaining how everything works! And what needs to be improved. There's plenty 😅
