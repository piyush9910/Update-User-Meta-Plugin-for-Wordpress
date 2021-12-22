# Update-User-Meta-Plugin-for-Wordpress
Plugin Developed to add new user from CSV File and assign them to particular groups using a dropdown menu . We are using WordPress and LearnDash LMS for this plugin.
Groups will be taken from Learndash LMS Plugin.
This wordpress plugin enables us to upload csv files containing the details of users and assign them to Learndash LMS groups.
![image](https://user-images.githubusercontent.com/54396900/147044664-bee873c8-3b9a-4824-bc2a-bf25ed85b395.png)
Steps to operate the plugin:

Step 1:  To create new users from CSV file, the check box “Create New user when user not available” must be checked.

Step 2: Upload the csv file using the “choose file” button.

Step 3: Click on “Import”.

Step 4: Now in order to update the details of the users, the CSV file needs to be uploaded under the “Assign Group to Users” column.

Step 5: Choose the group from the dropdown menu to assign to the users.

Step 6:  Click on “Update”.

Important Notes:

•	The CSV file should be in the following format:

user_login	email	meta_key	meta_value	password

For example:

![image](https://user-images.githubusercontent.com/54396900/147044811-e9639276-5254-40f5-8fa8-3ec6875a095e.png)


•	The column “meta_key” should be populated only with “nickname” in order to have a smooth creation of users.

•	The default role given to the users on creation is “Subscriber”. It can be changed by the administrators of the website from the “Users” Plugin.
