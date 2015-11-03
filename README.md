# NTUBAGB Website Guide
## Introduction

This is the website made for NTUBAGB for the use to collect information of videos, pictures, and data. The purpose of this ducumentation is to help someone whoever is in charge of managing this website can do his or her work done.

> This guide is for those who has no background in coding.

## Table of Contents

1. [Introduction](#introduction)
2. [Table of Contents](#table-of-contents)
3. [Basic Tools](#basic-tools)
4. [Get the Source Code](#get-the-source-code)
3. [Mainpage Editing](#mainpage-editing)
4. [Data Management](#data-management)
5. [Make it Better](#make-it-better)

## Basics Tools

To manage this website you will need a web server and a text editor. In this guide we will use XAMPP and sublime text. If you prefer other web server or other editor, it is up to you.

### XAMPP

XAMPP is a develope environment which set up all the things for you. Here you don't need to know what it is. Just click [here](https://www.apachefriends.org/zh_tw/index.html) to install .

> There will be a bunch of stuff that could be installed but here we only need the **Apache Web Server**. So unclick all the other stuff like mariaDB, proFTPD etc.

When you are finished. Double click `/Applications/XAMPP/xamppfiles/manage-osx` and you will see a manage board (type your user password if needed). Then find Apache Web Server and start it.

> It is important to make sure the server is running every time you want to manage this website.

Now open your web browser and type `localhost`. See if you see a veiw of XAMPP. If you do, Congratulations! You have installed it correctly.

### FileZilla

FileZilla is for you to upload data to the server. The website can only be seen if you upload it to the sever side. In this case, I suppose you are using the server which NTU provides. There already exists a guide about installation and furthere settings. Click [here](http://www.cc.ntu.edu.tw/chinese/services/serv_i01.asp) and make sure you follow all the guides inside.

### Sublime Text

It is not a necessary to use Sublime Text to edit. Any editor like TextEdit can do this task but Sublime Text will make it much organized and clean. (It can make you look like a pro too) Click [here](http://www.sublimetext.com/) to see if you would like to try.  

## Get the Source Code

This website is open sourced so it is easy for you to get the source code. Just open the terminal (only mac and linux will support this method) and type :

```
cd /Applications/XAMPP/xamppfiles/htdocs/
```

> this only works if you are using XAMPP. If not, the path will be different. 

then type :

```
git clone  https://github.com/narrator0/ntubagb-website.git
``` 

If you are using windows, click Download ZIP in the bottom left of [this page](https://github.com/narrator0/ntubagb-website). After unachiving put it in the `htdocs` file under the directory of `/XAMPP`. (You have to find it yourself since I'm not a windows user)

> Now you are able to see the website on **local side**. (only you can see it since the browser is just opening the file from your computer, not on the internet) Just open your browser and         type `localhost/ntubagb`.

### Upload it Online

Open FileZilla and put `/Applications/XAMPP/xamppfiles/htdocs/ntubagb` in the `public_html` file and the site will be seen at `http://homepage.ntu.edu.tw/~yourStudentId/ntubagb`. It it the same thing to updata the website, but only need to update the file you change in the future.

> Don't really type `http://homepage.ntu.edu.tw/~yourStudentId/ntubagb` please! Plug your student ID for example `http://homepage.ntu.edu.tw/~b03302015/ntubagb`.

## Mainpage Editing

