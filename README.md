# Temp-Admin
This PHP script permits you generate single-use admin URI, with Telegram support.

## ToDo

* Redefine bot creation
* Add support of rocketchat and / or discord
* Add how-to block access on principal admin uri (for exemple /wp-admin have to not be accessed directly)
* Add a temporary based timout for URI

## How-To

### 1. Define a secret

To use this script in production, you have to define a secret that will permit you generate random admin URI.

Let's define :
```
$yourSecret = 'arandomsecret'
```

### 2. Define your telegram bot creds

Create a bot on Telegram and fill in information into the script.

### 3. Enjoy !

Go at https://your-domain.com/temp-admin.php?s=arandomsecret and check out your messages. The bot have sent you a message containing the temporary admin URI !
