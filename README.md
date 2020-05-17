# Sales
Before defining anything that is needed for testing the task I would like to share some insights on what is done and what could have been done better.

As the task was defined:
The **Flowers** and **Coffee** should be sent to the courier , but a.t.m just to show the task completion the data
**after** the form submission on success. response is shown on the same page.
**What I could have done to make it more realistic:**

 - Create another symfony project, and pass the data via cURL or any other possible solution, leaving an open endpoint route, in which the second project would send a callback function to the main app so that the sale is complete.
 
 - WebSockets and making a real-time table updater in the same monoblock application
 - When ordering coffee, Google geolocation API could have worked fine with an autocomplete field in which the location gets written and the coordinates taken in. and then returned for the courier.
A.t.m the location can only be written by hand.
 - Same goes with Flower delivery address as in the above

**Forms**
Because this was created as a monoblock project, I simply created the forms using symfony *make:form* and added their own validation types for the forms that was needed for the task (although there was a need for a little bit of customization:
Location -> array -> form -> 2 fields (lat, lon) -> after form completion merged into array.

**If the project would have been an API:**
In that case I would have used Models, with assertions and done a custom form validation with error handling and return via response.
**Strategy pattern:**

 - Altought implemented and used it's really hard to say if it's done correctly, but atleast it works and does it's job.

**Other notes**

 - Coffee delivery time is set new Datetime('now) +30 minutes.
 - Frontend JS might be quite messy, there isn't much logic to it, just a couple of GET function to renew the views and basically view handling with jQuery, styling bootstrap did its job on that part

- Although the task mentioned that there is no need to define what kind of stuff the courier would send, I still added an order id and a name (it just makes more sense to be honest).

**This might get updated probably forgot something to mention here**

**Missing:**

 - Tests

# Installation
**What's used**:

 - Docker
- jQuery
- Twig
- Symfony 5
- PHP 7.4
- SASS (although it wasn't used, just to enable bootstrap, but still I enable it)
- Bootstrap 4

**Perquisites**

 - Docker installed
 - Git installed
 
**Launching**
 - Git pull the project
 - Open a terminal window in the folder and then ./start-dev.sh (if not working sudo ./start-dev.sh should help it although I wouldn't recommend it). It might take some time until the container gets set up for the first time
 - The terminal should automatically turn on the docker terminal (for symfony usage, use **sf** instead of **php bin/console** 
 - launch **composer install** (might not be needed, but just in case)
 - launch **yarn install**
 - launch **sf doctrine:database:create** (if exists continue to next step)
 - launch **sf doctrine:schema:create** (if exists continue to next step)
 - launch **sf doctrine:schema:create --force**  
 - launch **sf doctrine:fixtures:load -n** (for adding basic entities and a user account).
 - launch yarn encore dev


 # App
 **Credentials:**
 **http://localhost:8080/**
 - worker@job.com, 123456
 **Usage**:
 - After logging in you will be prompted to the main screen, in which the logic of the app is shown.

 

