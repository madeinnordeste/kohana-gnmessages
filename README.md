#Kohana GNMessages (Gmail New Messages)

Kohana Module to get new messages for Gmail Accounts/Google Apps Accounts using Gmail Atom Feed.

**Tested with:** *Kohana 3.3.2*

## How to use:

	$gnm = new GNMessages('my-gmail-account', 'my-password');
	$messages = $gnm->get();
	
	echo Kohana_Debug::dump($messages);
	
#### Default account (Gmail):
	
	$gnm = new GNMessages('my-gmail-account', 'my-password');


#### Google Apps account:
	
	$gnm = new GNMessages('my-account@domain.com', 'my-password');

#### Get only new messages for tag:
	
	$gnm = new GNMessages('my-account@domain.com', 'my-password', 'my-tag');
	

## Return Data:

Return Array with keys:

* title (String)
* fullcount (Integer)
* tagline (String)
* modified (String)
* entries (Array)
	* author (Array)
		* name (String)
		* email (String)
	* contributor (Array)
		* name (String)
		* email (String)
	* title (String)
	* summary (String)
	* link (String)
	* modified (String)
	* issued (String)
	* id (String)
	
![Return Data](https://raw.githubusercontent.com/madeinnordeste/kohana-gnmessages/master/screenshot-return-data.png "Return Data") 	
