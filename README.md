# POST-AND-REPLY

**version 1.0.0**

POST A BLOG AND REPLY WHEN LOGGED IN (USING PHP)

This is a basic project of posting blog and replying on post.

---

## Work Flow Of The Project

The working of project described page by page.

(index.php)

When user first visit the site he/she can see the recent post published by all the user as a guest.
User can comment/reply only if he/she loged in him/her account.


(navbar.php)

At navbar there are two section(home & account).
On click home user will be redirected at home page.
In account there are three section(Log in,Sign in & Log out).


(signin.php)

In this page the user have to create a new account.


(login.php)
Only existing user can log in and get access his/her profile.

(account.php)
When user log in successfully then this page will run. In this page there have two section.
    1. User account
    2. Recent post by user

    User Account
        This section contains user's data, "edit" button,"post comment" button,"timeline" button and "delete profile" button.
        For first time user can see only his/her name. He/she can edit/update profile picture, biodata, phone no and date of birth.

        On clicking "Edit" button user will be redirected to 'Update Your Profile' section where he/she have to upload his/her image and have to fill the phone no,date of birth & biodata.

        On clicking "post comment", page will be redirected to a section where user can write a blog. On clicking "Submit" the blog will be posted publically. he/She can see the post by clicking on "Timeline" button.

        On clicking "Timeline" button page will be redirected to index.php where he/she can see the recent posts.

        Atlast there is a "Delete profile" button.On clicking this button Profile Will be Deleted.

    Recent Post
        In this section User can see the blog posted by him/her.
        He/She can delete the post by clicking on "delete" button and can edit the post by clicking on "Edit" button.

(logout.php)

When user click on it his/her account will be logged out but he/she can be able to see the recent posted blogs.


(forget.php)

Work in progress.


(bootcss.php)

It is the CDN link of bootstrap css.


(bootjs.php)

It is the CDN link of bootstrap javascript.


(connection.php)

it is the database connection file.


---

## Contributors

- Arghyadip Roy <royarghyadip6@gmail.com>

---

## Date of Publish

- 21 August 2020
---

## license & Copyright

© ARGHYADIP ROY, Robotronics City