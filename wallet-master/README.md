# wallet

Rmit wallet is an electronic brag book where Rmit students are storing their documents, files and personal information and able to show their brag book to anyone. This app is really helpful for Rmit students when they are going to any events, career fairs, workshops or interviews.

# Register

1. register.html: front-end for register.
2. register.php: back-end for register.
3. password.php: hashes the password and secret answer when registering.

# Login

1. login.html: front-end for login.
2. login.php: back-end for login.
3. forgotPassword.html: the front end of forgot password page.
  3.1 ajax.php: verify user’s email and secret answer with the database, then sending a link to that user’s email.
  3.2 check.php: check whether user’s email is already in the database or not.
  3.3 email.class.php: set SMTP server
  3.4 changeUserPassword.php: a user clicks a link which is sent from server to a web browser where they can update the new password.

# Admin dashboard

1. admin/dashboard.php: Dashboard after administrator logging in.
2. admin/view.php: View all users’ personal details from the personal_profile table.
3. admin/edit.php: Edit a user’s personal detail from the personal_profile table.
4. admin/add.php: Add a user’s personal detail from the personal_profile table.
5. admin/delete.php: Remove a user’s personal detail from the personal_profile table.

# User hompage

1. index.php: Homepage after user logging in as a user/student.
2. profiles.php: display 4 profiles including personal, work, academic and credentials.
3. profileFileUpload.php: Upload file to a particular profile page.
4. renameFile.php: rename and update a file from s3 bucket and database.
5. deleteFile.php: remove a file from s3 bucket and database.
6. dbUtils.php: functions for the database including upload/view/edit/remove.
7. fileTypeUtils.php: define file extension, name, icon, and path in both database and s3 bucket.
8. s3Utils.php: functions for s3 bucket including upload/view/edit/remove.

# User sidebar

1. settings.php: Setting page where a user can change their avatar, password, and log out.
  1.1 changePassword.php: Change a user’s password.
  1.2 changeProfilePicture.php: set/change user’s avatar.
 
2. event.php: the front end for the event page 
  2.1 ajax/del.php: delete an event
  2.2 ajax/g.php: store event’s id, name, time and location 
  2.3 ajax/s.php: add event’s id, name, time and location 
  2.4 ajax/show.php: list and display all events 
