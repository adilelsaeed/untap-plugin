This plugin do the following tasks assuming Gravity form installed and Score form created:
 - Create a custom checkbox in the “Final Score” field general settings
   says “This field will hold the final score”.
 - Create a registration system where users can signup and login (do not
   use a plugin for that).
 - Once the user logged in, he should be redirected to “Account Page”
   and find the Gravity Forms form that you have created and he can
   submit the form. However, once he submitted the form it should not
   show up if he refreshed the page.
 - Once the legged-in users only submit this form create a hook that
   gets triggered before the entry is saved to the database to check if
   a field is the final score field and assign the sum of (Score 1 +
   Score 2 + Score 3) in it.

## Full Project:

How to install
1- Download site export file
2- Install [LocalWP](https://localwp.com/)
3- Import downloaded file
You can also use any other local development enviroment but you will need to edit current site URL (untap.local) with your intened URL (you can use [this tool](https://github.com/interconnectit/Search-Replace-DB))

### Admin User 
username: admin
password: 7Cw^h9v5Z1uvAESsoCCn54%c
